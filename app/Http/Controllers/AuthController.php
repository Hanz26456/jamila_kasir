<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        // Kalau sudah login, redirect sesuai role
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        
        return view('admin.login.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        // Coba login
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Log untuk debugging
            Log::info('User login:', [
                'email' => $user->email,
                'role' => $user->role,
            ]);
            
            return $this->redirectBasedOnRole();
        }

        // Kalau gagal
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }
    public function showRegisterForm()
{
    if (Auth::check()) {
        return $this->redirectBasedOnRole();
    }
    return view('admin.login.register'); // Pastikan file ini ada
}

// Proses registrasi
public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ], [
        'name.required' => 'Nama lengkap wajib diisi',
        'email.unique' => 'Email sudah terdaftar',
        'password.confirmed' => 'Konfirmasi password tidak cocok',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'kasir', // Default role saat daftar sendiri
    ]);

    return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan masuk.');
}

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'Berhasil logout');
    }

  public function adminDashboard()
{
    $now = now();
    
    // --- DATA UNTUK CARDS ---
    $monthlyEarnings = \App\Models\Order::where('payment_status', 'paid')
                        ->whereMonth('order_date', $now->month)
                        ->whereYear('order_date', $now->year)
                        ->sum('total_price');

    $annualEarnings = \App\Models\Order::where('payment_status', 'paid')
                        ->whereYear('order_date', $now->year)
                        ->sum('total_price');

    $totalOrders = \App\Models\Order::count();
    $paidOrders = \App\Models\Order::where('payment_status', 'paid')->count();
    $paymentPercentage = $totalOrders > 0 ? ($paidOrders / $totalOrders) * 100 : 0;

    $pendingPayments = \App\Models\Order::where('payment_status', 'unpaid')
                        ->where('status', 'processing')
                        ->count();

    // --- DATA UNTUK AREA CHART (Grafik Garis) ---
    // Kita buat array kosong dulu agar tidak Undefined jika data tidak ada
    $months = [];
    $chartEarnings = [];
    
    for ($i = 5; $i >= 0; $i--) {
        $date = now()->subMonths($i);
        $months[] = $date->format('M'); // Contoh: Jan, Feb, Mar
        $chartEarnings[] = \App\Models\Order::where('payment_status', 'paid')
            ->whereMonth('order_date', $date->month)
            ->whereYear('order_date', $date->year)
            ->sum('total_price');
    }

    // --- DATA UNTUK PIE CHART ---
    $statusCounts = [
        \App\Models\Order::where('status', 'pending')->count(),
        \App\Models\Order::where('status', 'done')->count(),
        \App\Models\Order::where('status', 'processing')->count(),
    ];

    // Mengirim semua variabel ke view menggunakan compact()
    return view('admin.pages.dashboard', compact(
        'monthlyEarnings', 
        'annualEarnings', 
        'paymentPercentage', 
        'pendingPayments',
        'months',         // Variabel yang menyebabkan error tadi
        'chartEarnings', 
        'statusCounts'
    ));
}

    // Dashboard Kasir
    public function kasirDashboard()
    {
        // View path sesuai struktur folder: kasir/pages/dashboard.blade.php
        return view('kasir.pages.dashboard');
    }

    // Redirect berdasarkan role
    private function redirectBasedOnRole()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            return redirect()->route('admin.pages.dashboard');
        } elseif ($user->role === 'kasir') {
            return redirect()->route('kasir.pages.dashboard');
        }
        
        // Kalau role tidak dikenal, logout dan kembalikan ke login
        Auth::logout();
        return redirect()->route('login')->withErrors([
            'email' => 'Role user tidak valid',
        ]);
    }
    
}