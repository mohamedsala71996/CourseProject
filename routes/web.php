<?php

use App\Http\Controllers\User\UserAuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:student')->group(function () {
    Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('student.login');
    Route::post('/login', [UserAuthController::class, 'login'])->name('student.login.submit');
});

Route::middleware('auth:student')->group(function () {
    Route::get('/', fn() => view('students.dashboard'))->name('student.dashboard');
    Route::post('/logout', [UserAuthController::class, 'logout'])->name('student.logout');
});
