@extends('layouts.app')

@section('title', 'تعديل محاضرة')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">تعديل المحاضرة: {{ $lecture->name }}</div>
        <div class="card-body">
            <form action="{{ route('lectures.update', $lecture->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="stage" class="form-label">المرحلة الدراسية</label>
                    <select name="stage_id" id="stage" class="form-control" required>
                        <option value="">اختر المرحلة</option>
                        @foreach ($stages as $stage)
                            <option value="{{ $stage->id }}" {{ $stage->id == $lecture->subStage->stage->id ? 'selected' : '' }}>
                                {{ $stage->name }} 
                            </option>
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
                    <input type="text" name="name" class="form-control" value="{{ $lecture->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">الوصف</label>
                    <textarea name="desc" class="form-control" rows="3">{{ $lecture->desc }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">تحديث</button>
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

        const currentSubStage = "{{ $lecture->sub_stage_id }}"; // المرحلة الفرعية الحالية
        const currentSubject = "{{ $lecture->subject_id }}"; // المادة الدراسية الحالية

        function loadSubStages(stageId, selectedSubStage = null) {
            subStageSelect.innerHTML = '<option value="">جارٍ التحميل...</option>';
            subjectSelect.innerHTML = '<option value="">اختر المادة الدراسية</option>'; // إعادة تعيين المواد
            
            if (stageId) {
                fetch(`/get-sub-stages/${stageId}`)
                    .then(response => response.json())
                    .then(data => {
                        subStageSelect.innerHTML = '<option value="">اختر المرحلة الفرعية</option>';
                        data.subStages.forEach(subStage => {
                            subStageSelect.innerHTML += `<option value="${subStage.id}" ${selectedSubStage == subStage.id ? 'selected' : ''}>${subStage.name}</option>`;
                        });

                        // تحميل المواد الدراسية بعد تحديد المرحلة الفرعية
                        if (selectedSubStage) {
                            loadSubjects(selectedSubStage, currentSubject);
                        }
                    })
                    .catch(error => {
                        subStageSelect.innerHTML = '<option value="">حدث خطأ، حاول مرة أخرى</option>';
                    });
            } else {
                subStageSelect.innerHTML = '<option value="">اختر المرحلة الفرعية</option>';
            }
        }

        function loadSubjects(subStageId, selectedSubject = null) {
            subjectSelect.innerHTML = '<option value="">جارٍ التحميل...</option>';

            if (subStageId) {
                fetch(`/get-subjects/${subStageId}`)
                    .then(response => response.json())
                    .then(data => {
                        subjectSelect.innerHTML = '<option value="">اختر المادة الدراسية</option>';
                        data.subjects.forEach(subject => {
                            subjectSelect.innerHTML += `<option value="${subject.id}" ${selectedSubject == subject.id ? 'selected' : ''}>${subject.name}</option>`;
                        });
                    })
                    .catch(error => {
                        subjectSelect.innerHTML = '<option value="">حدث خطأ، حاول مرة أخرى</option>';
                    });
            }
        }

        // تحميل المراحل الفرعية عند تغيير المرحلة الدراسية
        stageSelect.addEventListener('change', function () {
            loadSubStages(this.value);
        });

        // تحميل المواد عند تغيير المرحلة الفرعية
        subStageSelect.addEventListener('change', function () {
            loadSubjects(this.value);
        });

        // تحميل البيانات عند فتح الصفحة
        if (stageSelect.value) {
            loadSubStages(stageSelect.value, currentSubStage);
        }
    });
</script>
@endsection
