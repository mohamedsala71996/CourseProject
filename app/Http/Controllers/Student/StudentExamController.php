<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lecture;
use App\Models\Option;
use App\Models\Question;
use App\Models\StudentAnswer;
use Illuminate\Support\Facades\Auth;

class StudentExamController extends Controller
{
    public function submitAnswers(Request $request, Lecture $lecture)
    {
        $student = Auth::guard('student')->user();

        foreach ($request->answers as $questionId => $optionId) {
            $option = Option::find($optionId);

            StudentAnswer::create([
                'student_id' => $student->id,
                'lecture_id' => $lecture->id,
                'question_id' => $questionId,
                'option_id' => $optionId,
                'is_correct' => $option->is_correct ?? false,
            ]);
        }

        return redirect()->route('student.exam.result', ['lecture' => $lecture])
    ->with('success', '✅ تم تسليم الاختبار! نذكّرك: ستُعرض لك الأسئلة التي لم تُجب عنها فقط، أما الإجابات المحفوظة فلن تحتاج للرجوع إليها مرة أخرى. استمر نحو النجاح! ✨🚀');

   }

   public function examOverview()
    {
        $student = Auth::guard('student')->user();

        $lectures = \App\Models\Lecture::whereHas('questions', function($q) {
            $q->whereNotNull('id'); // يعني المحاضرة اللي فيها أسئلة
        })->whereHas('subject', function($q) use ($student) {
            $q->where('sub_stage_id', $student->sub_stage_id); // مرتبط بمرحلة الطالب
        })->with(['subject', 'questions'])->get();

        return view('students.exams.overview', compact('lectures', 'student'));
    }

    public function showResult(Lecture $lecture)
    {
        $student = Auth::guard('student')->user();

        $totalQuestions = $lecture->questions()->count();

        $correctAnswers = $student->studentAnswers()
            ->where('lecture_id', $lecture->id)
            ->where('is_correct', true)
            ->count();

        $answeredQuestions = $student->studentAnswers()
            ->where('lecture_id', $lecture->id)
            ->distinct('question_id')
            ->count('question_id'); // مهم: مش عدد السطور، عدد الأسئلة المميزة

        $score = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100) : 0;

        return view('students.exams.result', compact('lecture', 'totalQuestions', 'correctAnswers', 'score', 'answeredQuestions'));
    }
}
