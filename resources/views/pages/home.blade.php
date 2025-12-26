@extends('layouts.app')

@section('content')
<style>
    /* 1. Global & Theme Colors */
    :root {
        --primary-orange: #e67e22;
        --dark-orange: #d35400;
        --navy-dark: #1a1a2e;
        --gradient-main: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
        --gradient-dark: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    }

    /* 2. Carousel Adjustments */
    .header-carousel .owl-carousel-inner {
        background: rgba(0, 0, 0, 0.4); /* Overlay gelap agar teks terbaca */
    }
    
    .btn-primary {
        background: var(--gradient-main);
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(230, 126, 34, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(230, 126, 34, 0.5);
        background: var(--gradient-main);
    }

    /* 3. Facts Section Modernization */
    .fact-item {
        transition: all 0.4s ease;
        border: 1px solid rgba(0,0,0,0.05);
        background: #fff !important;
    }

    .fact-item:hover {
        background: var(--gradient-main) !important;
        transform: translateY(-10px);
    }

    .fact-item:hover * {
        color: #fff !important;
    }

    /* 4. Product Card Styling (Match Footer Gallery) */
    .product-item {
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }

    .product-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }

    .product-overlay {
        background: rgba(230, 126, 34, 0.85);
    }

    /* 5. Team Social Icons */
    .team-item {
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .team-social a:hover {
        background: var(--gradient-main) !important;
        color: white !important;
    }

    /* 6. Newsletter Section (Sync with Footer) */
    .newsletter-section {
        background: var(--gradient-main) !important;
        border-radius: 20px 20px 0 0 !important;
    }

    .client-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
    }

    /* Typography consistency */
    h1, h2, h3, .display-6 {
        font-family: 'Playfair Display', serif;
    }
</style>

<div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="owl-carousel header-carousel position-relative">
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="{{ asset('baker-1.0.0/img/carousel-1.jpg') }}" alt="">
            <div class="owl-carousel-inner">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-lg-8">
                            <p class="text-primary text-uppercase fw-bold mb-2">// Toko Roti Terbaik</p>
                            <h1 class="display-1 text-light mb-4 animated slideInDown">Jamila Bakery Memanggang dengan Cinta</h1>
                            <p class="text-light fs-5 mb-4 pb-3">Nikmati kelezatan roti dan kue terbaik yang dibuat dengan resep turun temurun dan bahan-bahan pilihan berkualitas tinggi.</p>
                            <a href="{{ route('login') }}" class="btn btn-primary rounded-pill py-3 px-5">Mulai Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="{{ asset('baker-1.0.0/img/carousel-2.jpg') }}" alt="">
            <div class="owl-carousel-inner">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-lg-8">
                            <p class="text-primary text-uppercase fw-bold mb-2">// Kepercayaan Keluarga</p>
                            <h1 class="display-1 text-light mb-4 animated slideInDown">Cita Rasa Autentik Nusantara</h1>
                            <p class="text-light fs-5 mb-4 pb-3">Dari roti tawar yang lembut hingga kue tradisional favorit keluarga, semua dibuat fresh setiap hari.</p>
                            <a href="{{ route('product') }}" class="btn btn-primary rounded-pill py-3 px-5">Lihat Menu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-xxl py-6">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="fact-item rounded text-center h-100 p-5">
                    <i class="fa fa-certificate fa-4x text-primary mb-4"></i>
                    <p class="mb-2">Tahun Berpengalaman</p>
                    <h1 class="display-5 mb-0" data-toggle="counter-up">48</h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.3s">
                <div class="fact-item rounded text-center h-100 p-5">
                    <i class="fa fa-users fa-4x text-primary mb-4"></i>
                    <p class="mb-2">Baker Profesional</p>
                    <h1 class="display-5 mb-0" data-toggle="counter-up">25</h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="fact-item rounded text-center h-100 p-5">
                    <i class="fa fa-bread-slice fa-4x text-primary mb-4"></i>
                    <p class="mb-2">Varian Produk</p>
                    <h1 class="display-5 mb-0" data-toggle="counter-up">85</h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.7s">
                <div class="fact-item rounded text-center h-100 p-5">
                    <i class="fa fa-heart fa-4x text-primary mb-4"></i>
                    <p class="mb-2">Pelanggan Setia</p>
                    <h1 class="display-5 mb-0" data-toggle="counter-up">12500</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-xxl py-6">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row img-twice position-relative h-100">
                    <div class="col-6">
                        <img class="img-fluid rounded shadow-sm" src="{{ asset('baker-1.0.0/img/about-1.jpg') }}" alt="">
                    </div>
                    <div class="col-6 align-self-end">
                        <img class="img-fluid rounded shadow-sm" src="{{ asset('baker-1.0.0/img/about-2.jpg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="h-100">
                    <p class="text-primary text-uppercase mb-2">// Tentang Kami</p>
                    <h1 class="display-6 mb-4">Jamila Bakery - Memanggang dengan Sepenuh Hati</h1>
                    <p>Sejak tahun 1975, Jamila Bakery telah menjadi bagian dari keluarga Indonesia dengan menyediakan roti dan kue berkualitas tinggi menggunakan resep turun temurun.</p>
                    <div class="row g-2 mb-4">
                        <div class="col-sm-6"><i class="fa fa-check text-primary me-2"></i>Produk Berkualitas</div>
                        <div class="col-sm-6"><i class="fa fa-check text-primary me-2"></i>Kue Custom</div>
                        <div class="col-sm-6"><i class="fa fa-check text-primary me-2"></i>Pemesanan Online</div>
                        <div class="col-sm-6"><i class="fa fa-check text-primary me-2"></i>Halal & Higienis</div>
                    </div>
                    <a class="btn btn-primary rounded-pill py-3 px-5" href="{{ route('about') }}">Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-xxl bg-light my-6 py-6 pt-0">
    <div class="container">
        <div class="bg-primary text-light rounded-bottom p-5 my-6 mt-0 wow fadeInUp" data-wow-delay="0.1s" style="background: var(--gradient-main) !important;">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 text-light mb-0">Toko Roti Terbaik di Kota Anda</h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <div class="d-inline-flex align-items-center text-start">
                        <i class="fa fa-phone-alt fa-4x flex-shrink-0"></i>
                        <div class="ms-4">
                            <p class="fs-5 fw-bold mb-0">Hubungi Kami</p>
                            <p class="fs-1 fw-bold mb-0">082237987432</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="text-primary text-uppercase mb-2">// Produk Kami</p>
            <h1 class="display-6 mb-4">Kategori Produk Unggulan</h1>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block border border-primary rounded-pill px-3 mb-3 text-primary fw-bold">Rp 25k - 350k</div>
                        <h3 class="mb-3">Kue & Cake</h3>
                        <p>Pilihan kue ulang tahun dan tart spesial untuk momen berharga Anda.</p>
                    </div>
                    <div class="position-relative mt-auto">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/product-1.jpg') }}" alt="">
                        <div class="product-overlay">
                            <a class="btn btn-lg-square btn-outline-light rounded-circle" href="{{ route('product') }}"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block border border-primary rounded-pill px-3 mb-3 text-primary fw-bold">Rp 8k - 45k</div>
                        <h3 class="mb-3">Roti & Bakery</h3>
                        <p>Roti tawar dan roti manis yang dipanggang fresh setiap pagi.</p>
                    </div>
                    <div class="position-relative mt-auto">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/product-2.jpg') }}" alt="">
                        <div class="product-overlay">
                            <a class="btn btn-lg-square btn-outline-light rounded-circle" href="{{ route('product') }}"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block border border-primary rounded-pill px-3 mb-3 text-primary fw-bold">Rp 5k - 25k</div>
                        <h3 class="mb-3">Cookies</h3>
                        <p>Aneka cookies renyah dan camilan manis untuk teman minum kopi.</p>
                    </div>
                    <div class="position-relative mt-auto">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/product-3.jpg') }}" alt="">
                        <div class="product-overlay">
                            <a class="btn btn-lg-square btn-outline-light rounded-circle" href="{{ route('product') }}"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-xxl py-6">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <p class="text-primary text-uppercase mb-2">// Layanan</p>
                <h1 class="display-6 mb-4">Layanan Terbaik Untuk Anda</h1>
                <p class="mb-5">Kami tidak hanya menjual roti, kami memberikan pengalaman rasa dan pelayanan antar yang memudahkan kebutuhan Anda.</p>
                <div class="row gy-5 gx-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                <i class="fa fa-bread-slice text-white"></i>
                            </div>
                            <h5 class="mb-0">Fresh Daily</h5>
                        </div>
                        <span>Selalu segar setiap hari langsung dari oven.</span>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                <i class="fa fa-truck text-white"></i>
                            </div>
                            <h5 class="mb-0">Home Delivery</h5>
                        </div>
                        <span>Layanan antar aman sampai depan pintu rumah.</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="row img-twice position-relative h-100">
                    <div class="col-6">
                        <img class="img-fluid rounded shadow" src="{{ asset('baker-1.0.0/img/service-1.jpg') }}" alt="">
                    </div>
                    <div class="col-6 align-self-end">
                        <img class="img-fluid rounded shadow" src="{{ asset('baker-1.0.0/img/service-2.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-xxl py-6">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="text-primary text-uppercase mb-2">// Tim Kami</p>
            <h1 class="display-6 mb-4">Bertemu Dengan Ahli Roti Kami</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item text-center rounded overflow-hidden bg-white">
                    <img class="img-fluid" src="{{ asset('baker-1.0.0/img/team-1.jpg') }}" alt="">
                    <div class="team-text p-4">
                        <h5>Chef Jamila</h5>
                        <span>Founder</span>
                        <div class="team-social mt-3">
                            <a class="btn btn-square btn-light rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-light rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </div>
</div>
<div class="container-xxl bg-light my-6 py-6 pb-0">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="text-primary text-uppercase mb-2">// Testimoni</p>
            <h1 class="display-6 mb-4">Apa Kata Pelanggan Kami?</h1>
        </div>
        
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            <div class="testimonial-item bg-white rounded p-4">
                <div class="rating mb-3 text-primary">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <img class="flex-shrink-0 rounded-circle border p-1 client-image" src="{{ asset('baker-1.0.0/img/testimonial-1.jpg') }}" alt="">
                    <div class="ms-4">
                        <h5 class="mb-1">Siti Nurhaliza</h5>
                        <span>Pelanggan Setia</span>
                    </div>
                </div>
                <p class="mb-0">"Roti tawarnya sangat lembut, cocok untuk sarapan keluarga kami setiap pagi!"</p>
            </div>
            </div>
        
        <div class="newsletter-section text-light p-5 my-6 mb-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4 text-light mb-0">Langganan Info Promo</h1>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="position-relative mt-3 mt-md-0">
                        <input class="form-control bg-transparent border-light w-100 py-3 ps-4 pe-5 text-white" type="text" placeholder="Email Anda">
                        <button type="button" class="btn btn-dark py-2 px-3 position-absolute top-0 end-0 mt-2 me-2">Daftar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection