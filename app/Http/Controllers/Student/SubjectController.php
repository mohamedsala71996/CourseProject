<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        $student = Auth::guard('student')->user();
        $subStage = $student->subStage;
        $subjects = $subStage->subjects;

        return view('students.subjects.index', compact('subjects', 'subStage'));
    }
}
