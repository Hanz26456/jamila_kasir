<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <title>@yield('title', 'Jamila Bakery -  Pujer Bondowoso')</title>
    <meta name="description" content="Jamila Bakery adalah aplikasi kasir digital modern untuk mengelola penjualan, stok bahan, dan laporan keuangan secara cepat, akurat, dan mudah digunakan. Cocok untuk bisnis bakery yang ingin berkembang lebih efisien.">
    <meta name="keywords" content="Jamila Bakery">
    <meta name="author" content="Farhan Maulana">
    <meta name="robots" content="index, follow">

    <link rel="icon" type="image/png" href="{{ asset('images/logohitam.png') }}">
<link rel="shortcut icon" type="image/png" href="{{ asset('images/logohitam.png') }}">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://jamilakasir.up.railway.app/">
    <meta property="og:title" content="Jamila Bakery - Inovasi Kasir Digital">
    <meta property="og:description" content="Kelola stok dan transaksi bakery lebih efisien dengan sistem terintegrasi Jamila Bakery.">
    <meta property="og:image" content="{{ asset('baker-1.0.0/img/about-1.jpg') }}">

    <link href="{{ asset('baker-1.0.0/img/favicon.ico') }}" rel="icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"> 

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('baker-1.0.0/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <link href="{{ asset('baker-1.0.0/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('baker-1.0.0/css/style.css') }}" rel="stylesheet">
    
    <style>
        .testimonial-item {
            transition: transform 0.3s ease;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
        }
        .testimonial-item:hover { transform: translateY(-5px); }
        .testimonial-carousel .owl-nav button {
            width: 50px; height: 50px;
            border-radius: 50%;
            background-color: #e67e22 !important;
            color: white !important;
            margin: 0 10px;
        }
        .client-image { width: 60px; height: 60px; object-fit: cover; }
        .rating { color: #ffc107; }
    </style>
</head>
<body>
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('baker-1.0.0/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('baker-1.0.0/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('baker-1.0.0/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('baker-1.0.0/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('baker-1.0.0/js/main.js') }}"></script>

    <script>
        $(document).ready(function(){
            $(".testimonial-carousel").owlCarousel({
                autoplay: true, autoplayTimeout: 5000, smartSpeed: 1000,
                dots: true, loop: true, nav: true,
                navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
                responsive: {
                    0: { items: 1 },
                    768: { items: 2 },
                    992: { items: 3 }
                }
            });
        });
    </script>
</body>
</html>