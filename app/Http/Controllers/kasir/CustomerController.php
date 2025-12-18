<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        return view('kasir.pages.customers.index', compact('customers'));
    }

   public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255|unique:customers,email', // Tambah Email
            'address' => 'nullable|string',
        ]);

        Customer::create($validated);
        return back()->with('success', 'Pelanggan baru berhasil ditambahkan!');
    }

    // Fungsi Update untuk Opsi Edit
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255|unique:customers,email,' . $customer->id,
            'address' => 'nullable|string',
        ]);

        $customer->update($validated);
        return back()->with('success', 'Data pelanggan berhasil diperbarui!');
    }
}
