<!-- Navbar Start -->
<style>
    /* Modern Navbar Styling */
    .modern-navbar {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    
    .modern-navbar.scrolled {
        background: rgba(255, 255, 255, 0.98);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.15);
    }
    
    .navbar-brand-modern {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 1.8rem;
        background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        transition: transform 0.3s ease;
    }
    
    .navbar-brand-modern:hover {
        transform: scale(1.05);
    }
    
    .nav-link-modern {
        color: #2c3e50 !important;
        font-weight: 500;
        padding: 0.5rem 1rem !important;
        margin: 0 0.2rem;
        position: relative;
        transition: all 0.3s ease;
    }
    
    .nav-link-modern::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #e67e22, #d35400);
        transform: translateX(-50%);
        transition: width 0.3s ease;
    }
    
    .nav-link-modern:hover::before,
    .nav-link-modern.active::before {
        width: 80%;
    }
    
    .nav-link-modern:hover,
    .nav-link-modern.active {
        color: #e67e22 !important;
    }
    
    .dropdown-menu-modern {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        padding: 0.5rem;
        margin-top: 0.5rem;
        animation: fadeInDown 0.3s ease;
    }
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .dropdown-item-modern {
        border-radius: 8px;
        padding: 0.6rem 1rem;
        color: #2c3e50;
        transition: all 0.2s ease;
        font-weight: 500;
    }
    
    .dropdown-item-modern:hover {
        background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
        color: white;
        transform: translateX(5px);
    }
    
    .contact-box {
        background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
        border-radius: 50px;
        padding: 0.8rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(230, 126, 34, 0.3);
    }
    
    .contact-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(230, 126, 34, 0.4);
    }
    
    .contact-icon {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .contact-icon i {
        color: white;
        font-size: 1.1rem;
    }
    
    .contact-text small {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.75rem;
        display: block;
    }
    
    .contact-text p {
        color: white;
        font-weight: 600;
        margin: 0;
        font-size: 0.95rem;
    }
    
    .navbar-toggler-modern {
        border: 2px solid #e67e22;
        border-radius: 8px;
        padding: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .navbar-toggler-modern:focus {
        box-shadow: 0 0 0 0.2rem rgba(230, 126, 34, 0.25);
    }
    
    .navbar-toggler-modern .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23e67e22' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }
    
    @media (max-width: 991px) {
        .navbar-collapse {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            margin-top: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .contact-box {
            margin-top: 1rem;
        }
    }
</style>

<nav class="navbar navbar-expand-lg fixed-top py-3 modern-navbar wow fadeIn" data-wow-delay="0.1s">
    <div class="container-fluid px-4 px-lg-5">
        <a href="{{ url('/') }}" class="navbar-brand navbar-brand-modern">
            Jamila Bakery
        </a>
        
        <button type="button" class="navbar-toggler navbar-toggler-modern" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto">
                <a href="{{ url('/') }}" class="nav-item nav-link nav-link-modern {{ request()->is('/') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="nav-item nav-link nav-link-modern {{ request()->routeIs('about') ? 'active' : '' }}">Tentang Kami</a>
                <a href="{{ route('service') }}" class="nav-item nav-link nav-link-modern {{ request()->routeIs('service') ? 'active' : '' }}">Layanan</a>
                <a href="{{ route('product') }}" class="nav-item nav-link nav-link-modern {{ request()->routeIs('product') ? 'active' : '' }}">Produk</a>
                
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link nav-link-modern dropdown-toggle {{ request()->routeIs('team') || request()->routeIs('testimonial') ? 'active' : '' }}" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu dropdown-menu-modern">
                        <a href="{{ route('team') }}" class="dropdown-item dropdown-item-modern">
                            <i class="fas fa-users me-2"></i>Tim Kami
                        </a>
                        <a href="{{ route('testimonial') }}" class="dropdown-item dropdown-item-modern">
                            <i class="fas fa-star me-2"></i>Testimoni
                        </a>
                    </div>
                </div>
                
                <a href="{{ route('contact') }}" class="nav-item nav-link nav-link-modern {{ request()->routeIs('contact') ? 'active' : '' }}">Kontak</a>
            </div>
            
            <div class="d-flex">
                <div class="contact-box">
                    <div class="contact-icon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="contact-text">
                        <small>Hubungi Kami</small>
                        <p>082237987432</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Add scroll effect script -->
<script>
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.modern-navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>
<!-- Navbar End -->