<?php

use App\Http\Controllers\admins\SubjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});
//

