<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatController;

Route::get('/cats', [CatController::class, 'index']);
Route::post('/cats', [CatController::class, 'store']);
