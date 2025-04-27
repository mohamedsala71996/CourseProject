@extends('layouts.app')

@section('title', 'قائمة الطلاب')

@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <form method="GET" class="form-inline">
                                <select name="sub_stage_id" class="form-select me-2" onchange="this.form.submit()">
                                    <option value="">جميع المراحل</option>
                                            @foreach($subStages as $subStage)
                                                <option value="{{ $subStage->id }}" {{ request('sub_stage_id') == $subStage->id ? 'selected' : '' }}>
                                                    {{ $subStage->stage->name }}: {{ $subStage->name }}  
                                                </option>
                                            @endforeach
                                </select>
                            </form>
                        </div>
                        <a href="{{ route('students.create') }}" class="btn btn-success">إضافة طالب جديد</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped align-middle text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الصورة</th>
                                    <th>الاسم</th>
                                    <th>الرقم القومي</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>رقم الهاتف</th>
                                    <th>النوع</th>
                                    <th>المرحلة الدراسية</th>
                                    <th>الحالة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ $student->image_url }}" alt="صورة الطالب" width="40" height="40" class="rounded-circle">
                                        </td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->id_number }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>{{ $student->phone }}</td>
                                        <td>{{ $student->gender_label }}</td>
                                        <td>{{ $student->subStage->stage->name ?? '' }}: {{ $student->subStage->name ?? '' }}</td>
                                        <td>
                                            @if($student->is_blocked)
                                                <span class="badge bg-danger">محظور</span>
                                            @else
                                                <span class="badge bg-success">نشط</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a target="_blank" style="color: white" href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-info">كشف الدرجات</a>
                                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger delete-btn">حذف</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted">لا توجد بيانات طلاب حالياً</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $students->links('pagination::bootstrap-5') }}
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
