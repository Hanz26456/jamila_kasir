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
        Operasional Kasir
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
    <a class="nav-link" href="{{ route('kasir.orders.antrean') }}"> {{-- Pastikan ada prefix kasir. --}}
        <i class="fas fa-fw fa-money-bill-wave"></i>
        <span>Antrean Pembayaran</span>
    </a>
</li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Informasi Produk
    </div>

    <li class="nav-item {{ request()->routeIs('kasir.products.stock') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('kasir.products.stock') }}">
        <i class="fas fa-fw fa-boxes"></i>
        <span>Cek Stok Roti</span>
    </a>
</li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>