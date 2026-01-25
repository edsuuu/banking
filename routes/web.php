<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::view('/', 'banking.welcome')->name('welcome');

Route::middleware(['guest'])->group(function () {
    Route::view('/login', 'banking.auth.login')->name('login');
    Route::view('/register', 'banking.auth.register')->name('register');
});


Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'banking.dashboard.index')->name('dashboard');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout');
