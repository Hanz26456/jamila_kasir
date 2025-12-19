@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Voucher Baru</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.vouchers.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Kode Voucher</label>
                        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Contoh: PROMOJAMILA" value="{{ old('code') }}" required>
                        @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Berlaku Untuk Produk (Kosongkan jika ingin berlaku untuk SEMUA produk)</label>
                    <select name="product_ids[]" class="form-control select2" multiple="multiple">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} (Rp {{ number_format($product->price, 0, ',', '.') }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Tipe Diskon</label>
                        <select name="discount_type" class="form-control">
                            <option value="fixed">Potongan Harga (Rp)</option>
                            <option value="percentage">Persentase (%)</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Nilai Diskon</label>
                        <input type="number" name="discount_value" class="form-control" required min="0">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Kuota Pemakaian (Limit)</label>
                        <input type="number" name="usage_limit" class="form-control" placeholder="0 = Tak Terbatas" required min="0">
                        @error('usage_limit') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Tanggal Berakhir</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Simpan Voucher</button>
            </form>
        </div>
    </div>
</div>
@endsection