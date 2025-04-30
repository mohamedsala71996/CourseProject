@extends('layouts.app')

@section('title', 'إضافة محاضرة')

@section('content')
    <div class="container">
        <h2>Add New SubStage</h2>
        <form action="{{ route('sub_stages.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>إسم المرحلة</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>الوصف</label>
                <textarea name="desc" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label>المرحلة</label>
                <select name="stage_id" class="form-control" required>
                    @foreach($stages as $stage)
                        <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">إضافة</button>
            <a href="{{ route('sub_stages.index') }}" class="btn btn-secondary">إلغاء</a>
        </form>
    </div>
@endsection