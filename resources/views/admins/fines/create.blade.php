@extends('layouts.app')

@section('title', 'إضافة محاضرة')



@section('content')
    <div class="container">
        <h2>إنشاء غرامة </h2>
        <form action="{{ route('fines.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">اسم الطالب:</label>
                <select name="student_id" class="form-control" required>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">المبلغ:</label>
                <input type="number" name="amount" step="0.01" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">السبب:</label>
                <textarea name="reason" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">الحالة:</label>
                <select name="status" class="form-control">
                    <option value="pending" selected>Pending</option>
                    <option value="paid">Paid</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">إضافة</button>
        </form>
    </div>
@endsection
