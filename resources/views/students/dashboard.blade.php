
@section('title', 'لوحة الطالب')

@section('content')
<div class="container py-5">
    <div class="alert alert-success text-center">
        <h4>مرحبًا {{ Auth::guard('student')->user()->name }} 👋</h4>
        <p>أنت الآن في لوحة تحكم الطالب.</p>
    </div>

    <form method="POST" action="{{ route('student.logout') }}">
        @csrf
        <div class="text-center">
            <button type="submit" class="btn btn-danger">تسجيل الخروج</button>
        </div>
    </form>
</div>
