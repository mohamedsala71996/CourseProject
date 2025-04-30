@extends('layouts.student')

@section('title', 'الأسئلة الخاصة بـ: ' . $lesson->name)

@section('content')
<style>
    .quiz-container {
        max-width: 900px;
        margin: auto;
        background: #ffffff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .quiz-question {
        font-weight: bold;
        font-size: 20px;
        color: #333;
    }

    .quiz-option {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 12px 15px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .quiz-option:hover {
        background-color: #f3f4f6;
    }

    .form-check-input:checked + .form-check-label {
        background-color: #d1e7dd;
        border-radius: 8px;
    }

    .submit-btn {
        background-color: #6b1b1b;
        border: none;
        padding: 10px 30px;
        font-size: 18px;
        border-radius: 10px;
        transition: background-color 0.3s;
    }

    .submit-btn:hover {
        background-color: #500f0f;
    }

    .resource-icons {
        float: left;
        display: flex;
        gap: 10px;
    }

    .resource-icons i {
        font-size: 22px;
        color: #0d6efd;
        cursor: pointer;
    }
</style>

<div class="container py-5" dir="rtl">
    <div class="quiz-container">
        <h3 class="text-center mb-4 text-primary">
            📚 الأسئلة الخاصة بـ: {{ $lesson->name }}
        </h3>

        @if($questions->count())
            <form action="{{ route('student.exam.submit', $lesson->id) }}" method="POST">
                @csrf
                @foreach($questions as $index => $question)
                    <div class="mb-5">
                        <div class="d-flex justify-content-between align-items-start">
                            <p class="quiz-question">
                                <i class="fas fa-question-circle me-2 text-warning"></i> سؤال {{ $index + 1 }}: {{ $question->question_text }}
                            </p>
                            <div class="resource-icons">
                                @if($question->read_text)
                                    <i class="fas fa-book-open" data-bs-toggle="modal" data-bs-target="#readModal{{ $question->id }}"></i>
                                @endif
                                @if($question->video)
                                    <i class="fas fa-video" data-bs-toggle="modal" data-bs-target="#videoModal{{ $question->id }}"></i>
                                @endif
                                @if($question->record)
                                    <i class="fas fa-volume-up" data-bs-toggle="modal" data-bs-target="#audioModal{{ $question->id }}"></i>
                                @endif
                            </div>
                        </div>

                        @foreach($question->options as $option)
                            <div class="form-check quiz-option">
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}" class="form-check-input" id="option{{ $option->id }}">
                                <label class="form-check-label w-100" for="option{{ $option->id }}">
                                    {{ $option->option_text }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    {{-- مودال القراءة --}}
                    @if($question->read_text)
                        <div class="modal fade" id="readModal{{ $question->id }}" tabindex="-1" aria-labelledby="readModalLabel{{ $question->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="readModalLabel{{ $question->id }}">مقطع القراءة</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                                    </div>
                                    <div class="modal-body">
                                        {!! $question->read_text !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- مودال الفيديو --}}
                    @if($question->video)
                        <div class="modal fade" id="videoModal{{ $question->id }}" tabindex="-1" aria-labelledby="videoModalLabel{{ $question->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="videoModalLabel{{ $question->id }}">فيديو الشرح</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <video controls width="100%" style="border-radius: 10px;">
                                            <source src="{{ asset('storage/' . $question->video) }}" type="video/mp4">
                                            المتصفح لا يدعم تشغيل الفيديو.
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- مودال الصوت --}}
                    @if($question->record)
                        <div class="modal fade" id="audioModal{{ $question->id }}" tabindex="-1" aria-labelledby="audioModalLabel{{ $question->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="audioModalLabel{{ $question->id }}">مقطع صوتي</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <audio controls style="width: 100%;">
                                            <source src="{{ asset('storage/' . $question->record) }}" type="audio/mpeg">
                                            المتصفح لا يدعم تشغيل الصوت.
                                        </audio>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                @endforeach

                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-success submit-btn">🚀 تسليم الإجابات</button>
                </div>
            </form>
        @else
            <div class="alert alert-warning text-center">
                <i class="fas fa-exclamation-circle me-2"></i> لا توجد أسئلة لهذه المحاضرة حالياً.
            </div>
        @endif
    </div>
</div>
@endsection
