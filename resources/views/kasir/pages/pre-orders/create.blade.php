@extends('kasir.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Buat Pre-Order Baru</h1>

    {{-- 1. TAMBAHKAN BLOK PESAN ERROR UNTUK DEBUGGING --}}
    @if ($errors->any())
        <div class="alert alert-danger shadow">
            <strong>Gagal Simpan!</strong> Periksa kembali input berikut:
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('kasir.pre-orders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pelanggan</label>
                            <select name="customer_id" class="form-control select2" required>
                                <option value="">-- Pilih Pelanggan --</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }} ({{ $customer->phone }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Produk/Pesanan</label>
                            <input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}" required placeholder="Contoh: Kue Ulang Tahun Coklat">
                        </div>
                        <div class="form-group">
                            <label>Tipe Pesanan</label>
                            <select name="order_type" class="form-control" required>
                                <option value="custom_cake" {{ old('order_type') == 'custom_cake' ? 'selected' : '' }}>Custom Cake</option>
                                <option value="pre_order" {{ old('order_type') == 'pre_order' ? 'selected' : '' }}>Pre-Order Reguler</option>
                                <option value="catering" {{ old('order_type') == 'catering' ? 'selected' : '' }}>Catering</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pengambilan/Kirim</label>
                            <input type="date" name="delivery_date" class="form-control" value="{{ old('delivery_date') }}" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jumlah (Qty)</label>
                            <input type="number" name="quantity" class="form-control" id="qty" value="{{ old('quantity', 1) }}" min="1" required>
                        </div>
                        <div class="form-group">
                            <label>Harga Per Unit</label>
                            <input type="number" name="price_per_unit" class="form-control" id="price" value="{{ old('price_per_unit') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Persentase DP (%)</label>
                            <input type="number" name="dp_percentage" class="form-control" value="{{ old('dp_percentage', 50) }}" min="0" max="100" required>
                        </div>
                        <div class="form-group">
                            <label>Metode Penyerahan</label>
                            <select name="delivery_method" id="delivery_method" class="form-control" required>
                                <option value="pickup" {{ old('delivery_method') == 'pickup' ? 'selected' : '' }}>Ambil di Toko</option>
                                <option value="delivery" {{ old('delivery_method') == 'delivery' ? 'selected' : '' }}>Kirim (Kurir)</option>
                            </select>
                        </div>
                        
                        {{-- 2. TAMBAHKAN FIELD ALAMAT (DIBUTUHKAN CONTROLLER) --}}
                        <div class="form-group" id="address_group" style="display: {{ old('delivery_method') == 'delivery' ? 'block' : 'none' }};">
                            <label class="text-danger">Alamat Pengiriman *</label>
                            <textarea name="delivery_address" class="form-control" rows="2" placeholder="Alamat lengkap tujuan pengiriman">{{ old('delivery_address') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi Detail Pesanan</label>
                    <textarea name="description" class="form-control" rows="3" required placeholder="Detail rasa, tulisan di kue, dll">{{ old('description') }}</textarea>
                </div>

                {{-- 3. TAMBAHKAN FIELD CATATAN PELANGGAN (DIBUTUHKAN CONTROLLER) --}}
                <div class="form-group">
                    <label>Catatan Pelanggan (Optional)</label>
                    <textarea name="customer_notes" class="form-control" rows="2" placeholder="Contoh: Jangan terlalu manis">{{ old('customer_notes') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Catatan Desain & Gambar Referensi</label>
                    <textarea name="design_notes" class="form-control mb-2" rows="2" placeholder="Catatan tambahan untuk bagian produksi">{{ old('design_notes') }}</textarea>
                    <input type="file" name="reference_image" class="form-control-file">
                </div>

                <hr>
                <button type="submit" class="btn btn-primary px-5">Simpan Pre-Order</button>
                <a href="{{ route('kasir.pre-orders.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

{{-- 4. TAMBAHKAN JS UNTUK SHOW/HIDE ALAMAT --}}
<script>
    document.getElementById('delivery_method').addEventListener('change', function() {
        const addressGroup = document.getElementById('address_group');
        if (this.value === 'delivery') {
            addressGroup.style.display = 'block';
            addressGroup.querySelector('textarea').setAttribute('required', 'required');
        } else {
            addressGroup.style.display = 'none';
            addressGroup.querySelector('textarea').removeAttribute('required');
        }
    });
</script>
@endsection