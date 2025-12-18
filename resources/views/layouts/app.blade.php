<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Jamila Bakery')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="{{ asset('baker-1.0.0/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('baker-1.0.0/lib/animate/animate.min.css') }}" rel="stylesheet">
    <!-- Ganti dengan CDN untuk memastikan Owl Carousel dimuat -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <!-- Bootstrap & Template CSS -->
    <link href="{{ asset('baker-1.0.0/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('baker-1.0.0/css/style.css') }}" rel="stylesheet">
    
    <!-- Custom CSS untuk testimonial -->
    <style>
        .testimonial-item {
            transition: transform 0.3s ease;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
        }
        
        .testimonial-item:hover {
            transform: translateY(-5px);
        }
        
        .testimonial-carousel .owl-nav button {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #e67e22 !important;
            color: white !important;
            margin: 0 10px;
        }
        
        .client-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }
        
        .rating {
            color: #ffc107;
        }
    </style>
</head>
<body>
    <!-- Spinner -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>

    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- jQuery (Wajib ditaruh sebelum library lain) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Bootstrap Bundle -->
    <script src="{{ asset('baker-1.0.0/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Libraries -->
    <script src="{{ asset('baker-1.0.0/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('baker-1.0.0/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('baker-1.0.0/lib/waypoints/waypoints.min.js') }}"></script>
    <!-- Ganti dengan CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('baker-1.0.0/js/main.js') }}"></script>

    <!-- Testimonial Carousel Script -->
    <script>
        $(document).ready(function(){
            $(".testimonial-carousel").owlCarousel({
                autoplay: true,
                autoplayTimeout: 5000,
                smartSpeed: 1000,
                center: false,
                dots: true,
                loop: true,
                nav: true,
                navText: [
                    '<i class="fas fa-chevron-left"></i>',
                    '<i class="fas fa-chevron-right"></i>'
                ],
                responsive: {
                    0: {
                        items: 1,
                        margin: 20
                    },
                    768: {
                        items: 2,
                        margin: 30
                    },
                    992: {
                        items: 3,
                        margin: 30
                    }
                }
            });
        });
    </script>
</body>
</html>