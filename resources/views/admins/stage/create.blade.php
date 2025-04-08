@extends('layouts.app')

@section('title', 'إضافة محاضرة')

@section('content')
    <div class="container">
        <h2>Create Stage</h2>
        <form action="{{ route('stages.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description:</label>
                <textarea name="desc" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
