<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostContoller;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin\CategoriesController;
use App\Http\Controllers\Api\Admin\UsersController;
use App\Http\Controllers\Api\CommentsController;

Route::get('/', [\App\Http\Controllers\Api\HomeController::class, 'index'])->name('home');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/post/{post}', [PostContoller::class, 'show'])->name('post.show');
Route::get('/posts/{post}/comments', [CommentsController::class, 'index'])->name('post.comments.index');

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Users
    Route::get('/user', [\App\Http\Controllers\Api\UsersController::class, 'index'])->name('user.data');
    Route::get('/users/{user}/posts', [\App\Http\Controllers\Api\UsersController::class, 'showPosts'])->name('user.posts');
    Route::apiResource('users', \App\Http\Controllers\Api\UsersController::class)->except(['store', 'index']);
    
    // Posts
    Route::get('/my-posts', '\App\Http\Controllers\Api\User\PostController')->name('user.posts');
    Route::apiResource('post', PostContoller::class)->except(['show', 'index']);

    // Comments
    Route::apiResource('posts.comments', CommentsController::class)->except('index')->shallow();

    // Admin Routes
    Route::middleware('admin')->group( function () {
        Route::get('admin/posts', \App\Http\Controllers\Api\Admin\PostController::class)->name('admin.posts');
        Route::apiResource('categories', CategoriesController::class)->except(['show']);

        // users
        Route::put('admin/users/{user}/change-role', [UsersController::class, 'changeRole'])->name('admin.change.role');
        Route::get('admin/users', [UsersController::class, 'index'])->name('admin.users.index');

    });
});
