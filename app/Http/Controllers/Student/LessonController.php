<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use App\Models\LessonView;
use App\Models\Lecture;

class LessonController extends Controller
{
    public function index(Subject $subject)
    {
        $student = Auth::guard('student')->user();

        if ($subject->sub_stage_id !== $student->sub_stage_id) {
            abort(403, 'غير مسموح لك بالوصول إلى هذه المادة.');
        }

        $lessons = $subject->lectures()->where('sub_stage_id', $student->sub_stage_id)->get();

        return view('students.lessons.index', compact('subject', 'lessons'));
    }

    public function markViewed(Request $request, Lecture $lesson)
    {
        $student = Auth::guard('student')->user();

        $existing = LessonView::where('student_id', $student->id)
                            ->where('lecture_id', $lesson->id)
                            ->first();

        if (! $existing) {
            LessonView::create([
                'student_id' => $student->id,
                'lecture_id' => $lesson->id,
                'viewed_at' => now(),
                'watched_percent' => $request->watched_percent ?? 0
            ]);
        } else {
            $existing->update([
                'watched_percent' => max($existing->watched_percent, $request->watched_percent ?? 0)
            ]);
        }

        return response()->json(['status' => 'recorded']);
    }

    public function questions(Lecture $lesson)
    {
        $student = Auth::guard('student')->user();

        $answeredQuestionIds = \App\Models\StudentAnswer::where('student_id', $student->id)
                                ->where('lecture_id', $lesson->id)
                                ->pluck('question_id')
                                ->toArray();

        $questions = $lesson->questions()
                    ->whereNotIn('id', $answeredQuestionIds)
                    ->with('options')
                    ->get();

        return view('students.lessons.questions', compact('lesson', 'questions'));
    }
}
