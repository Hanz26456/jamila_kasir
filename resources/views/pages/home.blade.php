@extends('layouts.app')

@section('content')
<!-- Carousel Start -->
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
                            <a href="{{ route('login') }}"class="btn btn-primary rounded-pill py-3 px-5">Mulai Sekarang</a>
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
                            <p class="text-primary text-uppercase fw-bold mb-2">// Kepercayaan Keluarga Indonesia</p>
                            <h1 class="display-1 text-light mb-4 animated slideInDown">Cita Rasa Autentik Nusantara</h1>
                            <p class="text-light fs-5 mb-4 pb-3">Dari roti tawar yang lembut hingga kue tradisional favorit keluarga, semua dibuat fresh setiap hari dengan standar kebersihan terbaik.</p>
                            <a href="" class="btn btn-primary rounded-pill py-3 px-5">Lihat Menu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="{{ asset('baker-1.0.0/img/carousel-1.jpg') }}" alt="">
            <div class="owl-carousel-inner">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-lg-8">
                            <p class="text-primary text-uppercase fw-bold mb-2">// Kualitas Terjamin</p>
                            <h1 class="display-1 text-light mb-4 animated slideInDown">Jamila Bakery - Warisan Rasa</h1>
                            <p class="text-light fs-5 mb-4 pb-3">Sejak 2011, kami telah melayani jutaan keluarga Indonesia dengan produk berkualitas tinggi dan pelayanan terpercaya.</p>
                            <a href="" class="btn btn-primary rounded-pill py-3 px-5">Hubungi Kami</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->

<!-- Facts Start -->
<div class="container-xxl py-6">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="fact-item bg-light rounded text-center h-100 p-5">
                    <i class="fa fa-certificate fa-4x text-primary mb-4"></i>
                    <p class="mb-2">Tahun Berpengalaman</p>
                    <h1 class="display-5 mb-0" data-toggle="counter-up">48</h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.3s">
                <div class="fact-item bg-light rounded text-center h-100 p-5">
                    <i class="fa fa-users fa-4x text-primary mb-4"></i>
                    <p class="mb-2">Baker Profesional</p>
                    <h1 class="display-5 mb-0" data-toggle="counter-up">25</h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="fact-item bg-light rounded text-center h-100 p-5">
                    <i class="fa fa-bread-slice fa-4x text-primary mb-4"></i>
                    <p class="mb-2">Varian Produk</p>
                    <h1 class="display-5 mb-0" data-toggle="counter-up">85</h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.7s">
                <div class="fact-item bg-light rounded text-center h-100 p-5">
                    <i class="fa fa-heart fa-4x text-primary mb-4"></i>
                    <p class="mb-2">Pelanggan Setia</p>
                    <h1 class="display-5 mb-0" data-toggle="counter-up">12500</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Facts End -->

<!-- About Start -->
<div class="container-xxl py-6">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row img-twice position-relative h-100">
                    <div class="col-6">
                        <img class="img-fluid rounded" src="{{ asset('baker-1.0.0/img/about-1.jpg') }}" alt="Jamila Bakery - Proses Pembuatan Roti">
                    </div>
                    <div class="col-6 align-self-end">
                        <img class="img-fluid rounded" src="{{ asset('baker-1.0.0/img/about-2.jpg') }}" alt="Jamila Bakery - Produk Berkualitas">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="h-100">
                    <p class="text-primary text-uppercase mb-2">// Tentang Kami</p>
                    <h1 class="display-6 mb-4">Jamila Bakery - Memanggang dengan Sepenuh Hati</h1>
                    <p>
                        Sejak tahun 1975, Jamila Bakery telah menjadi bagian dari keluarga Indonesia dengan menyediakan 
                        roti dan kue berkualitas tinggi. Kami bangga menggunakan bahan-bahan pilihan terbaik dan resep 
                        turun temurun yang telah dipercaya selama puluhan tahun.
                    </p>
                    <p>
                        Setiap produk Jamila Bakery dibuat dengan dedikasi tinggi oleh para baker berpengalaman. 
                        Kami berkomitmen untuk selalu menghadirkan cita rasa autentik yang mengingatkan akan kehangatan 
                        rumah dan kebersamaan keluarga. Kepuasan pelanggan adalah prioritas utama kami.
                    </p>
                    <div class="row g-2 mb-4">
                        <div class="col-sm-6">
                            <i class="fa fa-check text-primary me-2"></i>Produk Berkualitas Tinggi
                        </div>
                        <div class="col-sm-6">
                            <i class="fa fa-check text-primary me-2"></i>Kue Custom Sesuai Pesanan
                        </div>
                        <div class="col-sm-6">
                            <i class="fa fa-check text-primary me-2"></i>Pemesanan Online Mudah
                        </div>
                        <div class="col-sm-6">
                            <i class="fa fa-check text-primary me-2"></i>Layanan Antar Gratis
                        </div>
                        <div class="col-sm-6">
                            <i class="fa fa-check text-primary me-2"></i>Bahan-bahan Pilihan
                        </div>
                        <div class="col-sm-6">
                            <i class="fa fa-check text-primary me-2"></i>Halal dan Higienis
                        </div>
                    </div>
                    <a class="btn btn-primary rounded-pill py-3 px-5" href="">Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

    <!-- Product Start -->
<div class="container-xxl bg-light my-6 py-6 pt-0">
    <div class="container">
        <div class="bg-primary text-light rounded-bottom p-5 my-6 mt-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 text-light mb-0">Toko Roti Terbaik di Kota Anda</h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <div class="d-inline-flex align-items-center text-start">
                        <i class="fa fa-phone-alt fa-4x flex-shrink-0"></i>
                        <div class="ms-4">
                            <p class="fs-5 fw-bold mb-0">Hubungi Kami</p>
                            <p class="fs-1 fw-bold mb-0">+628237982432</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="text-primary text-uppercase mb-2">// Produk Jamila Bakery</p>
            <h1 class="display-6 mb-4">Jelajahi Kategori Produk Roti dan Kue Kami</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block border border-primary rounded-pill px-3 mb-3">Rp 25.000 - Rp 350.000</div>
                        <h3 class="mb-3">Kue & Cake</h3>
                        <span>Berbagai pilihan kue ulang tahun, kue tart, black forest, dan kue tradisional Indonesia yang dibuat dengan bahan berkualitas tinggi dan cita rasa istimewa</span>
                    </div>
                    <div class="position-relative mt-auto">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/product-1.jpg') }}" alt="Kue dan Cake Jamila Bakery">
                        <div class="product-overlay">
                            <a class="btn btn-lg-square btn-outline-light rounded-circle" href=""><i class="fa fa-eye text-primary"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block border border-primary rounded-pill pt-1 px-3 mb-3">Rp 8.000 - Rp 45.000</div>
                        <h3 class="mb-3">Roti & Bakery</h3>
                        <span>Roti tawar, roti manis, croissant, donat, dan berbagai roti artisan yang dipanggang fresh setiap hari dengan tekstur lembut dan aroma menggoda</span>
                    </div>
                    <div class="position-relative mt-auto">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/product-2.jpg') }}" alt="Roti dan Bakery Jamila Bakery">
                        <div class="product-overlay">
                            <a class="btn btn-lg-square btn-outline-light rounded-circle" href=""><i class="fa fa-eye text-primary"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block border border-primary rounded-pill pt-1 px-3 mb-3">Rp 5.000 - Rp 25.000</div>
                        <h4 class="mb-3">Cookies & Snack</h4>
                        <span>Aneka cookies renyah, kue kering lebaran, nastar, kastengel, dan camilan manis lainnya yang cocok untuk oleh-oleh dan acara spesial</span>
                    </div>
                    <div class="position-relative mt-auto">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/product-3.jpg') }}" alt="Cookies dan Snack Jamila Bakery">
                        <div class="product-overlay">
                            <a class="btn btn-lg-square btn-outline-light rounded-circle" href=""><i class="fa fa-eye text-primary"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block border border-primary rounded-pill pt-1 px-3 mb-3">Rp 15.000 - Rp 75.000</div>
                        <h4 class="mb-3">Kue Tradisional</h4>
                        <span>Koleksi kue tradisional Indonesia seperti lemper, onde-onde, klepon, lupis, dan kue basah lainnya dengan cita rasa autentik nusantara</span>
                    </div>
                    <div class="position-relative mt-auto">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/product-1.jpg') }}" alt="Kue Tradisional Jamila Bakery">
                        <div class="product-overlay">
                            <a class="btn btn-lg-square btn-outline-light rounded-circle" href=""><i class="fa fa-eye text-primary"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.9s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block border border-primary rounded-pill pt-1 px-3 mb-3">Rp 12.000 - Rp 55.000</div>
                        <h4 class="mb-3">Pastry & Danish</h4>
                        <span>Pastry premium dengan isian yang beragam, danish butter, puff pastry, dan berbagai produk pastry Eropa dengan kualitas bakery internasional</span>
                    </div>
                    <div class="position-relative mt-auto">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/product-2.jpg') }}" alt="Pastry dan Danish Jamila Bakery">
                        <div class="product-overlay">
                            <a class="btn btn-lg-square btn-outline-light rounded-circle" href=""><i class="fa fa-eye text-primary"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="1.1s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block border border-primary rounded-pill pt-1 px-3 mb-3">Rp 35.000 - Rp 150.000</div>
                        <h4 class="mb-3">Custom Order</h4>
                        <span>Layanan pemesanan khusus untuk kue ulang tahun, wedding cake, kue corporate, dan berbagai kebutuhan acara dengan desain sesuai permintaan</span>
                    </div>
                    <div class="position-relative mt-auto">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/product-3.jpg') }}" alt="Custom Order Jamila Bakery">
                        <div class="product-overlay">
                            <a class="btn btn-lg-square btn-outline-light rounded-circle" href=""><i class="fa fa-eye text-primary"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product End -->
    <!-- Service Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="text-primary text-uppercase mb-2">// Layanan Kami</p>
                    <h1 class="display-6 mb-4">Apa Yang Kami Tawarkan Untuk Anda?</h1>
                    <p class="mb-5">Jamila Bakery hadir dengan komitmen memberikan yang terbaik untuk keluarga Indonesia. Kami menghadirkan produk roti dan kue berkualitas tinggi dengan cita rasa yang autentik dan bahan-bahan terpilih. Kepuasan pelanggan adalah prioritas utama kami dalam setiap produk yang kami sajikan.</p>
                    <div class="row gy-5 gx-4">
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-bread-slice text-white"></i>
                                </div>
                                <h5 class="mb-0">Produk Berkualitas</h5>
                            </div>
                            <span>Roti dan kue segar setiap hari dengan bahan berkualitas terbaik</span>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.2s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-birthday-cake text-white"></i>
                                </div>
                                <h5 class="mb-0">Kue Custom</h5>
                            </div>
                            <span>Layanan pesanan khusus untuk ulang tahun dan acara spesial Anda</span>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-cart-plus text-white"></i>
                                </div>
                                <h5 class="mb-0">Pesan Online</h5>
                            </div>
                            <span>Kemudahan pemesanan melalui platform online kapan saja</span>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.4s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-truck text-white"></i>
                                </div>
                                <h5 class="mb-0">Antar ke Rumah</h5>
                            </div>
                            <span>Layanan pengiriman langsung ke rumah Anda dengan aman dan tepat waktu</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="row img-twice position-relative h-100">
                        <div class="col-6">
                            <img class="img-fluid rounded" src="{{ asset('baker-1.0.0/img/service-1.jpg') }}" alt="Jamila Bakery Produk">
                        </div>
                        <div class="col-6 align-self-end">
                            <img class="img-fluid rounded" src="{{ asset('baker-1.0.0/img/service-2.jpg') }}" alt="Jamila Bakery Layanan">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

   <!-- Team Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="text-primary text-uppercase mb-2">// Tim Kami</p>
                <h1 class="display-6 mb-4">Kami Ahli dan Berpengalaman di Bidang Kami</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/team-1.jpg') }}" alt="Chef Utama Jamila Bakery">
                        <div class="team-text">
                            <div class="team-title">
                                <h5>Chef Jamila</h5>
                                <span>Head Baker & Founder</span>
                            </div>
                            <div class="team-social">
                                <a class="btn btn-square btn-light rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-light rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-light rounded-circle" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/team-2.jpg') }}" alt="Pastry Chef Jamila Bakery">
                        <div class="team-text">
                            <div class="team-title">
                                <h5>Chef Andi</h5>
                                <span>Pastry Specialist</span>
                            </div>
                            <div class="team-social">
                                <a class="btn btn-square btn-light rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-light rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-light rounded-circle" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/team-3.jpg') }}" alt="Decorator Jamila Bakery">
                        <div class="team-text">
                            <div class="team-title">
                                <h5>Sari Wulandari</h5>
                                <span>Cake Decorator</span>
                            </div>
                            <div class="team-social">
                                <a class="btn btn-square btn-light rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-light rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-light rounded-circle" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/team-4.jpg') }}" alt="Manager Jamila Bakery">
                        <div class="team-text">
                            <div class="team-title">
                                <h5>Budi Santoso</h5>
                                <span>Operations Manager</span>
                            </div>
                            <div class="team-social">
                                <a class="btn btn-square btn-light rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-light rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-light rounded-circle" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->
<!-- Testimonial Start -->
<div class="container-xxl bg-light my-6 py-6 pb-0">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="text-primary text-uppercase mb-2">// Ulasan Pelanggan</p>
            <h1 class="display-6 mb-4">Lebih dari 15.000+ Pelanggan Mempercayai Kami</h1>
        </div>
        
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            <div class="testimonial-item bg-white rounded p-4">
                <div class="rating mb-3">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <img class="flex-shrink-0 rounded-circle border p-1 client-image" src="{{ asset('baker-1.0.0/img/testimonial-1.jpg') }}" alt="Testimoni Pelanggan Jamila Bakery">
                    <div class="ms-4">
                        <h5 class="mb-1">Siti Nurhaliza</h5>
                        <span>Food Blogger</span>
                    </div>
                </div>
                <p class="mb-0">Kualitas roti dan kue di Jamila Bakery benar-benar luar biasa! Selalu segar dan rasanya autentik. Sudah jadi langganan setia selama 3 tahun lebih.</p>
            </div>
            
            <div class="testimonial-item bg-white rounded p-4">
                <div class="rating mb-3">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <img class="flex-shrink-0 rounded-circle border p-1 client-image" src="{{ asset('baker-1.0.0/img/testimonial-2.jpg') }}" alt="Testimoni Pelanggan Jamila Bakery">
                    <div class="ms-4">
                        <h5 class="mb-1">Ahmad Rizky</h5>
                        <span>Pemilik Cafe</span>
                    </div>
                </div>
                <p class="mb-0">Partner terpercaya untuk bisnis cafe kami! Konsistensi kualitas dan layanan antar yang selalu tepat waktu membuat Jamila Bakery jadi supplier utama kami.</p>
            </div>
            
            <div class="testimonial-item bg-white rounded p-4">
                <div class="rating mb-3">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <img class="flex-shrink-0 rounded-circle border p-1 client-image" src="{{ asset('baker-1.0.0/img/testimonial-3.jpg') }}" alt="Testimoni Pelanggan Jamila Bakery">
                    <div class="ms-4">
                        <h5 class="mb-1">Maya Sari</h5>
                        <span>Event Organizer</span>
                    </div>
                </div>
                <p class="mb-0">Kue custom untuk acara-acara kami selalu memukau! Pelayanan profesional dan presentasi yang sangat indah. Recommended banget!</p>
            </div>
            
            <div class="testimonial-item bg-white rounded p-4">
                <div class="rating mb-3">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <img class="flex-shrink-0 rounded-circle border p-1 client-image" src="{{ asset('baker-1.0.0/img/testimonial-4.jpg') }}" alt="Testimoni Pelanggan Jamila Bakery">
                    <div class="ms-4">
                        <h5 class="mb-1">Bagus Wijaya</h5>
                        <span>Pelanggan Setia</span>
                    </div>
                </div>
                <p class="mb-0">Bakery terbaik di kota! Bahan-bahan fresh, harga terjangkau, dan staff yang ramah. Pokoknya juara deh Jamila Bakery!</p>
            </div>
        </div>
        
        <div class="bg-primary text-light rounded-top p-5 my-6 mb-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4 text-light mb-0">Berlangganan Newsletter Kami</h1>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="position-relative">
                        <input class="form-control bg-transparent border-light w-100 py-3 ps-4 pe-5" type="text" placeholder="Email Anda">
                        <button type="button" class="btn btn-dark py-2 px-3 position-absolute top-0 end-0 mt-2 me-2">Daftar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->
@endsection