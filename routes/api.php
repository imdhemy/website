<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/v1/auth/registration', [AuthController::class, 'register']);

Route::get('v1/index/posts',[PostController::class,'index'] );
Route::get('/v1/show/posts/{id}', [PostController::class,'show']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
