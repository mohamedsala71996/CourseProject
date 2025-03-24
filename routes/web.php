<?php

use App\Http\Controllers\User\UserAuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('user.login');
    Route::post('/login', [UserAuthController::class, 'login'])->name('user.login.submit');

    Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('user.register');
    Route::post('/register', [UserAuthController::class, 'register'])->name('user.register.submit');
});

Route::middleware('auth:web')->group(function () {
    Route::get('/', fn() => view('user.dashboard'))->name('user.dashboard');
    Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');
});

