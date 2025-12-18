  @extends('layouts.app')

@section('content')
 <div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center pt-5 pb-3">
            <h1 class="display-4 text-white animated slideInDown mb-3">Service</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Service</li>
                </ol>
            </nav>
        </div>
    </div>
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
    @endsection