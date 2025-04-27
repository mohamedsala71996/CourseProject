@extends('layouts.app')

@section('title', 'تفاصيل الطالب')

@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>تفاصيل الطالب: {{ $student->name }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="form-control-static">الاسم: {{ $student->name }}</p>
                            </div>                                  
                            <div class="col-md-6">
                                <p class="form-control-static">المرحلة: {{ $student->subStage->stage->name }}</p>
                            </div>
                        </div>

                        <div class="accordion" id="subjectsAccordion">
                            @foreach($student->subStage->subjects as $subject)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $subject->id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                            data-bs-target="#collapse{{ $subject->id }}" aria-expanded="false" 
                                            aria-controls="collapse{{ $subject->id }}">
                                        {{ $subject->name }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $subject->id }}" class="accordion-collapse collapse" 
                                     aria-labelledby="heading{{ $subject->id }}" data-bs-parent="#subjectsAccordion">
                                    <div class="accordion-body">
                                        <div class="accordion" id="lecturesAccordion{{ $subject->id }}">
                                            @foreach($subject->lectures as $lecture)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading{{ $lecture->id }}">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                                            data-bs-target="#collapse{{ $lecture->id }}" aria-expanded="true" 
                                                            aria-controls="collapse{{ $lecture->id }}">
                                                        {{ $lecture->name }}
                                                    </button>
                                                </h2>
                                                <div id="collapse{{ $lecture->id }}" class="accordion-collapse collapse" 
                                                     aria-labelledby="heading{{ $lecture->id }}" 
                                                     data-bs-parent="#lecturesAccordion{{ $subject->id }}">
                                                    <div class="accordion-body">
                                                        {{-- Grades Summary --}}
                                                        @if($lecture->grades->where('student_id', $student->id)->first())
                                                        <div class="card mb-4">
                                                            <div class="card-header bg-light">
                                                                <h6>تقرير الدرجات</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <p>الدرجة: 
                                                                            {{ $lecture->grades->where('student_id', $student->id)->first()->total_score }} 
                                                                            من 
                                                                            {{ $lecture->grades->where('student_id', $student->id)->first()->max_score }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <p>النسبة المئوية: {{ $lecture->grades->where('student_id', $student->id)->first()->percentage }}%</p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <p>الحالة: 
                                                                            <span class="badge {{ $lecture->grades->where('student_id', $student->id)->first()->status == 'pass' ? 'bg-success' : 'bg-danger' }}">
                                                                                {{ $lecture->grades->where('student_id', $student->id)->first()->status == 'pass' ? 'ناجح' : 'راسب' }}
                                                                            </span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif

                                                        {{-- Questions and Answers --}}
                                                        @foreach($student->answers as $answer)
                                                        <div class="card mb-3">
                                                            <div class="card-header">
                                                                <h6>السؤال: {{ $answer->question->question_text }}</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <ul class="list-group">
                                                                    @foreach($answer->question->options as $option)
                                                                    @php
                                                                        $isCorrect = $option->is_correct;
                                                                        $isCorrectStudentAnswer = $option->is_correct && $answer->option_id == $option->id;
                                                                        $isSelected = $answer->option_id == $option->id;
                                                                    @endphp
                                                                    <li class="list-group-item 
                                                                        {{ $isCorrect ? 'list-group-item-success' : '' }}
                                                                        {{ $isSelected && !$isCorrect ? 'list-group-item-danger' : '' }}">
                                                                        {{ $option->option_text }}
                                                                        @if($isCorrectStudentAnswer)
                                                                            <span class="badge bg-success float-end">إجابة صحيحة</span>
                                                                        @elseif($isSelected)
                                                                            <span class="badge bg-danger float-end">إجابة خاطئة</span>
                                                                        @endif
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">رجوع</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h5>كشف الدرجات الكلي</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>المادة</th>
                        <th>الدرجة</th>
                        <th>النسبة المئوية</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($student->subStage->subjects as $subject)
                    @php
                        $totalScore = 0;
                        $maxScore = 0;
                        $lectureCount = 0;
                    @endphp
                    @foreach($subject->lectures as $lecture)
                        @if($lecture->grades->where('student_id', $student->id)->first())
                            @php
                                $totalScore += $lecture->grades->where('student_id', $student->id)->first()->total_score;
                                $maxScore += $lecture->grades->where('student_id', $student->id)->first()->max_score;
                                $lectureCount++;
                            @endphp
                        @endif
                    @endforeach
                    @if($lectureCount > 0)
                    <tr>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $totalScore }} من {{ $maxScore }}</td>
                        <td>{{ round(($totalScore/$maxScore)*100, 2) }}%</td>
                        <td>
                            <span class="badge {{ ($totalScore/$maxScore)*100 >= 50 ? 'bg-success' : 'bg-danger' }}">
                                {{ ($totalScore/$maxScore)*100 >= 50 ? 'ناجح' : 'راسب' }}
                            </span>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}
@endsection