@extends('layouts.student')

@section('title', 'المواد الدراسية')

@section('content')
<style>
    .subject-table th, .subject-table td {
        vertical-align: middle;
    }

    .subject-icon {
        font-size: 1.2rem;
        color: #6b1b1b;
    }

    .table-hover tbody tr:hover {
        background-color: #f3f3f3;
    }
</style>

<div class="container py-5" dir="rtl">
    <div class="text-center mb-4">
        <h2 class="text-primary"><i class="fas fa-layer-group me-2"></i>مرحلتك الحالية: {{ $subStage->name }}</h2>
    </div>

    @if($subjects->count())
        <div class="table-responsive">
            <table class="table table-bordered table-hover subject-table shadow-sm">
                <thead class="table-dark text-center">
                    <tr>
                        <th>#</th>
                        <th><i class="fas fa-book-open me-1"></i>اسم المادة</th>
                        <th><i class="fas fa-align-left me-1"></i>الوصف</th>
                        <th><i class="fas fa-cogs me-1"></i>الإجراء</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($subjects as $index => $subject)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->desc ?? 'لا يوجد وصف' }}</td>
                            <td>
                                <a href="{{ route('subject.lessons', $subject->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye me-1"></i>عرض الدروس
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle me-2"></i> لا توجد مواد دراسية مرتبطة بمرحلتك حتى الآن.
        </div>
    @endif
</div>
@endsection
