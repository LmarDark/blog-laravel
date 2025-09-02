<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('Auth/login');
})->name('welcome');

Route::get('/register', function () {
    return view('Auth/register');
})->name('register');

Route::post('/login', function () {
    return redirect('/dashboard');
})->name('login');
