@extends('layouts.app')

@section('content')
<style>
    /* Hero Section / Page Header Styling */
    .page-header {
        background: linear-gradient(rgba(26, 26, 46, 0.7), rgba(26, 26, 46, 0.7)), 
                    url("{{ asset('baker-1.0.0/img/carousel-2.jpg') }}") center center no-repeat;
        background-size: cover;
        margin-top: -100px; /* Menarik header ke bawah navbar glassmorphism */
        padding-top: 150px !important;
        border-bottom: 5px solid #e67e22;
    }

    /* Testimonial Card Styling */
    .testimonial-item {
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: .5s;
        border-bottom: 4px solid transparent;
    }

    .testimonial-item:hover {
        transform: translateY(-10px);
        border-color: #e67e22;
        box-shadow: 0 15px 45px rgba(0,0,0,0.1);
    }

    .rating i {
        color: #e67e22; /* Warna bintang oranye tema Jamila Bakery */
    }

    .client-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border: 3px solid #e67e22 !important;
    }

    .testimonial-item h5 {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
    }

    /* Newsletter Section - Sync dengan Footer Gradient */
    .newsletter-box {
        background: linear-gradient(135deg, #e67e22 0%, #d35400 100%) !important;
        border-radius: 20px 20px 0 0 !important;
        box-shadow: 0 -10px 30px rgba(230, 126, 34, 0.2);
    }

    .btn-dark {
        background: #1a1a2e;
        border: none;
        transition: .3s;
    }

    .btn-dark:hover {
        background: #000;
        transform: scale(1.05);
    }
</style>

<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center pt-5 pb-3">
        <h1 class="display-4 text-white animated slideInDown mb-3" style="font-family: 'Playfair Display', serif; font-weight: 700;">Testimonial</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">Beranda</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Ulasan Pelanggan</li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-xxl bg-light my-6 py-6 pb-0">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="text-primary text-uppercase fw-bold mb-2">// Ulasan Pelanggan</p>
            <h1 class="display-6 mb-4" style="font-family: 'Playfair Display', serif;">Lebih dari 15.000+ Pelanggan Mempercayai Kami</h1>
        </div>
        
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            <div class="testimonial-item bg-white rounded p-4">
                <div class="rating mb-3">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <img class="flex-shrink-0 rounded-circle border p-1 client-image" src="{{ asset('baker-1.0.0/img/testimonial-1.jpg') }}" alt="">
                    <div class="ms-4">
                        <h5 class="mb-1">Siti Nurhaliza</h5>
                        <span class="text-primary">Food Blogger</span>
                    </div>
                </div>
                <p class="mb-0 italic">"Kualitas roti dan kue di Jamila Bakery benar-benar luar biasa! Selalu segar dan rasanya autentik. Sudah jadi langganan setia selama 3 tahun lebih."</p>
            </div>
            
            <div class="testimonial-item bg-white rounded p-4">
                <div class="rating mb-3">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <img class="flex-shrink-0 rounded-circle border p-1 client-image" src="{{ asset('baker-1.0.0/img/testimonial-2.jpg') }}" alt="">
                    <div class="ms-4">
                        <h5 class="mb-1">Ahmad Rizky</h5>
                        <span class="text-primary">Pemilik Cafe</span>
                    </div>
                </div>
                <p class="mb-0">"Partner terpercaya untuk bisnis cafe kami! Konsistensi kualitas dan layanan antar yang selalu tepat waktu membuat Jamila Bakery jadi supplier utama kami."</p>
            </div>
            
            <div class="testimonial-item bg-white rounded p-4">
                <div class="rating mb-3">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <img class="flex-shrink-0 rounded-circle border p-1 client-image" src="{{ asset('baker-1.0.0/img/testimonial-3.jpg') }}" alt="">
                    <div class="ms-4">
                        <h5 class="mb-1">Maya Sari</h5>
                        <span class="text-primary">Event Organizer</span>
                    </div>
                </div>
                <p class="mb-0">"Kue custom untuk acara-acara kami selalu memukau! Pelayanan profesional dan presentasi yang sangat indah. Recommended banget!"</p>
            </div>
        </div>
        
        <div class="newsletter-box text-light p-5 my-6 mb-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-5 text-light mb-0" style="font-family: 'Playfair Display', serif;">Berlangganan Newsletter Kami</h1>
                    <p class="mb-0">Dapatkan info promo dan produk terbaru langsung di email Anda.</p>
                </div>
                <div class="col-md-6 text-md-end mt-4 mt-md-0">
                    <div class="position-relative">
                        <input class="form-control bg-transparent border-light w-100 py-3 ps-4 pe-5 text-white" type="email" placeholder="Email Anda">
                        <button type="button" class="btn btn-dark py-2 px-4 position-absolute top-0 end-0 mt-2 me-2">Daftar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection