<?php

use App\Http\Controllers\Api\Admin\CategoriesController;
use App\Http\Controllers\Api\PostContoller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Api\HomeController::class, 'index'])->name('home');

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register'])->name('register');
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login'])->name('login');

Route::get('/post/{post}', [\App\Http\Controllers\Api\PostContoller::class, 'show'])->name('post.show');

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->name('user');

    Route::get('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->name('logout');

    Route::prefix('/dashboard')->name('dashboard.')->group( function () {
        Route::get('/my-posts', '\App\Http\Controllers\Api\User\PostController')->name('user.posts');
        Route::apiResource('post', PostContoller::class)->except(['show', 'index']);

        Route::middleware('admin')->prefix('/admin')->name('admin.')->group( function () {
            Route::get('/posts', '\App\Http\Controllers\Api\Admin\PostController')->name('posts');
            Route::apiResource('categories', CategoriesController::class)->except(['show']);

        });
        
    });
});


