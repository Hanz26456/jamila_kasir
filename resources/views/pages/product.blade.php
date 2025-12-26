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

    /* Penyesuaian CTA Box agar senada dengan Footer */
    .cta-box {
        background: linear-gradient(135deg, #e67e22 0%, #d35400 100%) !important;
        border-radius: 0 0 20px 20px;
        box-shadow: 0 10px 30px rgba(230, 126, 34, 0.2);
    }

    /* Product Card Styling */
    .product-item {
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .product-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }

    .product-item img {
        transition: transform 0.5s ease;
    }

    .product-item:hover img {
        transform: scale(1.1);
    }

    /* Price Badge */
    .price-badge {
        border: 2px solid #e67e22;
        color: #e67e22;
        font-weight: 700;
        background: rgba(230, 126, 34, 0.05);
    }

    /* Overlay Overlay Styling */
    .product-overlay {
        background: rgba(26, 33, 62, 0.8) !important; /* Biru Gelap senada footer */
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.5s;
    }

    .product-overlay i {
        background: #e67e22;
        padding: 15px;
        border-radius: 50%;
        color: white;
    }
</style>

<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center pt-5 pb-3">
        <h1 class="display-4 text-white animated slideInDown mb-3" style="font-family: 'Playfair Display', serif; font-weight: 700;">Produk Kami</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">Beranda</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Produk</li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-xxl bg-light my-6 py-6 pt-0">
    <div class="container">
        <div class="cta-box text-light p-5 my-6 mt-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 text-light mb-0" style="font-family: 'Playfair Display', serif;">Toko Roti Terbaik di Kota Anda</h1>
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
            <p class="text-primary text-uppercase fw-bold mb-2">// Produk Jamila Bakery</p>
            <h1 class="display-6 mb-4" style="font-family: 'Playfair Display', serif;">Jelajahi Kategori Produk Roti dan Kue Kami</h1>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block price-badge rounded-pill px-3 mb-3">Rp 25.000 - Rp 350.000</div>
                        <h3 class="mb-3">Kue & Cake</h3>
                        <span>Berbagai pilihan kue ulang tahun, kue tart, dan kue tradisional dengan cita rasa istimewa.</span>
                    </div>
                    <div class="position-relative mt-auto overflow-hidden">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/product-1.jpg') }}" alt="Kue Cake">
                        <div class="product-overlay">
                            <a class="btn-lg-square" href="#"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block price-badge rounded-pill px-3 mb-3">Rp 8.000 - Rp 45.000</div>
                        <h3 class="mb-3">Roti & Bakery</h3>
                        <span>Roti tawar, roti manis, dan croissant yang dipanggang fresh setiap hari.</span>
                    </div>
                    <div class="position-relative mt-auto overflow-hidden">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/product-2.jpg') }}" alt="Roti Bakery">
                        <div class="product-overlay">
                            <a class="btn-lg-square" href="#"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block price-badge rounded-pill px-3 mb-3">Rp 5.000 - Rp 25.000</div>
                        <h3 class="mb-3">Cookies & Snack</h3>
                        <span>Aneka cookies renyah dan camilan manis yang cocok untuk oleh-oleh.</span>
                    </div>
                    <div class="position-relative mt-auto overflow-hidden">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/product-3.jpg') }}" alt="Cookies">
                        <div class="product-overlay">
                            <a class="btn-lg-square" href="#"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block price-badge rounded-pill px-3 mb-3">Rp 15.000 - Rp 75.000</div>
                        <h3 class="mb-3">Kue Tradisional</h3>
                        <span>Koleksi kue basah nusantara dengan cita rasa autentik dan bahan alami.</span>
                    </div>
                    <div class="position-relative mt-auto overflow-hidden">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/product-1.jpg') }}" alt="Kue Tradisional">
                        <div class="product-overlay">
                            <a class="btn-lg-square" href="#"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.9s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block price-badge rounded-pill px-3 mb-3">Rp 12.000 - Rp 55.000</div>
                        <h3 class="mb-3">Pastry & Danish</h3>
                        <span>Pastry premium dengan kualitas bakery internasional, renyah dan gurih.</span>
                    </div>
                    <div class="position-relative mt-auto overflow-hidden">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/product-2.jpg') }}" alt="Pastry">
                        <div class="product-overlay">
                            <a class="btn-lg-square" href="#"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="1.1s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block price-badge rounded-pill px-3 mb-3">Custom Price</div>
                        <h3 class="mb-3">Custom Order</h3>
                        <span>Layanan pesanan khusus untuk wedding cake dan acara corporate.</span>
                    </div>
                    <div class="position-relative mt-auto overflow-hidden">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/product-3.jpg') }}" alt="Custom Order">
                        <div class="product-overlay">
                            <a class="btn-lg-square" href="#"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection