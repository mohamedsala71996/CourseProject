<?php

use App\Http\Controllers\Admin\LectureController;
use App\Http\Controllers\Admin\SubjectController;
use Illuminate\Support\Facades\Route;

//subjects
Route::resource('subjects', SubjectController::class);
Route::get('/get-sub-stages/{stage_id}', [SubjectController::class, 'getSubStages']);
Route::get('/get-subjects/{sub_stage_id}', [SubjectController::class, 'getSubjects']);

//lectures
Route::resource('lectures', LectureController::class);
