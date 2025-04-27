@extends('layouts.student')

@section('title', 'المخالفات')

@section('content')
<div class="container py-5" dir="rtl">
    <h3 class="text-center text-danger mb-4">⚠️ قائمة المخالفات الخاصة بك</h3>

    @if($fines->count())
        <div class="table-responsive">
            <table class="table table-bordered table-hover shadow-sm text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>المبلغ</th>
                        <th>السبب</th>
                        <th>الحالة</th>
                        <th>تاريخ السداد</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fines as $index => $fine)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ number_format($fine->amount, 2) }}</td>
                            <td>{{ $fine->reason }}</td>
                            <td>
                                @if($fine->status === 'paid')
                                    <span class="badge bg-success">مدفوع</span>
                                @else
                                    <span class="badge bg-danger">قيد الانتظار</span>
                                @endif
                            </td>
                            <td>{{ $fine->paid_at ? \Carbon\Carbon::parse($fine->paid_at)->format('Y-m-d') : 'لم يتم السداد' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info text-center">
            لا توجد مخالفات حالياً 🎉
        </div>
    @endif
</div>
@endsection
