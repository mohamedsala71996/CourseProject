<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <title>التعليم الإلكتروني - قالب HTML تعليمي</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="تعلم، دورات، تعليم إلكتروني" name="keywords">
    <meta content="أفضل منصة تعليم إلكتروني باللغة العربية" name="description">

    <!-- Favicon -->
    <link href="{{ asset('student/img/favicon.ico') }}" rel="icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">

    <!-- Icon Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries -->
    <link href="{{ asset('student/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('student/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('student/css/style.css') }}" rel="stylesheet">
</head>

<body>
<!-- بداية مؤشر التحميل -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">جاري التحميل...</span>
    </div>
</div>
<!-- نهاية مؤشر التحميل -->
<!-- بداية شريط التنقل -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>التعلم الإلكتروني</h2>
    </a>

    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ url('/') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">الرئيسية</a>
            <a href="{{ url('/#about') }}" class="nav-item nav-link">من نحن</a>
            <a href="{{ url('/#courses') }}" class="nav-item nav-link">المراحل</a>
            <a href="{{ url('/#team') }}" class="nav-item nav-link">فريقنا</a>
            <a href="{{ url('/#contact') }}" class="nav-item nav-link">اتصل بنا</a>


            @auth('student')
                <!-- دروب داون للصفحات -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown">
                        مرحلتك التعليمية
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('student.subjects') }}">📚 المواد الدراسية</a></li>
                        <li><a class="dropdown-item" href="{{ route('student.exam.overview') }}">📝 تقييمك العام</a></li>
                        <li><a class="dropdown-item" href="{{ route('student.fines') }}">⚠️ المخالفات</a></li>
                    </ul>
                </li>

            @endauth
        </div>

        <!-- زر الدخول أو تسجيل الخروج -->
        <div class="d-none d-lg-block px-4">
            @guest('student')
                <a href="{{ route('student.login') }}" class="btn btn-primary py-3 px-4">انضم الآن <i class="fa fa-arrow-left ms-2"></i></a>
            @endguest

            @auth('student')
                <form action="{{ route('student.logout') }}" method="POST" id="logout-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger py-3 px-4">تسجيل الخروج <i class="fa fa-arrow-left ms-2"></i></button>
                </form>
            @endauth
        </div>
    </div>
</nav>

    @yield('content')
<!-- بداية التذييل -->
<div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s" dir="rtl" id="contact" class="section">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">اتصل بنا</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 الشارع، الرياض، السعودية</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+966 12 345 6789</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">النشرة البريدية</h4>
                <p>اشترك في نشرتنا البريدية لتصلك آخر الأخبار والعروض.</p>
                <div class="position-relative mx-auto" style="max-width: 400px;">
                    <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="بريدك الإلكتروني">
                    <button type="button" class="btn btn-primary py-2 position-absolute top-0 start-0 mt-2 me-2">اشتراك</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-end mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">تعلم </a>, جميع الحقوق محفوظة.
                </div>
            </div>
        </div>
    </div>
</div>
<!-- نهاية التذييل -->


<!-- زر العودة للأعلى -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('student/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('student/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('student/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('student/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('student/js/main.js') }}"></script>

</body>
</html>
