@extends('layouts.app')

@section('title', 'تعديل محاضرة')

@section('content')
    <div class="container">
        <h2>Edit Stage</h2>
        <form action="{{ route('stages.update', $stage->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Name:</label>
                <input type="text" name="name" class="form-control" value="{{ $stage->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description:</label>
                <textarea name="desc" class="form-control">{{ $stage->desc }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
