@extends('layouts.app')

@section('title', 'إضافة محاضرة')



@section('content')
    <div class="container">
        <h2>Create Fine</h2>
        <form action="{{ route('fines.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Student:</label>
                <select name="student_id" class="form-control" required>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Amount:</label>
                <input type="number" name="amount" step="0.01" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Reason:</label>
                <textarea name="reason" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Status:</label>
                <select name="status" class="form-control">
                    <option value="pending" selected>Pending</option>
                    <option value="paid">Paid</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Save Fine</button>
        </form>
    </div>
@endsection
