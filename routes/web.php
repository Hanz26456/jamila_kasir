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

use App\Http\Controllers\Kasir\OrderController as KasirOrder;

use App\Http\Controllers\PreOrderController;

use App\Http\Controllers\Kasir\PreOrderController as KasirPreOrderController;



Route::get('/', function () {

    // Cek apakah user sudah login melalui session atau cookie remember-me

    if (auth()->check()) {

        $role = auth()->user()->role;

       

        // Redirect otomatis berdasarkan role

        if ($role === 'admin') {

            return redirect()->route('admin.pages.dashboard');

        } elseif ($role === 'kasir') {

            return redirect()->route('kasir.pages.dashboard');

        }

    }

   

    // Jika belum login, baru tampilkan landing page

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

     Route::get('/orders/{order}/print', [OrderController::class, 'print'])->name('orders.print');

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



    Route::resource('pre-orders', PreOrderController::class);

   

    // Pre-Order Payment Routes

    Route::post('pre-orders/{preOrder}/pay-dp', [PreOrderController::class, 'payDP'])

        ->name('pre-orders.pay-dp');

    Route::post('pre-orders/{preOrder}/pay-remaining', [PreOrderController::class, 'payRemaining'])

        ->name('pre-orders.pay-remaining');

   

    // Pre-Order Status Update

    Route::patch('pre-orders/{preOrder}/status', [PreOrderController::class, 'updateStatus'])

        ->name('pre-orders.update-status');

   

    // Print Pre-Order

    Route::get('pre-orders/{preOrder}/print', [PreOrderController::class, 'print'])

        ->name('pre-orders.print');

});

// Kasir routes - Harus login & role kasir

Route::middleware(['auth', 'checkrole:kasir'])->prefix('kasir')->name('kasir.')->group(function () {

   

    // Group Pages

    Route::prefix('pages')->name('pages.')->group(function () {

        Route::get('/dashboard', [AuthController::class, 'kasirdashboard'])->name('dashboard');

    });



    // Customers (Kasir)

    Route::resource('customers', \App\Http\Controllers\Kasir\CustomerController::class);



   // 3. FITUR PEMBAYARAN (Taruh di atas agar tidak dianggap parameter {order})

   Route::get('/kasir/orders/{order}/print', [KasirOrder::class, 'print'])->name('orders.print');

    Route::get('orders/antrean', [KasirOrder::class, 'antrean'])->name('orders.antrean');

    Route::post('orders/{id}/bayar', [KasirOrder::class, 'bayar'])->name('orders.bayar');



    // Pesanan (Orders) - Menggunakan Manual agar lebih aman dari konflik admin

    Route::get('orders', [KasirOrder::class, 'index'])->name('orders.index');

    Route::get('orders/create', [KasirOrder::class, 'create'])->name('orders.create');

    Route::post('orders', [KasirOrder::class, 'store'])->name('orders.store');

    Route::get('orders/{order}', [KasirOrder::class, 'show'])->name('orders.show');



    // Monitoring Stok (Pindahkan ke Controller Kasir jika ada, atau pastikan view-nya tosca)

    Route::get('stok-roti', [KasirOrder::class, 'stock'])->name('products.stock');



     Route::get('pre-orders', [KasirPreOrderController::class, 'index'])

        ->name('pre-orders.index');

    Route::get('pre-orders/create', [KasirPreOrderController::class, 'create'])

        ->name('pre-orders.create');

    Route::post('pre-orders', [KasirPreOrderController::class, 'store'])

        ->name('pre-orders.store');

    Route::get('pre-orders/{id}', [KasirPreOrderController::class, 'show'])

        ->name('pre-orders.show');

   

    // Payment Queue (Antrean Pembayaran)

    Route::get('pre-orders-payment-queue', [KasirPreOrderController::class, 'antrean'])

        ->name('pre-orders.payment-queue');

   

    // DP Payment

    Route::get('pre-orders/{id}/pay-dp', [KasirPreOrderController::class, 'showPayDP'])

        ->name('pre-orders.show-pay-dp');

    Route::post('pre-orders/{id}/pay-dp', [KasirPreOrderController::class, 'payDP'])

        ->name('pre-orders.pay-dp');

   

    // Remaining Payment (Pelunasan)

    Route::get('pre-orders/{id}/pay-remaining', [KasirPreOrderController::class, 'showPayRemaining'])

        ->name('pre-orders.show-pay-remaining');

    Route::post('pre-orders/{id}/pay-remaining', [KasirPreOrderController::class, 'payRemaining'])

        ->name('pre-orders.pay-remaining');

   

    // Update Status

    Route::patch('pre-orders/{id}/status', [KasirPreOrderController::class, 'updateStatus'])

        ->name('pre-orders.update-status');

   

    // Print

    Route::get('pre-orders/{id}/print', [KasirPreOrderController::class, 'print'])

        ->name('pre-orders.print');

   

    // Schedule (Jadwal Produksi)

    Route::get('pre-orders-schedule', [KasirPreOrderController::class, 'schedule'])

        ->name('pre-orders.schedule');

});