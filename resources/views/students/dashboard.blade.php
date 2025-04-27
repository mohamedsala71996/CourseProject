@extends('layouts.student')

@section('title', 'الصفحة الرئيسية للطالب')

@section('content')

<!-- نهاية شريط التنقل -->

<!-- بداية السلايدر -->
<div id="arabicCarousel" class="carousel slide mb-5" data-bs-ride="carousel" dir="rtl">
    <div class="carousel-inner rounded-4 shadow" style="max-width: 2200px; margin: auto; overflow: hidden;">

      <!-- العنصر الأول -->
      <div class="carousel-item active">
        <div class="position-relative" style="height: 700px;">
          <img src="{{ asset('student/img/carousel-1.jpg') }}" class="w-100 h-100" style="object-fit: cover;" alt="صورة 1">
          <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, 0.65);">
            <div class="container text-end">
              <div class="col-lg-8 ms-auto">
                <h5 class="text-primary text-uppercase mb-3">أفضل الدورات عبر الإنترنت</h5>
                <h1 class="display-5 fw-bold text-white mb-3">أفضل منصة للتعلم الإلكتروني</h1>
                <p class="fs-5 text-white mb-4">نقدم لكم أفضل المحتوى التعليمي بجودة عالية وبطريقة سهلة ومبسطة تناسب جميع المستويات.</p>
                <a href="#" class="btn btn-primary py-2 px-4 me-2">اقرأ المزيد</a>
                <a href="{{ route('student.login') }}" class="btn btn-light py-2 px-4">انضم الآن</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- العنصر الثاني -->
      <div class="carousel-item">
        <div class="position-relative" style="height: 700px;">
          <img src="{{ asset('student/img/carousel-2.jpg') }}" class="w-100 h-100" style="object-fit: cover;" alt="صورة 2">
          <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, 0.65);">
            <div class="container text-end">
              <div class="col-lg-8 ms-auto">
                <h5 class="text-primary text-uppercase mb-3">أفضل الدورات عبر الإنترنت</h5>
                <h1 class="display-5 fw-bold text-white mb-3">احصل على التعليم من منزلك</h1>
                <p class="fs-5 text-white mb-4">تعلم في أي وقت ومن أي مكان مع أفضل المدربين والمحتوى التعليمي المتميز.</p>
                <a href="#" class="btn btn-primary py-2 px-4 me-2">اقرأ المزيد</a>
                <a href="{{ route('student.login') }}" class="btn btn-light py-2 px-4">انضم الآن</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- أزرار التنقل -->
    <button class="carousel-control-prev" type="button" data-bs-target="#arabicCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#arabicCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
  <!-- نهاية السلايدر -->
  

<!-- بداية الخدمات -->
<div class="container-xxl py-5" dir="rtl">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item text-center pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-graduation-cap text-primary mb-4"></i>
                        <h5 class="mb-3">مدربون محترفون</h5>
                        <p>نقدم لك أفضل المدربين ذوي الخبرة والكفاءة العالية في مجالاتهم</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item text-center pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                        <h5 class="mb-3">فصول عبر الإنترنت</h5>
                        <p>تعلم من أي مكان في العالم مع فصولنا التفاعلية عبر الإنترنت</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item text-center pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-chart-line text-primary mb-4"></i>
                        <h5 class="mb-3">متابعة أدائك</h5>
                        <p>تابع تقدمك خطوة بخطوة من خلال تقارير الأداء الذكية</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="service-item text-center pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-clipboard-check text-primary mb-4"></i>
                        <h5 class="mb-3">اختبارات كل مرحلة</h5>
                        <p>قيّم مستواك من خلال اختبارات بعد كل مرحلة دراسية</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- نهاية الخدمات -->

<!-- بداية قسم من نحن -->
<div class="container-xxl py-5" dir="rtl" id="about" class="section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="img-fluid position-absolute w-100 h-100" src="{{ asset('student/img/about.jpg') }}" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <h6 class="section-title bg-white text-end text-primary pe-3">من نحن</h6>
                <h1 class="mb-4">مرحبًا بكم في منصة التعلم الإلكتروني</h1>
                <p class="mb-4">نحن منصة رائدة في مجال التعليم الإلكتروني، نقدم محتوى تعليمي عالي الجودة يلبي احتياجات الطلاب بمختلف مستوياتهم.</p>
                <p class="mb-4">نسعى دائمًا لتطوير أساليبنا وتقديم الأفضل لطلابنا لضمان تجربة تعليمية ممتعة وفعالة.</p>
                <div class="row gy-2 gx-4 mb-4">
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-left text-primary me-2"></i>مدربون محترفون</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-left text-primary me-2"></i>فصول عبر الإنترنت</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-left text-primary me-2"></i>شهادات معتمدة دوليًا</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-left text-primary me-2"></i>دعم فني متواصل</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-left text-primary me-2"></i>مرونة في أوقات الدراسة</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-left text-primary me-2"></i>أسعار تنافسية</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- نهاية قسم من نحن -->

<!-- بداية المراحل التعليمية -->
<div class="container-xxl py-5 category" dir="rtl" id="courses" class="section">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">المراحل</h6>
            <h1 class="mb-5">مراحل التعليم في منصتنا</h1>
        </div>
        <div class="row g-3">
            <div class="col-lg-7 col-md-6">
                <div class="row g-3">
                    <!-- المتوسط -->
                    <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                        <a class="position-relative d-block overflow-hidden" href="#">
                            <img class="img-fluid" src="{{ asset('student/img/cat-1.jpg') }}" alt="مرحلة المتوسط">
                            <div class="bg-white text-center position-absolute bottom-0 start-0 py-2 px-3">
                                <h5 class="m-0">المرحلة المتوسطة</h5>
                                <small class="text-primary">مواد تأسيسية واختبارات تقييمية</small>
                            </div>
                        </a>
                    </div>
                    <!-- الثانوي -->
                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                        <a class="position-relative d-block overflow-hidden" href="#">
                            <img class="img-fluid" src="{{ asset('student/img/cat-2.jpg') }}" alt="مرحلة الثانوي">
                            <div class="bg-white text-center position-absolute bottom-0 start-0 py-2 px-3">
                                <h5 class="m-0">المرحلة الثانوية</h5>
                                <small class="text-primary">مواد تخصصية واختبارات مرحلية</small>
                            </div>
                        </a>
                    </div>
                    <!-- الجامعي -->
                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                        <a class="position-relative d-block overflow-hidden" href="#">
                            <img class="img-fluid" src="{{ asset('student/img/cat-3.jpg') }}" alt="مرحلة الجامعة">
                            <div class="bg-white text-center position-absolute bottom-0 start-0 py-2 px-3">
                                <h5 class="m-0">المرحلة الجامعية</h5>
                                <small class="text-primary">مقررات أكاديمية واختبارات نهائية</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- STEP -->
            <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                <a class="position-relative d-block h-100 overflow-hidden" href="#">
                    <img class="img-fluid position-absolute w-100 h-100" src="{{ asset('student/img/cat-4.jpg') }}" style="object-fit: cover;" alt="اختبار STEP">
                    <div class="bg-white text-center position-absolute bottom-0 start-0 py-2 px-3">
                        <h5 class="m-0">اختبار STEP</h5>
                        <small class="text-primary">تقييم نهائي لمستوى اللغة</small>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- نهاية المراحل التعليمية -->

<!-- بداية المدربين -->
<div class="container-xxl py-5" dir="rtl" id="team" class="section">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">المدربون</h6>
            <h1 class="mb-5">مدربون خبراء</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item bg-light">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="{{ asset('student/img/team-1.jpg') }}">
                    </div>
                    <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                        <div class="bg-light d-flex justify-content-center pt-2 px-1">
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center p-4">
                        <h5 class="mb-0">اسم المدرب</h5>
                        <small>التخصص</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item bg-light">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="{{ asset('student/img/team-2.jpg') }}">
                    </div>
                    <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                        <div class="bg-light d-flex justify-content-center pt-2 px-1">
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center p-4">
                        <h5 class="mb-0">اسم المدرب</h5>
                        <small>التخصص</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="team-item bg-light">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="{{ asset('student/img/team-3.jpg') }}">
                    </div>
                    <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                        <div class="bg-light d-flex justify-content-center pt-2 px-1">
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center p-4">
                        <h5 class="mb-0">اسم المدرب</h5>
                        <small>التخصص</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="team-item bg-light">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="{{ asset('student/img/team-4.jpg') }}">
                    </div>
                    <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                        <div class="bg-light d-flex justify-content-center pt-2 px-1">
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center p-4">
                        <h5 class="mb-0">اسم المدرب</h5>
                        <small>التخصص</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- نهاية المدربين -->

@endsection
