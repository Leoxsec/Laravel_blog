<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Auth::routes();

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/show/{post}', [PostController::class, 'show'])->name('posts.show');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/posts/manage', [PostController::class, 'manage'])->name('posts.manage');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/update/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // User-related routes
    Route::get('/user', [UserController::class, 'index'])->name('user.index'); // User dashboard
    Route::get('/user/profile', [ProfileController::class, 'show'])->name('user.profile.show'); // User profile
    Route::get('/user/profile/edit', [ProfileController::class, 'edit'])->name('user.profile.edit'); // Edit profile
    Route::post('/user/profile', [ProfileController::class, 'update'])->name('user.profile.update'); // Update profile
});

// Admin routes
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
