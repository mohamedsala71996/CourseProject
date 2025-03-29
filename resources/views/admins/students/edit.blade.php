@extends('layouts.app')

@section('title', 'تعديل الطالب')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">تعديل بيانات الطالب</div>
        <div class="card-body">
            <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">الاسم</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name', $student->name) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">الرقم القومي</label>
                    <input type="text" name="id_number" class="form-control" required value="{{ old('id_number', $student->id_number) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email', $student->email) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">كلمة المرور (اتركها فارغة إن لم ترغب بالتغيير)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">رقم الهاتف</label>
                    <input type="text" name="phone" class="form-control" required value="{{ old('phone', $student->phone) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">المرحلة الفرعية</label>
                    <select name="sub_stage_id" class="form-control" required>
                        <option value="">اختر المرحلة الفرعية</option>
                        @foreach ($subStages as $subStage)
                            <option value="{{ $subStage->id }}" {{ old('sub_stage_id', $student->sub_stage_id) == $subStage->id ? 'selected' : '' }}>
                                {{ $subStage->stage->name }}: {{ $subStage->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">النوع</label>
                    <select name="gender" class="form-control">
                        <option value="">غير محدد</option>
                        <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>ذكر</option>
                        <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>أنثى</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">تاريخ الميلاد</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $student->date_of_birth) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">الحالة</label>
                    <select name="is_blocked" class="form-control">
                        <option value="0" {{ $student->is_blocked == 0 ? 'selected' : '' }}>نشط</option>
                        <option value="1" {{ $student->is_blocked == 1 ? 'selected' : '' }}>محظور</option>
                    </select>
                </div>


                <div class="mb-3">
                    <label class="form-label">الصورة الشخصية</label>
                    <input type="file" name="image" class="form-control">
                    @if ($student->image)
                        <img src="{{ $student->image_url }}" alt="صورة الطالب" width="60" class="mt-2 rounded">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">تحديث</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">إلغاء</a>
            </form>
        </div>
    </div>
</div>
@endsection
