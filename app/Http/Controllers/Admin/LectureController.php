<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Models\Stage;
use App\Models\Subject;
use App\Models\SubStage;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    public function index()
    {
        $lectures = Lecture::with(['subject', 'subStage'])->paginate(10);
        return view('admins.lectures.index', compact('lectures'));
    }

    public function create()
    {
        $stages = Stage::all();
        return view('admins.lectures.create', compact('stages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        Lecture::create($request->all());

        return redirect()->route('lectures.index')->with('success', 'تم إضافة المحاضرة بنجاح.');
    }

    public function edit( $id)
    {
        $lecture = Lecture::find($id);
        $stages = Stage::all();
        return view('admins.lectures.edit', compact('lecture', 'stages'));
    }

    public function update(Request $request, Lecture $lecture)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $lecture->update($request->all());

        return redirect()->route('lectures.index')->with('success', 'تم تحديث المحاضرة بنجاح.');
    }

    public function destroy(Lecture $lecture)
    {
        try {
            $lecture->delete();
            return response()->json(['success' => true, 'message' => 'تم حذف المحاضرة بنجاح!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'فشل في حذف المحاضرة!'], 500);
        }
    }
}
