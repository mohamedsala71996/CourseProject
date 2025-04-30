<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admins\QuestionRequest;
use App\Models\Lecture;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    public function index(Lecture $lecture)
    {
        $questions = Question::where('lecture_id', $lecture->id)->with('options')->paginate(10);
        return view('admins.questions.index', compact('questions', 'lecture'));
    }

    public function create(Lecture $lecture)
    {
        return view('admins.questions.create', compact('lecture'));
    }

    public function store(QuestionRequest $request, Lecture $lecture)
    {
        // Handle file uploads
        $videoPath = $request->file('video') ? $request->file('video')->store('videos', 'public') : null;
        $recordPath = $request->file('record') ? $request->file('record')->store('records', 'public') : null;

        // Create the question
        $question = Question::create([
            'lecture_id' => $lecture->id,
            'subject_id' => $lecture->subject_id, // Assuming lecture has a subject_id
            'question_text' => $request->question_text,
            'read_text' => $request->read_text,
            'video' => $videoPath,
            'record' => $recordPath,
        ]);

        // Create options
        foreach ($request->options as $index => $option) {
            $question->options()->create([
                'option_text' => $option['text'],
                'is_correct' => $index == $request->correct_option,
            ]);
        }

        return redirect()->route('lectures.questions.index', $lecture->id)
            ->with('success', 'تم إضافة السؤال بنجاح.');
    }

    public function edit(Lecture $lecture, Question $question)
    {
        // Ensure the question belongs to the lecture
        if ($question->lecture_id !== $lecture->id) {
            abort(404);
        }

        return view('admins.questions.edit', compact('lecture', 'question'));
    }
    public function update(QuestionRequest $request, Lecture $lecture, Question $question)
    {
        // Handle video update
        $videoPath = $question->video;
     if ($request->hasFile('video')) {
            if ($videoPath && Storage::disk('public')->exists($videoPath)) {
                Storage::disk('public')->delete($videoPath); // Delete old video
            }
            $videoPath = $request->file('video')->store('videos', 'public');
        }

        // Handle audio update
        $recordPath = $question->record;
    if ($request->hasFile('record')) {
            if ($recordPath && Storage::disk('public')->exists($recordPath)) {
                Storage::disk('public')->delete($recordPath); // Delete old audio
            }
            $recordPath = $request->file('record')->store('records', 'public');
        }

        // Update the question
        $question->update([
            'question_text' => $request->question_text,
            'read_text' => $request->read_text,
            'video' => $videoPath,
            'record' => $recordPath,
        ]);

        // Sync options
        $question->options()->delete(); // Remove old options
        foreach ($request->options as $index => $option) {
            $question->options()->create([
                'option_text' => $option['text'],
                'is_correct' => $index == $request->correct_option,
            ]);
        }

        return redirect()->route('lectures.questions.index', $lecture->id)
            ->with('success', 'تم تعديل السؤال بنجاح.');
    }

    public function destroy(Lecture $lecture, Question $question)
    {
        try {
            $question->delete();
            return response()->json(['success' => true, 'message' => 'تم حذف السؤال بنجاح!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'فشل في حذف السؤال!'], 500);
        }
    }
}
