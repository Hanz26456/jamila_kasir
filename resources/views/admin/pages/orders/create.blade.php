@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Buat Pesanan Baru</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.orders.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Pelanggan & Promo</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Pilih Pelanggan</label>
                            <select name="customer_id" class="form-control @error('customer_id') is-invalid @enderror" required>
                                <option value="">-- Pilih --</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pengambilan</label>
                            <input type="date" name="pickup_date" class="form-control" min="{{ date('Y-m-d') }}" value="{{ old('pickup_date') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Kode Voucher (Opsional)</label>
                            <div class="input-group">
                                <input type="text" name="voucher_code" class="form-control @error('voucher_code') is-invalid @enderror" 
                                       placeholder="Contoh: DISKON10" value="{{ old('voucher_code') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-ticket-alt"></i></span>
                                </div>
                            </div>
                            <small class="text-muted">Diskon akan dihitung saat pesanan disimpan.</small>
                            @error('voucher_code') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Item Produk</h6>
                        <button type="button" class="btn btn-sm btn-success" id="add-item">
                            <i class="fas fa-plus"></i> Tambah Item
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table" id="order-items">
                            <thead>
                                <tr>
                                    <th width="60%">Produk</th>
                                    <th width="30%">Qty</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="item-row">
                                    <td>
                                        <select name="products[0][product_id]" class="form-control" required>
                                            <option value="">-- Pilih Produk --</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }} (Stok: {{ $product->stock }})</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="products[0][quantity]" class="form-control" min="1" required>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <button type="submit" class="btn btn-primary btn-block">Simpan Pesanan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    let itemIndex = 1;
    document.getElementById('add-item').addEventListener('click', function() {
        let tableBody = document.querySelector('#order-items tbody');
        let newRow = document.querySelector('.item-row').cloneNode(true);
        
        // Update name attribute index
        newRow.querySelector('select').setAttribute('name', `products[${itemIndex}][product_id]`);
        newRow.querySelector('select').value = "";
        newRow.querySelector('input').setAttribute('name', `products[${itemIndex}][quantity]`);
        newRow.querySelector('input').value = "";
        
        // Add delete button
        newRow.cells[2].innerHTML = '<button type="button" class="btn btn-danger btn-sm remove-item"><i class="fas fa-trash"></i></button>';
        
        tableBody.appendChild(newRow);
        itemIndex++;
    });

    document.addEventListener('click', function(e) {
        if(e.target.closest('.remove-item')) {
            e.target.closest('tr').remove();
        }
    });
</script>
@endsection