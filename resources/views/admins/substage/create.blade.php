@extends('layouts.app')

@section('title', 'إضافة محاضرة')

@section('content')
    <div class="container">
        <h2>Add New SubStage</h2>
        <form action="{{ route('sub_stages.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="desc" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label>Stage</label>
                <select name="stage_id" class="form-control" required>
                    @foreach($stages as $stage)
                        <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('sub_stages.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection