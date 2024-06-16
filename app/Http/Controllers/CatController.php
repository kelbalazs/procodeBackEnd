<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cat;
use Illuminate\Support\Facades\Validator;

class CatController extends Controller
{
    public function index()
    {
        $cats = Cat::all();
        return response()->json($cats);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'owner_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $cat = Cat::create([
            'name' => $request->name,
            'dob' => $request->dob,
            'owner_name' => $request->owner_name,
        ]);

        return response()->json([
            'message' => 'Cat created successfully',
            'cat' => $cat,
        ], 201);
    }
}
