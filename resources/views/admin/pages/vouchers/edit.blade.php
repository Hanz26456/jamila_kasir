@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Voucher: {{ $voucher->code }}</h1>
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.vouchers.update', $voucher->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Kode Voucher</label>
                        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" 
                               value="{{ old('code', $voucher->code) }}" required>
                        @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ $voucher->status == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $voucher->status == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Berlaku Untuk Produk (Kosongkan jika ingin berlaku untuk SEMUA produk)</label>
                    <select name="product_ids[]" class="form-control select2" multiple="multiple">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" 
                                {{ in_array($product->id, $voucher->products->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $product->name }} (Rp {{ number_format($product->price, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Tipe Diskon</label>
                        <select name="discount_type" class="form-control">
                            <option value="fixed" {{ $voucher->discount_type == 'fixed' ? 'selected' : '' }}>Potongan Harga (Rp)</option>
                            <option value="percentage" {{ $voucher->discount_type == 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Nilai Diskon</label>
                        <input type="number" name="discount_value" class="form-control" 
                               value="{{ old('discount_value', $voucher->discount_value) }}" required min="0">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Kuota Pemakaian (Limit)</label>
                        <input type="number" name="usage_limit" class="form-control" 
                               value="{{ old('usage_limit', $voucher->usage_limit) }}" 
                               placeholder="0 = Tak Terbatas" required min="0">
                        <small class="text-muted">Terpakai saat ini: <strong>{{ $voucher->used_count }}</strong> kali.</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control" 
                               value="{{ old('start_date', date('Y-m-d', strtotime($voucher->start_date))) }}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Tanggal Berakhir</label>
                        <input type="date" name="end_date" class="form-control" 
                               value="{{ old('end_date', date('Y-m-d', strtotime($voucher->end_date))) }}" required>
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn btn-warning btn-block font-weight-bold">
                    <i class="fas fa-save mr-1"></i> Perbarui Voucher
                </button>
                <a href="{{ route('admin.vouchers.index') }}" class="btn btn-secondary btn-block">Batal</a>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "-- Pilih Produk --",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush
@endsection