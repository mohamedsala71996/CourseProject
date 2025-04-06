@extends('layouts.app')

@section('title', 'تعديل محاضرة')


@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">تعديل المادة الدراسية</h3>
                    </div>
                    <div class="card-body">
              
                    <form action="{{ route('sub_stages.update', $subStage) }}" method="POST">
                  
                            @csrf
                            @method('PUT')
              
                            <div class="mb-3">
                                <label for="name" class="form-label">اسم المادة</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $subStage->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="desc" class="form-label">الوصف</label>
                                <textarea name="desc" id="desc" class="form-control" rows="3">{{ $subStage->desc }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="stage" class="form-label">المرحلة الدراسية</label>
                                <select name="stage_id" id="stage" class="form-control" required>
                          
        @foreach ($stages as $stage)
            <option value="{{ $stage->id }}" {{ $subStage->stage_id == $stage->id ? 'selected' : '' }}>
                {{ $stage->name }}
            </option>
        @endforeach
    </select>
</div>
                            <button type="submit" class="btn btn-success">تحديث</button>
                            <a href="{{ route('sub_stages.index') }}" class="btn btn-secondary">إلغاء</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




