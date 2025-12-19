<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Models\Product; // Pastikan ini di-import
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index() {
        $vouchers = Voucher::latest()->paginate(10);
        return view('admin.pages.vouchers.index', compact('vouchers'));
    }

    public function create() {
        // AMBIL DATA PRODUK UNTUK PILIHAN DI VIEW
        $products = Product::where('status', 1)->get();
        return view('admin.pages.vouchers.create', compact('products'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'code' => 'required|unique:vouchers,code|max:255',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'usage_limit' => 'required|integer|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|boolean',
            'product_ids' => 'nullable|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        $voucher = Voucher::create($validated);

        if ($request->has('product_ids')) {
            $voucher->products()->sync($request->product_ids);
        }

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil dibuat!');
    }

    public function edit(Voucher $voucher) {
        // AMBIL DATA PRODUK DAN LOAD RELASI
        $products = Product::where('status', 1)->get();
        $voucher->load('products'); 
        
        return view('admin.pages.vouchers.edit', compact('voucher', 'products'));
    }

    public function update(Request $request, Voucher $voucher) {
        $validated = $request->validate([
            'code' => 'required|max:255|unique:vouchers,code,' . $voucher->id,
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'usage_limit' => 'required|integer|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|boolean',
            'product_ids' => 'nullable|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        $voucher->update($validated);

        // Sync produk (jika tidak ada produk dipilih, kirim array kosong agar relasi dihapus)
        $voucher->products()->sync($request->product_ids ?? []);

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil diperbarui!');
    }

    public function destroy(Voucher $voucher) {
        // Relasi di tabel pivot akan terhapus otomatis karena onDelete('cascade') di migration
        $voucher->delete();
        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher dihapus!');
    }
}