@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Buat Pesanan Baru</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
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
                            <label>Pilih Pelanggan <span class="text-danger">*</span></label>
                            <select name="customer_id" class="form-control @error('customer_id') is-invalid @enderror" required>
                                <option value="">-- Pilih --</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Tanggal Pengambilan <span class="text-danger">*</span></label>
                            <input type="date" name="pickup_date" class="form-control @error('pickup_date') is-invalid @enderror" 
                                   min="{{ date('Y-m-d') }}" value="{{ old('pickup_date') }}" required>
                            @error('pickup_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Kode Voucher (Opsional)</label>
                            <div class="input-group">
                                <input type="text" name="voucher_code" class="form-control @error('voucher_code') is-invalid @enderror" 
                                       placeholder="DISKON10" value="{{ old('voucher_code') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-ticket-alt"></i></span>
                                </div>
                            </div>
                            @error('voucher_code') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Item Produk</h6>
                        <button type="button" class="btn btn-sm btn-success shadow-sm" id="add-item">
                            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Baris
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="order-items">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="45%">Produk</th>
                                        <th width="15%" class="text-center">Preview</th>
                                        <th width="25%">Qty</th>
                                        <th width="10%">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="item-row">
                                        <td class="align-middle">
                                            <select name="products[0][product_id]" class="form-control product-select" required>
                                                <option value="">-- Pilih Produk --</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}" 
                                                            data-image="{{ $product->image ? asset('storage/' . $product->image) : 'https://ui-avatars.com/api/?name='.urlencode($product->name).'&color=7F9CF5&background=EBF4FF' }}"
                                                            data-stock="{{ $product->stock }}">
                                                        {{ $product->name }} (Stok: {{ $product->stock }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-center align-middle">
                                            <img src="" class="img-preview img-thumbnail shadow-sm" 
                                                 style="width: 55px; height: 55px; object-fit: cover; display: none;">
                                        </td>
                                        <td class="align-middle">
                                            <input type="number" name="products[0][quantity]" class="form-control" min="1" placeholder="0" required>
                                        </td>
                                        <td class="text-center align-middle">
                                            </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow">
                            <i class="fas fa-save mr-2"></i> Simpan Pesanan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let itemIndex = 1;

        // Fungsi Update Preview
        function updatePreview(selectElement) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const imageUrl = selectedOption.getAttribute('data-image');
            const row = selectElement.closest('tr');
            const previewImg = row.querySelector('.img-preview');

            if (imageUrl && selectElement.value !== "") {
                previewImg.src = imageUrl;
                previewImg.style.display = 'inline-block';
            } else {
                previewImg.style.display = 'none';
            }
        }

        // Event Listener untuk baris awal
        document.querySelector('.product-select').addEventListener('change', function() {
            updatePreview(this);
        });

        // Tambah Item Baru
        document.getElementById('add-item').addEventListener('click', function() {
            const tableBody = document.querySelector('#order-items tbody');
            const newRow = document.querySelector('.item-row').cloneNode(true);
            
            // Atur ulang elemen di baris baru
            const select = newRow.querySelector('select');
            const input = newRow.querySelector('input');
            const previewImg = newRow.querySelector('.img-preview');

            // Reset value dan update name attribute
            select.setAttribute('name', `products[${itemIndex}][product_id]`);
            select.value = "";
            
            input.setAttribute('name', `products[${itemIndex}][quantity]`);
            input.value = "";

            // Sembunyikan preview gambar di baris baru
            previewImg.src = "";
            previewImg.style.display = 'none';
            
            // Tambahkan event listener change pada select baru
            select.addEventListener('change', function() {
                updatePreview(this);
            });
            
            // Tambahkan tombol hapus di kolom terakhir
            newRow.cells[3].innerHTML = `
                <button type="button" class="btn btn-danger btn-sm remove-item">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            
            tableBody.appendChild(newRow);
            itemIndex++;
        });

        // Hapus Item
        document.addEventListener('click', function(e) {
            if(e.target.closest('.remove-item')) {
                e.target.closest('tr').remove();
            }
        });
    });
</script>
@endpush
@endsection