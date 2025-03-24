<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تسجيل دخول الأدمن | منصة الكورسات</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e1b4b);
            color: #fff;
            min-height: 100vh;
            overflow: hidden;
            position: relative;
        }

        .overlay-bg {
            position: absolute;
            inset: 0;
            background: url('https://www.transparenttextures.com/patterns/stardust.png');
            opacity: 0.03;
            z-index: 1;
        }

        .login-wrapper {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-card {
            background: rgba(30, 27, 75, 0.85);
            backdrop-filter: blur(14px);
            border-radius: 18px;
            padding: 40px 30px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 0.6s ease-in-out;
        }

        .login-card h3 {
            font-weight: 700;
            margin-bottom: 10px;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.95);
            border: none;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(102, 16, 242, 0.3);
        }

        .btn-login {
            background: #4f46e5;
            border: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #4338ca;
        }

        .logo-img {
            width: 75px;
            margin-bottom: 20px;
            animation: bounceInDown 1s ease both;
        }

        .footer-text {
            color: #ccc;
            font-size: 13px;
            text-align: center;
            margin-top: 25px;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes bounceInDown {
            0% { opacity: 0; transform: translateY(-200px); }
            60% { opacity: 1; transform: translateY(30px); }
            100% { transform: translateY(0); }
        }
    </style>
</head>
<body dir="rtl">

    <div class="overlay-bg"></div>

    <div class="login-wrapper">
        <div class="login-card animate__animated animate__fadeInUp text-center">

            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Admin Logo" class="logo-img">

            <h3>تسجيل دخول الأدمن</h3>
            <p class="text-muted small mb-4">أهلاً بك في لوحة تحكم منصة الكورسات</p>

            @if(session('error'))
                <div class="alert alert-danger text-white bg-danger-subtle border-0 text-center">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" class="text-start">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label text-white">البريد الإلكتروني</label>
                    <input type="email" name="email" id="email" class="form-control" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-white">كلمة المرور</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="mb-3 text-end">
                    <a href="#" class="text-light small">نسيت كلمة المرور؟</a>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-login btn-lg">تسجيل الدخول</button>
                </div>
            </form>

            <div class="footer-text mt-4">
                &copy; {{ date('Y') }} جميع الحقوق محفوظة - منصة الكورسات
            </div>

        </div>
    </div>

</body>
</html>
