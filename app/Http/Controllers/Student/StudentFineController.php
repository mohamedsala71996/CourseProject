<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentFineController extends Controller
{
    public function index()
    {
        $student = Auth::guard('student')->user();
        $fines = $student->fines()->latest()->get();

        return view('students.fines.index', compact('fines'));
    }
}
