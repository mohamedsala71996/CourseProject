<?php

use App\Http\Controllers\admins\SubjectController;
use Illuminate\Support\Facades\Route;


Route::resource('subjects', SubjectController::class);
Route::get('/get-sub-stages/{stage_id}', [SubjectController::class, 'getSubStages']);
