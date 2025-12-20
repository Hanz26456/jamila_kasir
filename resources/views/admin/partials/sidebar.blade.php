<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.pages.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-bread-slice"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Jamila Bakery</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.pages.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.pages.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading Master Data -->
    <div class="sidebar-heading">
        Master Data
    </div>

    <!-- Categories -->
    <li class="nav-item {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
            <i class="fas fa-fw fa-tags"></i>
            <span>Kategori</span>
        </a>
    </li>

    <!-- Products -->
    <li class="nav-item {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.products.index') }}">
            <i class="fas fa-fw fa-box"></i>
            <span>Produk</span>
        </a>
    </li>

    <!-- Customers -->
    <li class="nav-item {{ request()->routeIs('admin.customers.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.customers.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span> Data Pelanggan</span>
        </a>
    </li>

    <!-- Vouchers -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.vouchers.index') }}">
            <i class="fas fa-fw fa-ticket-alt"></i>
            <span>Voucher</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading Transaksi -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <!-- Orders -->
   <li class="nav-item {{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.orders.index') }}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Pesanan</span>
        </a>
    </li>

     <!-- Pre-orders -->
   <li class="nav-item {{ request()->routeIs('admin.pre-orders.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.pre-orders.index') }}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Pre Order</span>
        </a>
    </li>

    <!-- Payments -->
    <li class="nav-item">
         <a class="nav-link" href="{{ route('admin.payments.index') }}">
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Pembayaran</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading Laporan -->
    <div class="sidebar-heading">
        Laporan
    </div>

    <!-- Sales Report -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.reports.sales') }}">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Laporan Penjualan</span>
        </a>
    </li>

    <!-- Product Stock Report -->
     <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.stock.monitoring') }}">
        <i class="fas fa-fw fa-chart-line"></i>
        <span>Monitoring Stok</span>
    </a>
</li>

    {{-- <!-- Customer Report -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-user-chart"></i>
            <span>Laporan Pelanggan</span>
        </a>
    </li> --}}

    <hr class="sidebar-divider">

    <!-- Heading Pengaturan -->
    <div class="sidebar-heading">
        Pengaturan
    </div>

    <!-- Users Management -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Kelola Pengguna</span>
        </a>
    </li>

    <!-- Settings -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pengaturan</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>