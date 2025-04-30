@extends('layouts.app')

@section('title', 'قائمة المراحل')

@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <a href="{{ route('stages.create') }}" class="btn btn-success">إضافة مرحلة جديدة</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المرحلة</th>
                                    <th>الوصف</th>

                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stages as $stage)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $stage->name }}</td>
                                        <td>{{ $stage->desc ?? 'لا يوجد وصف' }}</td>
                                
                                        <td>
                                            <a href="{{ route('stages.edit', $stage->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                                            <form action="{{ route('stages.destroy', $stage->id) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger delete-btn">حذف</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">لا توجد مرحلة متاحة</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $stages->links('pagination::bootstrap-5') }}
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
