<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

        // Categories Routes
        Route::resource('/admin/categories', CategoryController::class)
            ->except(['show']) // Only create, edit, update, destroy, index are used
            ->names([
                'index' => 'adminCategories.index',
                'create' => 'adminCategories.create',
                'store' => 'categories.create',
                'edit' => 'categories.edit',
                'update' => 'categories.update',
                'destroy' => 'adminCategories.destroy',
            ]);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
