<?php

use Illuminate\Support\Facades\Route;

/** * BAGIAN 1: IMPORT CONTROLLERS
 * Pastikan Namespace sesuai dengan folder (Case-Sensitive)
 */
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PreOrderController;

// Import sub-folder Kasir dengan Alias agar tidak bentrok
use App\Http\Controllers\Kasir\OrderController as KasirOrder;
use App\Http\Controllers\Kasir\CustomerController as KasirCustomer;
use App\Http\Controllers\Kasir\PreOrderController as KasirPreOrder;

/**
 * BAGIAN 2: GUEST & LANDING PAGE
 */
Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;
        return $role === 'admin' 
            ? redirect()->route('admin.pages.dashboard') 
            : redirect()->route('kasir.pages.dashboard');
    }
    return view('pages.home');    
})->name('home');

// Halaman Statis
Route::view('/about', 'pages.about')->name('about');
Route::view('/product', 'pages.product')->name('product');
Route::view('/contact', 'pages.contact')->name('contact');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/**
 * BAGIAN 3: ADMIN ROUTES (Namespace Utama)
 */
Route::middleware(['auth', 'checkrole:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('pages')->name('pages.')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'adminDashboard'])->name('dashboard');
    });

    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('products', ProductController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('users', UserController::class);
    Route::resource('vouchers', VoucherController::class);
    Route::resource('pre-orders', PreOrderController::class);

    // Order & Payment
    Route::resource('orders', OrderController::class);
    Route::get('orders/{order}/print', [OrderController::class, 'print'])->name('orders.print');
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('orders/{order}/payment', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('orders/{order}/payment', [PaymentController::class, 'store'])->name('payments.store');

    // Reports & Monitoring
    Route::get('reports/sales', [ReportController::class, 'sales'])->name('reports.sales');
    Route::get('stock-monitoring', [ProductController::class, 'stockMonitoring'])->name('stock.monitoring');
});

/**
 * BAGIAN 4: KASIR ROUTES (Sub-folder Kasir)
 */
Route::middleware(['auth', 'checkrole:kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::prefix('pages')->name('pages.')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'kasirdashboard'])->name('dashboard');
    });

    // Menggunakan KasirCustomer (Alias dari App\Http\Controllers\Kasir\CustomerController)
    Route::resource('customers', KasirCustomer::class);

    // Orders Kasir
    Route::get('orders', [KasirOrder::class, 'index'])->name('orders.index');
    Route::get('orders/create', [KasirOrder::class, 'create'])->name('orders.create');
    Route::post('orders', [KasirOrder::class, 'store'])->name('orders.store');
    Route::get('orders/antrean', [KasirOrder::class, 'antrean'])->name('orders.antrean');
    Route::get('orders/{order}', [KasirOrder::class, 'show'])->name('orders.show');
    Route::get('orders/{order}/print', [KasirOrder::class, 'print'])->name('orders.print');
    Route::post('orders/{id}/bayar', [KasirOrder::class, 'bayar'])->name('orders.bayar');

    // Pre-Order Kasir
    Route::resource('pre-orders', KasirPreOrder::class);
    Route::get('pre-orders-payment-queue', [KasirPreOrder::class, 'antrean'])->name('pre-orders.payment-queue');
    Route::get('pre-orders-schedule', [KasirPreOrder::class, 'schedule'])->name('pre-orders.schedule');
});