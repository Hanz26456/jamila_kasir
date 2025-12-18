<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Tampilkan semua produk
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.pages.products.index', compact('products'));
    }

    // Form tambah produk
    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.products.create', compact('categories'));
    }

    // Simpan produk baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ], [
            'category_id.required' => 'Kategori wajib dipilih',
            'name.required' => 'Nama produk wajib diisi',
            'price.required' => 'Harga wajib diisi',
            'stock.required' => 'Stok wajib diisi',
        ]);

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    // Detail produk
    public function show(Product $product)
    {
        $product->load('category');
        return view('admin.pages.products.show', compact('product'));
    }

    // Form edit produk
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.pages.products.edit', compact('product', 'categories'));
    }

    // Update produk
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    // Hapus produk
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
    public function stockMonitoring()
{
    // Mengambil produk dengan stok di bawah 10 (stok kritis)
    $lowStockProducts = Product::with('category')
        ->where('stock', '<', 10)
        ->orderBy('stock', 'asc')
        ->get();

    // Mengambil semua produk untuk tabel pantauan
    $allProducts = Product::with('category')
        ->orderBy('stock', 'asc')
        ->paginate(15);

    return view('admin.pages.products.stock', compact('lowStockProducts', 'allProducts'));
}
}