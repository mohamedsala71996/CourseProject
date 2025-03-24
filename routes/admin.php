<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\SubjectController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', fn() => view('admins.dashboard'))->name('dashboard');

    Route::resource('subjects', SubjectController::class);
    Route::get('/get-sub-stages/{stage_id}', [SubjectController::class, 'getSubStages']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
