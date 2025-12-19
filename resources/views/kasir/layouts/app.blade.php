<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jamila Bakery - {{ $title ?? 'Dashboard' }}</title>

    <!-- Fonts -->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #f8f9fa;
            min-height: 100vh;
        }

        #wrapper {
            background: transparent;
        }

        /* Sidebar Minimalis Modern */
        .sidebar {
            background: #ffffff !important;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.04);
            border-right: 1px solid #e9ecef;
        }

        .sidebar .sidebar-brand {
            background: #ffffff;
            padding: 1.5rem;
            margin-bottom: 0.5rem;
            border-bottom: 1px solid #e9ecef;
        }

        .sidebar .sidebar-brand-icon {
            color: #6366f1;
        }

        .sidebar .sidebar-brand-text {
            color: #1e293b !important;
            font-weight: 600;
            font-size: 1.2rem;
            letter-spacing: -0.5px;
        }

        .sidebar .nav-item .nav-link {
            color: #64748b;
            padding: 0.75rem 1.25rem;
            margin: 0.125rem 0.75rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .sidebar .nav-item .nav-link:hover {
            background: #f1f5f9;
            color: #6366f1 !important;
            transform: translateX(3px);
        }

        .sidebar .nav-item.active .nav-link {
            background: #eef2ff;
            color: #6366f1 !important;
            border-left: 3px solid #6366f1;
        }

        .sidebar .nav-item .nav-link i {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
            color: inherit;
        }

        .sidebar .nav-item.active .nav-link i,
        .sidebar .nav-item .nav-link:hover i {
            color: #6366f1;
        }

        /* Content Wrapper */
        #content-wrapper {
            background: transparent;
        }

        /* Topbar Minimalis */
        .topbar {
            background: #ffffff !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            border-bottom: 1px solid #e9ecef;
            margin: 0;
            border-radius: 0;
        }

        .topbar .navbar-search input {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
            background: #f8f9fa;
        }

        .topbar .navbar-search input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            background: #ffffff;
        }

        .topbar .nav-item .nav-link {
            color: #64748b;
            transition: all 0.2s ease;
        }

        .topbar .nav-item .nav-link:hover {
            color: #6366f1;
        }

        .topbar .dropdown-menu {
            border-radius: 8px;
            border: 1px solid #e9ecef;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* Container Fluid */
        .container-fluid {
            padding: 1.5rem;
        }

        /* Cards Minimalis */
        .card {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            background: #ffffff;
            transition: all 0.2s ease;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            background: #ffffff;
            color: #1e293b;
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 1.25rem;
            font-weight: 600;
            font-size: 1rem;
        }

        .card-body {
            padding: 1.25rem;
        }

        /* Buttons Minimalis */
        .btn-primary {
            background: #6366f1;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .btn-primary:hover {
            background: #4f46e5;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-success {
            background: #10b981;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-success:hover {
            background: #059669;
        }

        .btn-danger {
            background: #ef4444;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-warning {
            background: #f59e0b;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-warning:hover {
            background: #d97706;
        }

        .btn-info {
            background: #06b6d4;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-info:hover {
            background: #0891b2;
        }

        /* Table Minimalis */
        .table {
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead th {
            background: #f8f9fa;
            color: #475569;
            border: none;
            font-weight: 600;
            padding: 0.875rem 1rem;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.2s ease;
            border-bottom: 1px solid #f1f5f9;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
        }

        .table tbody td {
            padding: 0.875rem 1rem;
            color: #475569;
        }

        /* Footer Minimalis */
        .sticky-footer {
            background: #ffffff !important;
            box-shadow: 0 -1px 3px rgba(0, 0, 0, 0.06);
            border-top: 1px solid #e9ecef;
            margin: 0;
            border-radius: 0;
        }

        .sticky-footer .copyright {
            color: #64748b;
            font-weight: 400;
            font-size: 0.875rem;
        }

        /* Scroll to Top Button */
        .scroll-to-top {
            background: #6366f1;
            border-radius: 10px;
            width: 45px;
            height: 45px;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
            transition: all 0.2s ease;
        }

        .scroll-to-top:hover {
            background: #4f46e5;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
        }

        /* Animations Smooth */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeIn 0.4s ease;
        }

        /* Badge Minimalis */
        .badge {
            border-radius: 6px;
            padding: 0.375rem 0.75rem;
            font-weight: 500;
            font-size: 0.8rem;
        }

        .badge-primary {
            background: #6366f1;
        }

        .badge-success {
            background: #10b981;
        }

        .badge-danger {
            background: #ef4444;
        }

        .badge-warning {
            background: #f59e0b;
        }

        .badge-info {
            background: #06b6d4;
        }

        /* Alert Minimalis */
        .alert {
            border: 1px solid;
            border-radius: 8px;
            padding: 0.875rem 1.25rem;
            box-shadow: none;
        }

        /* Form Controls Minimalis */
        .form-control {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 0.5rem 0.875rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .form-select {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 0.5rem 0.875rem;
            transition: all 0.2s ease;
        }

        .form-select:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        /* Modal Minimalis */
        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            border-bottom: 1px solid #e9ecef;
            padding: 1.25rem 1.5rem;
            background: #f8f9fa;
            border-radius: 12px 12px 0 0;
        }

        .modal-title {
            font-weight: 600;
            color: #1e293b;
        }

        .modal-footer {
            border-top: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar .sidebar-brand-text {
                font-size: 1rem;
            }
            
            .card-header {
                font-size: 0.9rem;
            }
        }
    </style>

    @stack('styles')
</head>

<body id="page-top">

<div id="wrapper">

    {{-- Sidebar --}}
    @include('kasir.partials.sidebar')

    {{-- Content Wrapper --}}
    <div id="content-wrapper" class="d-flex flex-column">

        {{-- Main Content --}}
        <div id="content">

            {{-- Topbar --}}
            @include('kasir.partials.topbar')

            {{-- Page Content --}}
            <div class="container-fluid">
                @yield('content')
            </div>

        </div>

        {{-- Footer --}}
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Jamila Bakery {{ date('Y') }}</span>
                </div>
            </div>
        </footer>

    </div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

{{-- Logout Modal --}}
@include('kasir.partials.logout-modal')

<!-- Scripts -->
<script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

<script>
    // Add smooth animations
    $(document).ready(function() {
        // Fade in cards
        $('.card').each(function(i) {
            $(this).css('animation-delay', (i * 0.1) + 's');
        });

        // Smooth scroll
        $('a.scroll-to-top').click(function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop: 0}, 800, 'easeInOutExpo');
        });
    });
</script>

@stack('scripts')

</body>
</html>