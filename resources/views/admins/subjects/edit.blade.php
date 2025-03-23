@extends('layouts.app')

@section('title', 'تعديل المادة الدراسية')

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
                        <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">اسم المادة</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $subject->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="desc" class="form-label">الوصف</label>
                                <textarea name="desc" id="desc" class="form-control" rows="3">{{ $subject->desc }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="stage" class="form-label">المرحلة الدراسية</label>
                                <select name="stage_id" id="stage" class="form-control" required>
                                    <option value="">اختر المرحلة</option>
                                    @foreach ($stages as $stage)
                                        <option value="{{ $stage->id }}" {{ $stage->id == $subject->subStage->stage->id ? 'selected' : '' }}>
                                            {{ $stage->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="sub_stage" class="form-label">المرحلة الفرعية</label>
                                <select name="sub_stage_id" id="sub_stage" class="form-control" required>

                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">تحديث</button>
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const stageSelect = document.getElementById('stage');
        const subStageSelect = document.getElementById('sub_stage');
        const currentSubStage = "{{ $subject->sub_stage_id }}"; // المرحلة الفرعية الحالية

        function loadSubStages(stageId, selectedSubStage = null) {
            subStageSelect.innerHTML = '<option value="">جارٍ التحميل...</option>';
            
            if (stageId) {
                fetch(`/get-sub-stages/${stageId}`)
                    .then(response => response.json())
                    .then(data => {
                        subStageSelect.innerHTML = '<option value="">اختر المرحلة الفرعية</option>';
                        data.subStages.forEach(subStage => {
                            subStageSelect.innerHTML += `<option value="${subStage.id}" ${selectedSubStage == subStage.id ? 'selected' : ''}>${subStage.name}</option>`;
                        });
                    })
                    .catch(error => {
                        subStageSelect.innerHTML = '<option value="">حدث خطأ، حاول مرة أخرى</option>';
                    });
            } else {
                subStageSelect.innerHTML = '<option value="">اختر المرحلة الفرعية</option>';
            }
        }

        stageSelect.addEventListener('change', function () {
            loadSubStages(this.value);
        });

        // تحميل المراحل الفرعية عند فتح الصفحة
        if (stageSelect.value) {
            loadSubStages(stageSelect.value, currentSubStage);
        }
    });
</script>
@endsection