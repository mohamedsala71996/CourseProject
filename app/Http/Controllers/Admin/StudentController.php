<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admins\StudentRequest;
use App\Models\Student;
use App\Models\SubStage;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $subStages = SubStage::with('stage')->get();
        $subStageId = request('sub_stage_id');
        
        $students = Student::when($subStageId, function($query) use ($subStageId) {
                return $query->where('sub_stage_id', $subStageId);
            })
            ->with('subStage.stage')
            ->latest()
            ->paginate(10);
    
        return view('admins.students.index', compact('students', 'subStages'));
    }

    public function create()
    {
        $subStages = SubStage::all();
        return view('admins.students.create', compact('subStages'));
    }

    public function store(StudentRequest $request)
{
    $data = $request->validated();

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('students', 'public');
    }

    $data['password'] = bcrypt($request->password);

    Student::create($data);

    return redirect()->route('students.index')->with('success', 'تم إضافة الطالب بنجاح.');
}

    public function show(Student $student)
    {
        $student->load([
            'subStage.subjects.lectures' => function($query) {
                $query->with(['questions.options', 'grades']);
            },
            'answers' => function($query) {
                $query->with('option.question');
            }
        ]);
        
        return view('admins.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $subStages = SubStage::all();
        return view('admins.students.edit', compact('student', 'subStages'));
    }

    public function update(StudentRequest $request, Student $student)
{
    $data = $request->validated();

    if ($request->hasFile('image')) {
        if ($student->image) {
            Storage::disk('public')->delete($student->image);
        }

        $data['image'] = $request->file('image')->store('students', 'public');
    }

    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    } else {
        unset($data['password']);
    }

    $student->update($data);

    return redirect()->route('students.index')->with('success', 'تم تحديث بيانات الطالب بنجاح.');
}


    public function destroy(Student $student)
    {
        if ($student->image) {
            Storage::disk('public')->delete($student->image);
        }

        $student->delete();

        return redirect()->route('students.index')->with('success', 'تم حذف الطالب بنجاح.');
    }

}
