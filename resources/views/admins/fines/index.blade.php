@extends('layouts.app')

@section('title', 'قائمة المراحل')

@section('content')
   
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <a href="{{ route('fines.create') }}" class="btn btn-primary">Create Fine</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>إسم الطالب</th>
                                        <th>مبلغ الغرامة</th>
                                        <th>السبب</th>
                                        <th>الحالة</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fines as $fine)
                                        <tr>
                                            <td>{{ $fine->student->name }}</td>
                                            <td>{{ $fine->amount }}</td>
                                            <td>{{ $fine->reason }}</td>
                                            <td>{{ $fine->status }}</td>
                                            <td>
                                                <a href="{{ route('fines.edit', $fine) }}" class="btn btn-sm btn-warning">تعديل</a>
                                                <form action="{{ route('fines.destroy', $fine) }}" method="POST" class="d-inline delete-form">

                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger delete-btn">حذف</button>
                                            </form>
                                               
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            {{ $fines->links('pagination::bootstrap-5') }}
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
