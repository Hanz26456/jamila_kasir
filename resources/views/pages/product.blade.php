@extends('layouts.app')

@section('content')
 <div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center pt-5 pb-3">
            <h1 class="display-4 text-white animated slideInDown mb-3">Product</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Product</li>
                </ol>
            </nav>
        </div>
    </div>
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
    @endsection