<?php

use App\Http\Controllers\Admin\LectureController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\StageController;
use App\Http\Controllers\Admin\SubStageController;
use App\Http\Controllers\Admin\FineController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\StudentController;

Route::prefix('admin')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', fn() => view('admins.dashboard'))->name('admin.dashboard');

        // subjects
        Route::resource('subjects', SubjectController::class);
        Route::get('/get-sub-stages/{stage_id}', [SubjectController::class, 'getSubStages']);
        Route::get('/get-subjects/{sub_stage_id}', [SubjectController::class, 'getSubjects']);

        // lectures
        Route::resource('lectures', LectureController::class);

        // questions
        // Route::resource('lectures', QuestionController::class);
        Route::get('/lectures/{lecture}/questions', [QuestionController::class, 'index'])->name('lectures.questions.index');
        Route::get('/lectures/{lecture}/questions/create', [QuestionController::class, 'create'])->name('lectures.questions.create');
        Route::post('/lectures/{lecture}/questions', [QuestionController::class, 'store'])->name('lectures.questions.store');
        Route::get('/lectures/{lecture}/questions/{question}/edit', [QuestionController::class, 'edit'])->name('lectures.questions.edit');
        Route::put('/lectures/{lecture}/questions/{question}', [QuestionController::class, 'update'])->name('lectures.questions.update');
        Route::delete('/lectures/{lecture}/questions/{question}', [QuestionController::class, 'destroy'])->name('lectures.questions.destroy');

        // stages
        Route::resource('stages', StageController::class);

        // substages
        Route::resource('sub_stages', SubStageController::class);


        Route::resource('fines', FineController::class);
        //students
        Route::resource('students', StudentController::class);

        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    });
});
