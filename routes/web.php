<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('pages.home');    
})->name('home');

Route::get('/about', function () {
    return view('pages.about');    
})->name('about');

Route::get('/product', function () {
    return view('pages.product');    
})->name('product');

Route::get('/contact', function () {
    return view('pages.contact');    
})->name('contact');

Route::get('/service', function () {
    return view('pages.services');    
})->name('service');

Route::get('/team', function () {
    return view('pages.team');    
})->name('team');

Route::get('/testimonial', function () {
    return view('pages.testimonial');    
})->name('testimonial');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Logout route - Harus sudah login
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin routes - Harus login & role admin
Route::middleware(['auth', 'checkrole:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Gunakan group pages
     Route::prefix('pages')->name('pages.')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'adminDashboard'])->name('dashboard');
    });
     Route::resource('categories', CategoryController::class)->except(['show']);
    // Products
    Route::resource('products', ProductController::class);
    // Orders
    Route::resource('orders', OrderController::class)->only(['index', 'create', 'store', 'show']);
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    // Customers
    Route::resource('customers', CustomerController::class);
    // Kita buat terpisah agar bisa memproses pembayaran dari detail order
    Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('orders/{order}/payment', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('orders/{order}/payment', [PaymentController::class, 'store'])->name('payments.store');
    // Phase 2 - Stok Produk (Monitoring)
    Route::get('stock-monitoring', [ProductController::class, 'stockMonitoring'])->name('stock.monitoring');
    // Phase 3 - Voucher (CRUD)
    Route::resource('vouchers', VoucherController::class);
    // Phase 3 - Laporan Penjualan
    Route::get('reports/sales', [ReportController::class, 'sales'])->name('reports.sales');
    // Phase 3 - Kelola Pengguna (CRUD)
    Route::resource('users', UserController::class);
});
// Kasir routes - Harus login & role kasir
Route::middleware(['auth', 'checkrole:kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'kasirDashboard'])->name('dashboard');
    // Tambahkan route kasir lainnya di sini
});
