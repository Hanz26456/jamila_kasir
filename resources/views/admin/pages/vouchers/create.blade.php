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
                        <input type="text" name="code" class="form-control" placeholder="Contoh: PROMOJAMILA" required>
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
                    <small class="text-muted">* Tahan tombol <strong>Ctrl</strong> (Windows) atau <strong>Command</strong> (Mac) untuk memilih lebih dari satu produk.</small>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Tipe Diskon</label>
                        <select name="discount_type" class="form-control">
                            <option value="fixed">Potongan Harga (Rp)</option>
                            <option value="percentage">Persentase (%)</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Nilai Diskon</label>
                        <input type="number" name="discount_value" class="form-control" required>
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

{{-- Tambahkan ini jika kamu ingin tampilan select lebih bagus (Opsional) --}}
@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "-- Pilih Produk --",
            allowClear: true
        });
    });
</script>
@endpush
@endsection