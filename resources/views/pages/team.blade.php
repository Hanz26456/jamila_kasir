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

    /* Team Item Styling */
    .team-item {
        background: #ffffff;
        transition: .5s;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .team-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 45px rgba(0,0,0,0.1);
    }

    .team-text {
        position: relative;
        padding: 30px;
        transition: .5s;
    }

    .team-title h5 {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .team-title span {
        color: #e67e22;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
    }

    /* Social Links Styling */
    .team-social {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .team-social a {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(26, 33, 62, 0.05);
        color: #1a1a2e;
        border-radius: 50%;
        transition: .3s;
        text-decoration: none;
    }

    .team-social a:hover {
        background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
        color: #ffffff;
        transform: translateY(-3px);
    }

    .team-item img {
        transition: .5s;
    }

    .team-item:hover img {
        transform: scale(1.05);
    }
</style>

<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center pt-5 pb-3">
        <h1 class="display-4 text-white animated slideInDown mb-3" style="font-family: 'Playfair Display', serif; font-weight: 700;">Tim Kami</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">Beranda</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Tim Ahli</li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-xxl py-6">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="text-primary text-uppercase fw-bold mb-2">// Ahli Roti Kami</p>
            <h1 class="display-6 mb-4" style="font-family: 'Playfair Display', serif;">Kami Ahli dan Berpengalaman di Bidang Kami</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item text-center rounded overflow-hidden">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/team-1.jpg') }}" alt="Chef Jamila">
                    </div>
                    <div class="team-text">
                        <div class="team-title">
                            <h5>Chef Jamila</h5>
                            <span>Head Baker & Founder</span>
                        </div>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item text-center rounded overflow-hidden">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/team-2.jpg') }}" alt="Chef Andi">
                    </div>
                    <div class="team-text">
                        <div class="team-title">
                            <h5>Chef Andi</h5>
                            <span>Pastry Specialist</span>
                        </div>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="team-item text-center rounded overflow-hidden">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/team-3.jpg') }}" alt="Sari Wulandari">
                    </div>
                    <div class="team-text">
                        <div class="team-title">
                            <h5>Sari Wulandari</h5>
                            <span>Cake Decorator</span>
                        </div>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="team-item text-center rounded overflow-hidden">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="{{ asset('baker-1.0.0/img/team-4.jpg') }}" alt="Budi Santoso">
                    </div>
                    <div class="team-text">
                        <div class="team-title">
                            <h5>Budi Santoso</h5>
                            <span>Operations Manager</span>
                        </div>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection