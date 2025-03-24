<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إنشاء حساب | منصة الكورسات</title>
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

        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 15px;
        }

        .register-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .register-form {
            padding: 40px 30px;
        }

        .register-form h4 {
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
            background-image: url('https://images.pexels.com/photos/3184328/pexels-photo-3184328.jpeg');
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

<div class="container register-container">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-10">
            <div class="row register-card">
                <!-- الصورة -->
                <div class="col-md-6 image-side d-none d-md-block">
                    <div class="image-overlay"></div>
                </div>

                <!-- الفورم -->
                <div class="col-md-6 register-form">
                    <h4 class="text-center">إنشاء حساب جديد</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('user.register.submit') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم الكامل</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">رقم الهاتف (اختياري)</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">تسجيل الحساب</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        لديك حساب؟ <a href="{{ route('user.login') }}" class="text-decoration-underline">تسجيل الدخول</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
