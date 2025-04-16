@extends('layouts.app')

@section('title', 'تعديل محاضرة')


@section('content')
    <div class="container">
        <h2>Edit Fine</h2>
        <form action="{{ route('fines.update', $fine->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">إسم الطالب:</label>
                <select name="student_id" class="form-control" required>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ $fine->student_id == $student->id ? 'selected' : '' }}>
                            {{ $student->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">مبلغ الغرامة:</label>
                <input type="number" name="amount" step="0.01" class="form-control" value="{{ $fine->amount }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">السبب:</label>
                <textarea name="reason" class="form-control" required>{{ $fine->reason }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">الحالة:</label>
                <select name="status" class="form-control">
                    <option value="pending" {{ $fine->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ $fine->status == 'paid' ? 'selected' : '' }}>Paid</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">تحديث</button>
        </form>
    </div>
@endsection

