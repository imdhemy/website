<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/v1/auth/registration', [AuthController::class, 'register']);
Route::post('/v1/posts', [PostController::class, 'store']);
Route::delete('/v1/posts/{id}', [PostController::class, 'destroy']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
