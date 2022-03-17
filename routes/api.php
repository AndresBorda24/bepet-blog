<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostContoller;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin\CategoriesController;

Route::get('/', [\App\Http\Controllers\Api\HomeController::class, 'index'])->name('home');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/post/{post}', [PostContoller::class, 'show'])->name('post.show');

Route::middleware('auth:sanctum')->group( function () {
    Route::name('users.')->group( function () {
        Route::get('/user', [\App\Http\Controllers\Api\UsersController::class, 'index'])->name('data');
        Route::get('/user/{user}', [\App\Http\Controllers\Api\UsersController::class, 'show'])->name('show');
    });
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/my-posts', '\App\Http\Controllers\Api\User\PostController')->name('user.posts');
    Route::apiResource('post', PostContoller::class)->except(['show', 'index']);

    // Admin Routes
    Route::middleware('admin')->group( function () {
        Route::get('admin/posts', \App\Http\Controllers\Api\Admin\PostController::class)->name('admin.posts');
        Route::apiResource('categories', CategoriesController::class)->except(['show']);

    });
});


