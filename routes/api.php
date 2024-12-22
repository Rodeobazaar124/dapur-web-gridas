<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1'], function () {
    Route::get('/posts', [App\Http\Controllers\Api\PostController::class, 'index']);
    Route::middleware(['guest', 'throttle:20,5'])->group(function () {
        Route::post('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
    });


    Route::middleware(['auth:api'])->group(function () {
        Route::apiResource('manage/posts', App\Http\Controllers\Api\PostController::class);
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    });
});
