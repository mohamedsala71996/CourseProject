@extends('layouts.app')

@section('title', 'قائمة الأسئلة')

@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>أسئلة المحاضرة: {{ $lecture->name }}</h5>
                        <div>
                            <a href="{{ route('lectures.questions.create', $lecture->id) }}" class="btn btn-success">إضافة سؤال جديد</a>
                            <a href="{{ route('lectures.index') }}" class="btn btn-secondary">رجوع إلى المحاضرات</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نص السؤال</th>
                                    <th>الخيارات</th>
                                    <th>مقطع القراءة</th>
                                    <th>الفيديو</th>
                                    <th>المقطع الصوتي</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($questions as $question)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $question->question_text }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($question->options as $option)
                                                    <li>
                                                        {{ $option->option_text }}
                                                        @if ($option->is_correct)
                                                            <span class="text-success ms-2">✔</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            @if ($question->read_text)
                                                {!! $question->read_text !!}
                                            @else
                                                <span class="text-muted">غير متوفر</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($question->video)
                                                <video controls width="200">
                                                    <source src="{{ asset("storage/".$question->video) }}" type="video/mp4">
                                                    المتصفح لا يدعم تشغيل الفيديو.
                                                </video>
                                            @else
                                                <span class="text-muted">غير متوفر</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($question->record)
                                                <audio controls>
                                                    <source src="{{ asset("storage/".$question->record) }}" type="audio/mpeg">
                                                    المتصفح لا يدعم تشغيل الصوت.
                                                </audio>
                                            @else
                                                <span class="text-muted">غير متوفر</span>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Placeholder for edit and delete actions -->
                                            <a href="{{ route('lectures.questions.edit', [$lecture->id, $question->id]) }}" class="btn btn-sm btn-warning">تعديل</a>
                                            <form action="{{ route('lectures.questions.destroy', [$lecture->id, $question->id]) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger delete-btn">حذف</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">لا توجد أسئلة متاحة لهذه المحاضرة</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $questions->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@include('layouts.partials.delete')
@endsection