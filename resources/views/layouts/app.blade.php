<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <title>@yield('title', 'Jamila Bakery - Pujer Bondowoso')</title>
    <meta name="description" content="Jamila Bakery adalah aplikasi kasir digital modern untuk mengelola penjualan, stok bahan, dan laporan keuangan.">
    <meta name="author" content="Farhan Maulana">

    <link rel="icon" type="image/png" href="{{ asset('images/logohitam.png') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet"> 

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('baker-1.0.0/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <link href="{{ asset('baker-1.0.0/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('baker-1.0.0/css/style.css') }}" rel="stylesheet">
    
    <style>
        /* Perbaikan Warna Global agar sesuai tema Oranye */
        :root {
            --primary: #e67e22;
            --secondary: #1a1a2e;
        }

        body {
            font-family: 'Roboto', sans-serif;
            overflow-x: hidden;
        }

        h1, h2, h3, .font-playfair {
            font-family: 'Playfair Display', serif;
        }

        /* Spinner Color Match */
        .spinner-grow {
            color: #e67e22 !important;
        }

        /* Testimonial Carousel Tweaks */
        .testimonial-carousel .owl-nav {
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }
        
        .testimonial-carousel .owl-nav button {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e67e22, #d35400) !important;
            color: white !important;
            font-size: 14px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        /* Tambahan Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow" role="status"></div>
    </div>

    @include('partials.navbar')

    <div style="margin-top: 0px;"> 
        @yield('content')
    </div>

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
            // WOW Init
            new WOW().init();

            // Testimonial Carousel
            $(".testimonial-carousel").owlCarousel({
                autoplay: true,
                autoplayTimeout: 4000,
                smartSpeed: 1000,
                dots: true,
                loop: true,
                nav: true,
                margin: 25,
                navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
                responsive: {
                    0: { items: 1 },
                    768: { items: 2 },
                    992: { items: 3 }
                }
            });

            // Header Carousel (Pastikan carousel utama jalan)
            $(".header-carousel").owlCarousel({
                autoplay: true,
                smartSpeed: 1500,
                items: 1,
                dots: false,
                loop: true,
                nav: true,
                navText : [
                    '<i class="bi bi-chevron-left"></i>',
                    '<i class="bi bi-chevron-right"></i>'
                ]
            });
        });
    </script>
</body>
</html>