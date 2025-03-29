@extends('layouts.app')

@section('title', 'إضافة طالب')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">إضافة طالب جديد</div>
        <div class="card-body">
            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">الاسم</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">الرقم القومي</label>
                    <input type="text" name="id_number" class="form-control" required value="{{ old('id_number') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">كلمة المرور</label>
                    <input type="password" name="password" class="form-control" required>
                </div>


                <div class="mb-3">
                    <label class="form-label">رقم الهاتف</label>
                    <input type="text" name="phone" class="form-control" required value="{{ old('phone') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">المرحلة الفرعية</label>
                    <select name="sub_stage_id" class="form-control" required>
                        <option value="">اختر المرحلة الفرعية</option>
                        @foreach ($subStages as $subStage)
                            <option value="{{ $subStage->id }}" {{ old('sub_stage_id') == $subStage->id ? 'selected' : '' }}>
                                {{ $subStage->stage->name }}: {{ $subStage->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">النوع</label>
                    <select name="gender" class="form-control">
                        <option value="">غير محدد</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">تاريخ الميلاد</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">الصورة الشخصية</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">إضافة</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">إلغاء</a>
            </form>
        </div>
    </div>
</div>
@endsection
