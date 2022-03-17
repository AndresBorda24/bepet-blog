<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostContoller;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin\CategoriesController;
use App\Http\Controllers\Api\CommentsController;

Route::get('/', [\App\Http\Controllers\Api\HomeController::class, 'index'])->name('home');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/post/{post}', [PostContoller::class, 'show'])->name('post.show');
Route::get('/posts/{post}/comments', [CommentsController::class, 'index'])->name('post.comments.index');

Route::middleware('auth:sanctum')->group( function () {
    // Users
    Route::name('users.')->group( function () {
        Route::get('/user', [\App\Http\Controllers\Api\UsersController::class, 'index'])->name('data');
        Route::get('/user/{user}', [\App\Http\Controllers\Api\UsersController::class, 'show'])->name('show');
    });
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Posts
    Route::get('/my-posts', '\App\Http\Controllers\Api\User\PostController')->name('user.posts');
    Route::apiResource('post', PostContoller::class)->except(['show', 'index']);

    // Comments
    Route::apiResource('posts.comments', CommentsController::class)->except('index')->shallow();

    // Admin Routes
    Route::middleware('admin')->group( function () {
        Route::get('admin/posts', \App\Http\Controllers\Api\Admin\PostController::class)->name('admin.posts');
        Route::apiResource('categories', CategoriesController::class)->except(['show']);

    });
});


