<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class CatController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Cat::query();

            if ($request->has('owner_name')) {
                $query->where('owner_name', 'like', '%' . $request->input('owner_name') . '%');
            }

            $cats = $query->get(['id', 'name', 'dob', 'owner_name']);
            return response()->json($cats);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve cats'], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'owner_name' => 'required|string|max:255|unique:cats',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $cat = Cat::create($request->all());
            return response()->json([
                'message' => 'Cat created successfully',
                'cat' => $cat
            ], 201);
        } catch (QueryException $e) {
            // Check if it's a duplicate entry error
            if ($e->getCode() == 23000) {
                return response()->json(['error' => 'An owner with this name already exists.'], 409);
            }
            return response()->json(['error' => 'Failed to create cat'], 500);
        }
    }
}
