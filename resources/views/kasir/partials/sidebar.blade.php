<style>
    /* Mengurangi padding atas bawah pada setiap menu */
    .sidebar .nav-item .nav-link {
        padding: 0.5rem 1rem !important;
        margin: 0 !important;
    }

    /* Mengurangi jarak pada garis pembatas (divider) */
    .sidebar .sidebar-divider {
        margin: 0.5rem 0 0.5rem 0 !important;
    }

    /* Mengurangi jarak pada heading (teks kecil abu-abu) */
    .sidebar .sidebar-heading {
        padding: 0.5rem 1rem 0.2rem !important;
        font-size: 0.65rem !important;
    }

    /* Memastikan icon dan teks sejajar rapi */
    .sidebar .nav-item .nav-link i {
        font-size: 0.85rem;
        margin-right: 0.5rem;
    }
</style>

<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('kasir.pages.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-bread-slice"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Jamila Bakery</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->routeIs('kasir.pages.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kasir.pages.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Operasional
    </div>

    <li class="nav-item {{ request()->routeIs('kasir.customers.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kasir.customers.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Pelanggan</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('kasir.orders.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kasir.orders.index') }}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Input Pesanan</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('kasir.orders.antrean') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kasir.orders.antrean') }}">
            <i class="fas fa-fw fa-money-bill-wave"></i>
            <span>Antrean Pembayaran</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('kasir.products.stock') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kasir.products.stock') }}">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Cek Stok Roti</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Pre-Order (PO)
    </div>

    <li class="nav-item {{ request()->routeIs('kasir.pre-orders.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kasir.pre-orders.index') }}">
            <i class="fas fa-fw fa-calendar-plus"></i>
            <span>Manajemen PO</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('kasir.pre-orders.payment-queue') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kasir.pre-orders.payment-queue') }}">
            <i class="fas fa-fw fa-hand-holding-heart"></i>
            <span>Antrean Ambil PO</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('kasir.pre-orders.schedule') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kasir.pre-orders.schedule') }}">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Jadwal PO Seminggu</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>