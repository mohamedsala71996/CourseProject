@extends('layouts.app')

@section('title', 'قائمة المواد الدراسية')

@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <a href="{{ route('subjects.create') }}" class="btn btn-success">إضافة مادة جديدة</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المادة</th>
                                    <th>الوصف</th>
                                    <th>المرحلة الدراسية</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subjects as $subject)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $subject->desc ?? 'لا يوجد وصف' }}</td>
                                        <td>{{ $subject->subStage->stage->name .': '. $subject->subStage->name ?? 'غير متوفر' }}</td>
                                        <td>
                                            <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                                            <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger delete-btn">حذف</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">لا توجد مواد دراسية متاحة</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $subjects->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // منع الإرسال التقليدي

            Swal.fire({
                title: "هل أنت متأكد؟",
                text: "لن تتمكن من استعادة هذه المادة بعد الحذف!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "نعم، احذفها!"
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData(form);
                    let actionUrl = form.action;

                    fetch(actionUrl, {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-Requested-With": "XMLHttpRequest" // تأكيد أن الطلب Ajax
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire("تم الحذف!", data.message, "success").then(() => {
                                form.closest('tr').remove(); // إزالة الصف من الجدول
                            });
                        } else {
                            Swal.fire("خطأ!", data.message, "error");
                        }
                    })
                    .catch(error => {
                        Swal.fire("خطأ!", "حدث خطأ أثناء الحذف", "error");
                    });
                }
            });
        });
    });
});

</script>

@endsection
