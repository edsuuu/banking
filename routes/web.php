<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::view('/', 'banking.welcome')->name('welcome');

Route::middleware(['guest'])->group(function () {
    Route::view('/login', 'banking.auth.login')->name('login');
    Route::view('/register', 'banking.auth.register')->name('register');
    
    // Google Auth
    Route::get('oauth2/google/redirect', [AuthController::class, 'googleRedirect'])->name('google.redirect');
    Route::get('oauth2/google/callback', [AuthController::class, 'googleCallback'])->name('google.callback');
});


Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'banking.dashboard.index')->name('dashboard');
    Route::view('/webhooks', 'banking.webhooks.index')->name('webhooks.index');
    Route::view('/integrations', 'banking.integrations.index')->name('integrations.index');
    Route::view('/settings', 'banking.settings.index')->name('settings.index');
    Route::view('/withdrawals', 'banking.withdrawals.index')->name('withdrawals.index');
    Route::view('/links', 'banking.links.index')->name('links.index');
    Route::view('/invoices', 'banking.invoices.index')->name('invoices.index');
    Route::view('/customers', 'banking.customers.index')->name('customers.index');
    Route::view('/coupons', 'banking.coupons.index')->name('coupons.index');
    Route::view('/products', 'banking.products.index')->name('products.index');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout');
