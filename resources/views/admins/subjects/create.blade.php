@extends('layouts.app')

@section('title', 'إضافة مادة دراسية')

@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">إضافة مادة دراسية جديدة</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('subjects.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="sub_stage" class="form-label">المرحلة الفرعية</label>
                                <select name="sub_stage_id" id="sub_stage" class="form-control" required>
                                    <option value="">اختر المرحلة الفرعية</option>
                                    @foreach ($subStages as $subStage)
                                    <option value="{{ $subStage->id }}" {{ old('sub_stage_id') == $subStage->id ? 'selected' : '' }}>
                                        {{ $subStage->stage->name }}: {{ $subStage->name }}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">اسم المادة</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="desc" class="form-label">الوصف</label>
                                <textarea name="desc" id="desc" class="form-control" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-success">حفظ</button>
                            <a href="{{ route('subjects.index') }}" class="btn btn-secondary">إلغاء</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection
