@extends('layouts.app')

@section('title', 'إضافة محاضرة')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">إضافة محاضرة جديدة</div>
        <div class="card-body">
            <form action="{{ route('lectures.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="stage" class="form-label">المرحلة الدراسية</label>
                    <select name="stage_id" id="stage" class="form-control" required>
                        <option value="">اختر المرحلة</option>
                        @foreach ($stages as $stage)
                            <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="sub_stage" class="form-label">المرحلة الفرعية</label>
                    <select name="sub_stage_id" id="sub_stage" class="form-control" required>
                        <option value="">اختر المرحلة الفرعية</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="subject" class="form-label">المادة الدراسية</label>
                    <select name="subject_id" id="subject" class="form-control" required>
                        <option value="">اختر المادة الدراسية</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">اسم المحاضرة</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">الوصف</label>
                    <textarea name="desc" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-success">إضافة</button>
                <a href="{{ route('lectures.index') }}" class="btn btn-secondary">إلغاء</a>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const stageSelect = document.getElementById('stage');
        const subStageSelect = document.getElementById('sub_stage');
        const subjectSelect = document.getElementById('subject');

        // عند اختيار المرحلة الدراسية، يتم تحميل المراحل الفرعية
        stageSelect.addEventListener('change', function () {
            const stageId = this.value;
            subStageSelect.innerHTML = '<option value="">جارٍ التحميل...</option>';
            subjectSelect.innerHTML = '<option value="">اختر المادة الدراسية</option>'; // إعادة تعيين المواد

            if (stageId) {
                fetch(`/get-sub-stages/${stageId}`)
                    .then(response => response.json())
                    .then(data => {
                        subStageSelect.innerHTML = '<option value="">اختر المرحلة الفرعية</option>';
                        data.subStages.forEach(subStage => {
                            subStageSelect.innerHTML += `<option value="${subStage.id}">${subStage.name}</option>`;
                        });
                    })
                    .catch(error => {
                        subStageSelect.innerHTML = '<option value="">حدث خطأ، حاول مرة أخرى</option>';
                    });
            } else {
                subStageSelect.innerHTML = '<option value="">اختر المرحلة الفرعية</option>';
            }
        });

        // عند اختيار المرحلة الفرعية، يتم تحميل المواد الدراسية
        subStageSelect.addEventListener('change', function () {
            const subStageId = this.value;
            subjectSelect.innerHTML = '<option value="">جارٍ التحميل...</option>';

            if (subStageId) {
                fetch(`/get-subjects/${subStageId}`)
                    .then(response => response.json())
                    .then(data => {
                        subjectSelect.innerHTML = '<option value="">اختر المادة الدراسية</option>';
                        data.subjects.forEach(subject => {
                            subjectSelect.innerHTML += `<option value="${subject.id}">${subject.name}</option>`;
                        });
                    })
                    .catch(error => {
                        subjectSelect.innerHTML = '<option value="">حدث خطأ، حاول مرة أخرى</option>';
                    });
            } else {
                subjectSelect.innerHTML = '<option value="">اختر المادة الدراسية</option>';
            }
        });
    });
</script>
@endsection
