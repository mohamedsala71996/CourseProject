@extends('layouts.app')

@section('title', 'إضافة محاضرة')

@section('content')
    <div class="container">
        <h2> إنشاء مرحلة</h2>
        <form action="{{ route('stages.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">إسم المرحلة:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">الوصف:</label>
                <textarea name="desc" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-success">إضافة</button>
        </form>
    </div>
@endsection
