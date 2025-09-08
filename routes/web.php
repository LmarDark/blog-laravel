<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Posts\PostController;

Route::get('/', function () {
    return redirect('/blog');
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/blog', [BlogController::class, 'index'])->name('blog');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');
Route::post('/profile/create', [PostController::class, 'create'])->name('profile.create')->middleware('auth');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.post')->middleware('auth');
Route::get('profile/{username}', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
Route::post('profile/delete/{id}', [ProfileController::class, 'delete'])->name('profile.delete')->middleware('auth');

Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

