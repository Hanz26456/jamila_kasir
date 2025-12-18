@extends('layouts.app')

@section('content')
 <div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center pt-5 pb-3">
            <h1 class="display-4 text-white animated slideInDown mb-3">Testimonial</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Testimonial</li>
                </ol>
            </nav>
        </div>
    </div>
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