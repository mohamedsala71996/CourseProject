<?php

use App\Http\Controllers\Admin\LectureController;
use App\Http\Controllers\Admin\SubjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;


Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', fn() => view('admins.dashboard'))->name('dashboard');

    //subjects
    Route::resource('subjects', SubjectController::class);
    Route::get('/get-sub-stages/{stage_id}', [SubjectController::class, 'getSubStages']);
    Route::get('/get-subjects/{sub_stage_id}', [SubjectController::class, 'getSubjects']);

    //lectures
    Route::resource('lectures', LectureController::class);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
