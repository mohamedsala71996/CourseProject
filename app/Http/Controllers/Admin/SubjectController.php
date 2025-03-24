<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admins\SubjectRequest;
use App\Models\Stage;
use App\Models\Subject;
use App\Models\SubStage;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('subStage')->paginate(10);
        return view('admins.subjects.index', compact('subjects'));
    }

    // Show the form for creating a new subject
    public function create()
    {
        $stages = Stage::all();
        return view('admins.subjects.create', compact('stages'));
    }

    public function store(SubjectRequest $request)
    {
        try {

            Subject::create($request->all());
            return redirect()->route('admin.subjects.index')->with('success', 'تم إضافة المادة بنجاح.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إضافة المادة.');
        }
    }

    public function edit($id)
    {
        $subject = Subject::find($id);
        $stages = Stage::all();
        return view('admins.subjects.edit', compact('subject', 'stages'));
    }

    public function update(SubjectRequest $request, $id)
    {
        try {
            $subject = Subject::find($id);
            $subject->update($request->all());
            
            return redirect()->route('subjects.index')->with('success', 'تم تحديث المادة بنجاح.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث المادة.');
        }
    }

    public function destroy(Subject $subject)
    {
        abort_if(!$subject, 404, 'Subject not found.');
        try {
            $subject->delete();

            return response()->json(['success' => true, 'message' => 'تم حذف المادة بنجاح!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'فشل في حذف المادة!'], 500);
        }
    }

    public function getSubStages($stage_id)
    {
        $subStages = SubStage::where('stage_id', $stage_id)->get();
        return response()->json(['subStages' => $subStages]);
    }

    public function getSubjects($sub_stage_id)
    {
        $subjects = Subject::where('sub_stage_id', $sub_stage_id)->get();
        return response()->json(['subjects' => $subjects]);
    }
}
