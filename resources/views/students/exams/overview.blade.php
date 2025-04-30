@extends('layouts.student')

@section('title', 'تقييمك العام')

@section('content')
<div class="container py-5" dir="rtl">
    <h3 class="text-center text-primary mb-4">📚 تقييمك العام لكل دروسك</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>الدرس</th>
                    <th>المادة</th>
                    <th>نسبة الحل</th>
                    <th>التقييم</th>
                    <th>الحالة</th> {{-- ✅ دي العمود الجديد --}}
                </tr>
            </thead>
            <tbody>
                @foreach($lectures as $index => $lecture)
                    @php
                        $questionsCount = $lecture->questions->count();
                        $studentAnswersCount = $student->studentAnswers()
                            ->where('lecture_id', $lecture->id)
                            ->distinct('question_id') // الطالب ممكن يجاوب كذا مره لازم نجيب السؤال مره واحده
                            ->count('question_id');

                        $correctAnswers = $student->studentAnswers()
                            ->where('lecture_id', $lecture->id)
                            ->where('is_correct', true)
                            ->count();

                        $percentage = $questionsCount > 0 ? round(($correctAnswers / $questionsCount) * 100) : 0;
                        $allAnswered = ($studentAnswersCount == $questionsCount) && ($questionsCount > 0);
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $lecture->name }}</td>
                        <td>{{ $lecture->subject->name ?? 'بدون مادة' }}</td>
                        <td>{{ $questionsCount > 0 ? $percentage . '%' : 'لا يوجد اختبار' }}</td>
                        <td>
                            @if($questionsCount == 0)
                                <span class="badge bg-secondary">لا يوجد تقييم</span>
                            @elseif($percentage >= 70)
                                <span class="badge bg-success">ناجح ✅</span>
                            @else
                                <span class="badge bg-danger">راسب ❌</span>
                            @endif
                        </td>
                        <td>
                            @if($questionsCount == 0)
                                <span class="badge bg-secondary">لا يوجد اختبار</span>
                            @elseif($allAnswered)
                                <span class="badge bg-primary">تم الحل بالكامل 🎯</span>
                            @else
                                <span class="badge bg-warning text-dark">لم يتم الحل بالكامل ⚡</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
