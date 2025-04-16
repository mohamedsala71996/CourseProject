@extends('layouts.app')

@section('title', 'قائمة الأسئلة')

@section('content')
@section('content')
<div class="container">
    <h2>Settings</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST">
        @csrf

        @foreach($settings as $key => $value)
            <div class="mb-3">
                <label for="{{ $key }}" class="form-label">{{ ucwords(str_replace('_', ' ', $key)) }}</label>
                <input type="text" class="form-control" id="{{ $key }}" name="{{ $key }}" value="{{ $value }}">
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Update Settings</button>
    </form>
</div>
@endsection