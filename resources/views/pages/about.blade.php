@extends('layouts.app')

@section('content')
 <div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center pt-5 pb-3">
            <h1 class="display-4 text-white animated slideInDown mb-3">About</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
    </div>
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

    @endsection