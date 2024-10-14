<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/user', function (Request $request) {
    if (!Auth::check()) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    return $request->user();
})->middleware('auth:sanctum')->name('user.profile');
