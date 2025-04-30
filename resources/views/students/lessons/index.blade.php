@extends('layouts.student')

@section('title', 'الدروس - ' . $subject->name)

@section('content')
<div class="container py-5" dir="rtl">
    <div class="text-center mb-4">
        <h2 class="text-primary">
            <i class="fas fa-book-reader me-2"></i>دروس مادة: {{ $subject->name }}
        </h2>
    </div>

    @if($lessons->count())
        <div class="table-responsive">
            <table class="table table-bordered table-hover shadow-sm text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th><i class="fas fa-book me-1"></i>اسم الدرس</th>
                        <th><i class="fas fa-align-left me-1"></i>الوصف</th>
                        <th><i class="fas fa-cogs me-1"></i>العملية</th>
                        <th><i class="fas fa-user-check me-1"></i>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lessons as $index => $lesson)
                        @php
                            $questionsCount = $lesson->questions->count(); // أسئلة الدرس
                            $studentAnswersCount = auth('student')->user()
                                ->studentAnswers()
                                ->where('lecture_id', $lesson->id)
                                ->distinct('question_id')
                                ->count('question_id');
                            $allAnswered = $questionsCount > 0 && $studentAnswersCount == $questionsCount;
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $lesson->name }}</td>
                            <td>{{ $lesson->desc ?? 'لا يوجد وصف' }}</td>
                            <td>
                                {{-- زر عرض الأسئلة --}}
                                <a href="{{ route('student.lesson.questions', $lesson->id) }}" class="btn btn-sm btn-primary mb-1">
                                    <i class="fas fa-question-circle me-1"></i>عرض الأسئلة
                                </a>
                            </td>
                            <td>
                                @if($questionsCount == 0)
                                    <span class="badge bg-secondary">لا يوجد اختبار</span>
                                @elseif($allAnswered)
                                    <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>تم الحضور</span>
                                @else
                                    <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i>لم يحضر بعد</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning text-center">
            <i class="fas fa-exclamation-circle me-2"></i> لا توجد دروس مضافة حتى الآن.
        </div>
    @endif
</div>
@endsection
