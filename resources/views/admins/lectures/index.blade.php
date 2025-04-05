@extends('layouts.app')

@section('title', 'قائمة المحاضرات')

@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <a href="{{ route('lectures.create') }}" class="btn btn-success">إضافة محاضرة جديدة</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المحاضرة</th>
                                    <th>الوصف</th>
                                    <th>المادة الدراسية</th>
                                    <th>المرحلة الدراسية</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lectures as $lecture)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lecture->name }}</td>
                                        <td>{{ $lecture->desc ?? 'لا يوجد وصف' }}</td>
                                        <td>{{ $lecture->subject->name ?? 'غير متوفر' }}</td>
                                        <td>{{ $lecture->subStage->stage->name .': '. $lecture->subStage->name  }}</td>
                                        <td>
                                            <a target="_blank" style="color: white" href="{{ route('lectures.questions.index', $lecture->id) }}" class="btn btn-sm btn-info">عرض الأسئلة</a>
                                            <a href="{{ route('lectures.edit', $lecture->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                                            <form action="{{ route('lectures.destroy', $lecture->id) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger delete-btn">حذف</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">لا توجد محاضرات متاحة</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $lectures->links('pagination::bootstrap-5') }}
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
