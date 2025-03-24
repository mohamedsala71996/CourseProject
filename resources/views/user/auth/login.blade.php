<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول | منصة الكورسات</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 15px;
        }

        .login-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .login-form {
            padding: 40px 30px;
        }

        .login-form h4 {
            font-weight: bold;
            color: #6b1b1b;
            margin-bottom: 25px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #6b1b1b;
        }

        .btn-primary {
            background-color: #6b1b1b;
            border: none;
        }

        .btn-primary:hover {
            background-color: #500f0f;
        }

        .image-side {
            background-image: url('https://images.pexels.com/photos/1595391/pexels-photo-1595391.jpeg');
            background-size: cover;
            background-position: center;
        }

        .image-overlay {
            background-color: rgba(0, 0, 0, 0.35);
            width: 100%;
            height: 100%;
        }

        @media (max-width: 767px) {
            .image-side {
                display: none;
            }
        }
    </style>
</head>
<body dir="rtl">

<div class="container login-container">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-10">
            <div class="row login-card">
                <!-- الصورة -->
                <div class="col-md-6 image-side d-none d-md-block">
                    <div class="image-overlay"></div>
                </div>

                <!-- الفورم -->
                <div class="col-md-6 login-form">
                    <h4 class="text-center">تسجيل الدخول</h4>

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('user.login.submit') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="mb-3 text-end">
                            <a href="#" class="text-decoration-underline small">نسيت كلمة المرور؟</a>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">تسجيل الدخول</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        ليس لديك حساب؟ <a href="{{ route('user.register') }}" class="text-decoration-underline">سجل الآن</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
