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

    /* Service Icon Styling */
    .service-icon-box {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(230, 126, 34, 0.3);
        transition: all 0.3s ease;
    }

    .service-item-row:hover .service-icon-box {
        transform: rotateY(360deg);
        box-shadow: 0 8px 25px rgba(230, 126, 34, 0.5);
    }

    .service-title {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        color: #1a1a2e;
    }

    /* Efek Gambar */
    .img-twice img {
        transition: transform 0.5s ease;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: 5px solid white;
    }

    .img-twice img:hover {
        transform: scale(1.05);
        z-index: 10;
    }
</style>

<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center pt-5 pb-3">
        <h1 class="display-4 text-white animated slideInDown mb-3" style="font-family: 'Playfair Display', serif; font-weight: 700;">Layanan Kami</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">Beranda</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Layanan</li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-xxl py-6">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <p class="text-primary text-uppercase fw-bold mb-2">// Apa Yang Kami Tawarkan?</p>
                <h1 class="display-6 mb-4" style="font-family: 'Playfair Display', serif;">Komitmen Kami Untuk Kepuasan Anda</h1>
                <p class="mb-5">Jamila Bakery hadir dengan komitmen memberikan yang terbaik untuk keluarga Indonesia. Kami menghadirkan produk roti dan kue berkualitas tinggi dengan cita rasa yang autentik dan bahan-bahan terpilih. Kepuasan pelanggan adalah prioritas utama kami dalam setiap produk yang kami sajikan.</p>
                
                <div class="row gy-5 gx-4">
                    <div class="col-sm-6 wow fadeIn service-item-row" data-wow-delay="0.1s">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0 service-icon-box me-3">
                                <i class="fa fa-bread-slice text-white fs-4"></i>
                            </div>
                            <h5 class="mb-0 service-title">Produk Berkualitas</h5>
                        </div>
                        <span class="text-muted">Roti dan kue segar setiap hari dengan bahan berkualitas terbaik.</span>
                    </div>

                    <div class="col-sm-6 wow fadeIn service-item-row" data-wow-delay="0.2s">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0 service-icon-box me-3">
                                <i class="fa fa-birthday-cake text-white fs-4"></i>
                            </div>
                            <h5 class="mb-0 service-title">Kue Custom</h5>
                        </div>
                        <span class="text-muted">Layanan pesanan khusus untuk ulang tahun dan acara spesial Anda.</span>
                    </div>

                    <div class="col-sm-6 wow fadeIn service-item-row" data-wow-delay="0.3s">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0 service-icon-box me-3">
                                <i class="fa fa-cart-plus text-white fs-4"></i>
                            </div>
                            <h5 class="mb-0 service-title">Pesan Online</h5>
                        </div>
                        <span class="text-muted">Kemudahan pemesanan melalui platform online kapan saja.</span>
                    </div>

                    <div class="col-sm-6 wow fadeIn service-item-row" data-wow-delay="0.4s">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0 service-icon-box me-3">
                                <i class="fa fa-truck text-white fs-4"></i>
                            </div>
                            <h5 class="mb-0 service-title">Antar ke Rumah</h5>
                        </div>
                        <span class="text-muted">Layanan pengiriman langsung ke rumah Anda dengan aman dan tepat waktu.</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="row img-twice position-relative h-100">
                    <div class="col-6">
                        <img class="img-fluid rounded" src="{{ asset('baker-1.0.0/img/service-1.jpg') }}" alt="Produk Jamila Bakery">
                    </div>
                    <div class="col-6 align-self-end">
                        <img class="img-fluid rounded" src="{{ asset('baker-1.0.0/img/service-2.jpg') }}" alt="Layanan Jamila Bakery">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection