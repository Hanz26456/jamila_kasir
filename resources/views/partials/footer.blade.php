<!-- Footer Start -->
<style>
    /* Modern Footer Styling */
    .modern-footer {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        position: relative;
        overflow: hidden;
    }
    
    .modern-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #e67e22, #d35400, #e67e22);
    }
    
    .footer-wave {
        position: absolute;
        top: -50px;
        left: 0;
        width: 100%;
        height: 60px;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120'%3E%3Cpath d='M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z' fill='%231a1a2e'/%3E%3C/svg%3E") no-repeat;
        background-size: cover;
    }
    
    .footer-heading {
        color: #fff;
        font-weight: 600;
        font-size: 1.25rem;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.75rem;
    }
    
    .footer-heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #e67e22, #d35400);
        border-radius: 2px;
    }
    
    .footer-link {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        padding: 0.5rem 0;
        display: inline-block;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .footer-link::before {
        content: '→';
        position: absolute;
        left: -20px;
        opacity: 0;
        transition: all 0.3s ease;
        color: #e67e22;
    }
    
    .footer-link:hover {
        color: #e67e22;
        padding-left: 25px;
        transform: translateX(5px);
    }
    
    .footer-link:hover::before {
        opacity: 1;
        left: 0;
    }
    
    .footer-info {
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }
    
    .footer-info:hover {
        color: #e67e22;
        transform: translateX(5px);
    }
    
    .footer-info i {
        width: 40px;
        height: 40px;
        background: rgba(230, 126, 34, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: #e67e22;
        transition: all 0.3s ease;
    }
    
    .footer-info:hover i {
        background: #e67e22;
        color: white;
        transform: rotate(360deg);
    }
    
    .social-links {
        display: flex;
        gap: 0.75rem;
        padding-top: 1rem;
    }
    
    .social-link {
        width: 45px;
        height: 45px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .social-link:hover {
        background: linear-gradient(135deg, #e67e22, #d35400);
        color: white;
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(230, 126, 34, 0.4);
    }
    
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.5rem;
    }
    
    .gallery-item {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        aspect-ratio: 1;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.3s ease;
    }
    
    .gallery-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(230, 126, 34, 0.8), rgba(211, 84, 0, 0.8));
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 1;
    }
    
    .gallery-item:hover::before {
        opacity: 1;
    }
    
    .gallery-item:hover img {
        transform: scale(1.1);
    }
    
    .copyright-section {
        background: rgba(0, 0, 0, 0.3);
        padding: 1.5rem 0;
        margin-top: 3rem;
    }
    
    .copyright-text {
        color: rgba(255, 255, 255, 0.6);
        margin: 0;
    }
    
    .copyright-text a {
        color: #e67e22;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .copyright-text a:hover {
        color: #d35400;
        text-decoration: underline;
    }
</style>

<div class="modern-footer my-6 mb-0 py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="footer-wave"></div>
    <div class="container py-5">
        <div class="row g-5">
            <!-- Alamat Toko -->
            <div class="col-lg-3 col-md-6">
                <h4 class="footer-heading">Alamat Toko</h4>
                <div class="footer-info">
                    <i class="fa fa-map-marker-alt"></i>
                    <span>Jl. Raya Pakisan Maskuning Kulon Pujer, Bondowoso, Jawa Timur</span>
                </div>
                <div class="footer-info">
                    <i class="fa fa-phone-alt"></i>
                    <span>+6282237987432</span>
                </div>
                <div class="footer-info">
                    <i class="fa fa-envelope"></i>
                    <span>info@jamilabakery.com</span>
                </div>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            
            <!-- Menu Utama -->
            <div class="col-lg-3 col-md-6">
                <h4 class="footer-heading">Menu Utama</h4>
                <div class="d-flex flex-column">
                    <a class="footer-link" href="{{ route('about') }}">Tentang Kami</a>
                    <a class="footer-link" href="{{ route('contact') }}">Hubungi Kami</a>
                    <a class="footer-link" href="{{ route('service') }}">Layanan Kami</a>
                    <a class="footer-link" href="{{ route('product') }}">Produk Kami</a>
                    <a class="footer-link" href="{{ route('team') }}">Tim Kami</a>
                </div>
            </div>
            
            <!-- Layanan -->
            <div class="col-lg-3 col-md-6">
                <h4 class="footer-heading">Layanan</h4>
                <div class="d-flex flex-column">
                    <a class="footer-link" href="#">Pesan Online</a>
                    <a class="footer-link" href="#">Kue Custom</a>
                    <a class="footer-link" href="#">Antar ke Rumah</a>
                    <a class="footer-link" href="#">Catering Event</a>
                    <a class="footer-link" href="#">Bantuan</a>
                </div>
            </div>
            
            <!-- Galeri Produk -->
            <div class="col-lg-3 col-md-6">
                <h4 class="footer-heading">Galeri Produk</h4>
                <div class="gallery-grid">
                    <div class="gallery-item">
                        <img src="{{ asset('baker-1.0.0/img/product-1.jpg') }}" alt="Produk Jamila Bakery">
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('baker-1.0.0/img/product-2.jpg') }}" alt="Produk Jamila Bakery">
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('baker-1.0.0/img/product-3.jpg') }}" alt="Produk Jamila Bakery">
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('baker-1.0.0/img/product-2.jpg') }}" alt="Produk Jamila Bakery">
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('baker-1.0.0/img/product-3.jpg') }}" alt="Produk Jamila Bakery">
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('baker-1.0.0/img/product-1.jpg') }}" alt="Produk Jamila Bakery">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Copyright Section -->
    <div class="copyright-section wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="copyright-text">
                        &copy; <a href="#">Jamila Bakery</a> 2025. Hak Cipta Dilindungi.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="copyright-text">
                        Designed with <i class="fa fa-heart text-danger"></i> by <a href="#">Jamila Bakery Team</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->