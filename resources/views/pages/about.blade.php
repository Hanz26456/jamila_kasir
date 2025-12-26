@extends('layouts.app')

@section('content')
<style>
    /* Hero Section / Page Header Styling */
    .page-header {
        background: linear-gradient(rgba(26, 26, 46, 0.7), rgba(26, 26, 46, 0.7)), 
                    url("{{ asset('baker-1.0.0/img/carousel-1.jpg') }}") center center no-repeat;
        background-size: cover;
        margin-top: -100px; /* Menarik header ke bawah navbar glassmorphism */
        padding-top: 150px !important;
        border-bottom: 5px solid #e67e22;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.5);
    }

    /* Penyesuaian Warna Teks & Button */
    .text-primary {
        color: #e67e22 !important;
    }

    .btn-primary {
        background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(230, 126, 34, 0.3);
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(230, 126, 34, 0.5);
    }

    /* Efek Gambar */
    .img-twice img {
        transition: transform 0.5s ease;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .img-twice img:hover {
        transform: scale(1.03);
    }

    .check-icon {
        background: rgba(230, 126, 34, 0.1);
        width: 25px;
        height: 25px;
        line-height: 25px;
        text-align: center;
        border-radius: 50%;
        display: inline-block;
    }
</style>

<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center pt-5 pb-3">
        <h1 class="display-4 text-white animated slideInDown mb-3" style="font-family: 'Playfair Display', serif; font-weight: 700;">Tentang Kami</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">Beranda</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Tentang Kami</li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-xxl py-6">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row img-twice position-relative h-100">
                    <div class="col-6">
                        <img class="img-fluid rounded" src="{{ asset('baker-1.0.0/img/about-1.jpg') }}" alt="Proses Pembuatan Roti">
                    </div>
                    <div class="col-6 align-self-end">
                        <img class="img-fluid rounded" src="{{ asset('baker-1.0.0/img/about-2.jpg') }}" alt="Produk Jamila Bakery">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="h-100">
                    <p class="text-primary text-uppercase fw-bold mb-2">// Kenali Lebih Dekat</p>
                    <h1 class="display-6 mb-4" style="font-family: 'Playfair Display', serif;">Jamila Bakery - Memanggang dengan Sepenuh Hati</h1>
                    <p>
                        Sejak tahun 1975, Jamila Bakery telah menjadi bagian dari keluarga Indonesia dengan menyediakan 
                        roti dan kue berkualitas tinggi. Kami bangga menggunakan bahan-bahan pilihan terbaik dan resep 
                        turun temurun yang telah dipercaya selama puluhan tahun.
                    </p>
                    <p class="mb-4">
                        Setiap produk Jamila Bakery dibuat dengan dedikasi tinggi oleh para baker berpengalaman untuk memastikan kehangatan cita rasa di setiap gigitannya.
                    </p>
                    <div class="row g-3 mb-5">
                        <div class="col-sm-6">
                            <span class="check-icon"><i class="fa fa-check text-primary"></i></span> Produk Berkualitas Tinggi
                        </div>
                        <div class="col-sm-6">
                            <span class="check-icon"><i class="fa fa-check text-primary"></i></span> Kue Custom Sesuai Pesanan
                        </div>
                        <div class="col-sm-6">
                            <span class="check-icon"><i class="fa fa-check text-primary"></i></span> Pemesanan Online Mudah
                        </div>
                        <div class="col-sm-6">
                            <span class="check-icon"><i class="fa fa-check text-primary"></i></span> Layanan Antar Gratis
                        </div>
                        <div class="col-sm-6">
                            <span class="check-icon"><i class="fa fa-check text-primary"></i></span> Bahan-bahan Pilihan
                        </div>
                        <div class="col-sm-6">
                            <span class="check-icon"><i class="fa fa-check text-primary"></i></span> Halal dan Higienis
                        </div>
                    </div>
                    <a class="btn btn-primary rounded-pill py-3 px-5" href="{{ route('product') }}">Lihat Produk Kami</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection