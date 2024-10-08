<?php

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return response()->json(['status' => true, 'data' => $request->user(), 'message' => 'User versi 2']);
})->middleware('auth:sanctum');

