@extends('layouts.student')

@section('title', 'نتيجة الامتحان')

@section('content')
<div class="container py-5" dir="rtl">
    <div class="card text-center">
        <div class="card-header bg-primary text-white">
            نتيجة الامتحان - {{ $lecture->name }}
        </div>
        <div class="card-body">

            @php
                $allAnswered = ($totalQuestions == $answeredQuestions);
            @endphp

            @if($allAnswered)
                <h4 class="card-title text-success">عدد الأسئلة: {{ $totalQuestions }}</h4>
                <h4 class="card-title text-success">عدد الإجابات الصحيحة: {{ $correctAnswers }}</h4>
                <h4 class="card-title text-info">نسبتك: {{ $score }}%</h4>

                @if($score >= 50)
                    <h4 class="text-success mt-4">🎉 مبروك، لقد نجحت!</h4>
                @else
                    <h4 class="text-danger mt-4">❌ لم تحقق نسبة النجاح المطلوبة.</h4>
                @endif
            @else
                <div class="alert alert-warning">
                    <h5 class="text-warning"><i class="fas fa-exclamation-triangle me-2"></i>⏳ لم تُكمل جميع أسئلة الاختبار!</h5>
                    <p>للحصول على تقييم دقيق، يُرجى العودة وإكمال بقية الأسئلة.</p>
                    <a href="{{ route('student.lesson.questions', $lecture->id) }}" class="btn btn-outline-primary mt-3">
                        <i class="fas fa-arrow-left"></i> الرجوع إلى الاختبار
                    </a>
                </div>
            @endif

        </div>

        <div class="card-footer text-muted">
            بالتوفيق دائمًا!
        </div>
    </div>
</div>
@endsection
