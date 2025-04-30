@extends('layouts.student')

@section('title', 'تسجيل الدخول | منصة الكورسات')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #f9f9f9, #f1f1f1);
    }

    .login-container {
        min-height: calc(100vh - 100px); /* تقليل المسافة بين الهيدر والفوتر */
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px 20px;
    }

    .login-card {
        background-color: #fff;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        display: flex;
        flex-wrap: wrap;
        max-width: 1000px;
        width: 100%;
        transition: transform 0.3s;
    }

    .login-card:hover {
        transform: scale(1.01);
    }

    .image-side {
        background-image: url('https://images.pexels.com/photos/1595391/pexels-photo-1595391.jpeg');
        background-size: cover;
        background-position: center;
        min-height: 400px;
    }

    .login-form {
        padding: 50px 40px;
    }

    .login-form h4 {
        font-weight: bold;
        color: #6b1b1b;
        margin-bottom: 30px;
        text-align: center;
    }

    .form-label {
        font-weight: bold;
        color: #444;
    }

    .form-control {
        height: 50px;
        font-size: 16px;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #6b1b1b;
    }

    .btn-primary {
        background-color: #6b1b1b;
        border: none;
        transition: background-color 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #500f0f;
    }

    .text-muted a {
        color: #6b1b1b;
    }

    @media (max-width: 767px) {
        .image-side {
            display: none;
        }

        .login-form {
            padding: 30px 20px;
        }
    }
</style>

<div class="container login-container">
    <div class="login-card row w-100">
        <!-- الصورة -->
        <div class="col-md-6 image-side d-none d-md-block"></div>

        <!-- الفورم -->
        <div class="col-md-6 login-form">
            <h4>تسجيل الدخول</h4>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('student.login.submit') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">كلمة المرور</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="mb-3 text-end">
                    <a href="#" class="text-decoration-underline small text-muted">نسيت كلمة المرور؟</a>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">تسجيل الدخول</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
