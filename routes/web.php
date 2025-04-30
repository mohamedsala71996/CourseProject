<?php

use App\Http\Controllers\Student\LessonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentAuthController;
use App\Http\Controllers\Student\StudentExamController;
use App\Http\Controllers\Student\StudentFineController;
use App\Http\Controllers\Student\SubjectController;

Route::get('/', fn () => view('students.dashboard'))->name('student.home');


Route::middleware('guest:student')->group(function () {
    Route::get('/login', [StudentAuthController::class, 'showLoginForm'])->name('student.login');
    Route::post('/login', [StudentAuthController::class, 'login'])->name('student.login.submit');
});


Route::middleware('auth:student')->group(function () {
    Route::get('/dashboard', fn () => view('students.dashboard'))->name('student.dashboard');
    Route::delete('/logout', [StudentAuthController::class, 'logout'])->name('student.logout');

    Route::get('/my-subjects', [SubjectController::class, 'index'])->name('student.subjects');

    Route::get('subjects/{subject}/lessons', [LessonController::class, 'index'])->name('subject.lessons');
    Route::get('lessons/{lesson}/watch', [LessonController::class, 'watch'])->name('lesson.watch');
    Route::get('lessons/{lesson}/exam', [LessonController::class, 'exam'])->name('lesson.exam');
    Route::post('/lessons/{lesson}/mark-viewed', [LessonController::class, 'markViewed'])
    ->middleware('auth:student')
    ->name('student.lesson.markViewed');

    Route::get('/student/lessons/{lesson}/questions', [LessonController::class, 'questions'])
    ->name('student.lesson.questions');

    Route::post('/student/lessons/{lecture}/submit', [StudentExamController::class, 'submitAnswers'])->name('student.exam.submit');
    Route::get('/student/overview', [StudentExamController::class, 'examOverview'])->name('student.exam.overview');
    Route::get('/student/lessons/{lecture}/result', [StudentExamController::class, 'showResult'])->name('student.exam.result');

    Route::get('/student/fines', [StudentFineController::class, 'index'])->name('student.fines');
});
