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

    /* Form Styling */
    .form-control {
        border: 1px solid rgba(0,0,0,0.1);
        border-radius: 10px;
        padding: 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #e67e22;
        box-shadow: 0 0 0 0.25rem rgba(230, 126, 34, 0.1);
    }

    .form-floating label {
        padding-left: 15px;
    }

    .contact-form-container {
        background: #ffffff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.05);
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

    /* Map Styling */
    .map-container {
        filter: grayscale(100%) invert(92%) contrast(83%);
        border-radius: 20px;
        overflow: hidden;
        border: 5px solid white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
</style>

<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center pt-5 pb-3">
        <h1 class="display-4 text-white animated slideInDown mb-3" style="font-family: 'Playfair Display', serif; font-weight: 700;">Hubungi Kami</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">Beranda</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Kontak</li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-xxl py-6">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="text-primary text-uppercase fw-bold mb-2">// Kontak Kami</p>
            <h1 class="display-6 mb-4" style="font-family: 'Playfair Display', serif;">Ada Pertanyaan? Kami Siap Membantu</h1>
        </div>
        
        <div class="row g-5 justify-content-center">
            <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="d-flex flex-column justify-content-center h-100">
                    <p class="mb-4">Kami sangat senang mendengar dari Anda. Jangan ragu untuk menghubungi kami melalui form atau detail kontak di bawah ini.</p>
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3" style="width: 45px; height: 45px;">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <span>Jl. Raya Pakisan Maskuning Kulon Pujer, Bondowoso</span>
                    </div>
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3" style="width: 45px; height: 45px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <span>+6282237987432</span>
                    </div>
                    
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3" style="width: 45px; height: 45px;">
                            <i class="fa fa-envelope text-white"></i>
                        </div>
                        <span>info@jamilabakery.com</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.5s">
                <div class="contact-form-container">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Nama Anda">
                                    <label for="name">Nama Anda</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Email Anda">
                                    <label for="email">Email Anda</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" placeholder="Subjek">
                                    <label for="subject">Subjek</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Tulis pesan Anda disini" id="message" style="height: 150px"></textarea>
                                    <label for="message">Pesan Anda</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary rounded-pill py-3 px-5 w-100" type="submit">Kirim Pesan Sekarang</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row mt-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="col-12">
                <div class="map-container">
                    <iframe class="w-100" 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.2075948242073!2d113.88677817432557!3d-7.977483379532469!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6c57d34a33caf%3A0x58c4bf05e63b9680!2sJAMILA%20BAKERY!5e0!3m2!1sid!2sid!4v1766767912099!5m2!1sid!2sid" 
                        frameborder="0" style="min-height: 400px; border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection