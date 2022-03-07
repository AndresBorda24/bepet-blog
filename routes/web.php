<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', \App\Http\Controllers\Common\HomeController::class)->name('home');

Route::get('/test', \App\Http\Livewire\Table::class)->name('tests');

// Shows a single Post
Route::get('/post/{post:slug}', [\App\Http\Controllers\Common\PostController::class, 'show'])->name('post.show');

// Perfoms a search by a given Input
Route::get('/post/search/{search}', [\App\Http\Controllers\Common\PostController::class, 'searchByInput'])->name('post.search');

// Perfoms a search by a selected Category 
Route::get('/post/category/{category:slug}', [\App\Http\Controllers\Common\PostController::class, 'searchByCategory'])->name('post.search.category');


// Authenticate Users
Route::middleware(['auth'])->prefix('/dashboard')->name('dashboard.')->group(function () {
    Route::get('/', \App\Http\Controllers\User\PostController::class)
                    ->name('home');

    // Post CRUD
    Route::get('post/drafts', [\App\Http\Controllers\Common\PostController::class, 'drafts'])->name('post.drafts');
    Route::get('post/publish/{post:slug}', [\App\Http\Controllers\Common\PostController::class, 'postIt'])->name('post.postIt');
    Route::resource('post', \App\Http\Controllers\Common\PostController::class)->scoped([
        'post' => 'slug',
    ])->except('index');

    // Admin Routes
    Route::middleware(['admin'])->prefix('/admin')->name('admin.')->group(function () {

        Route::get('/posts', \App\Http\Controllers\Admin\PostController::class)->name('posts');

        Route::resource('categories', \App\Http\Controllers\Admin\CategoriesController::class)->scoped([
            'category' => 'slug',
        ])->except('show');

        // Route::get('/categories', [\App\Http\Controllers\Admin\CategoriesController::class, 'index'])->name('categories');
    });

    
});

require __DIR__.'/auth.php';
