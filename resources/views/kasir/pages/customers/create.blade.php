@extends('kasir.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Pelanggan Baru</h1>
        <a href="{{ route('kasir.customers.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4 border-left-info">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Form Data Pelanggan</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('kasir.customers.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="font-weight-bold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" placeholder="Masukkan nama pelanggan" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Nomor Telepon</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                   value="{{ old('phone') }}" placeholder="Contoh: 08123456789" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Alamat (Opsional)</label>
                            <textarea name="address" class="form-control" rows="4" 
                                      placeholder="Alamat lengkap pelanggan...">{{ old('address') }}</textarea>
                        </div>

                        <hr>
                        <button type="submit" class="btn btn-info btn-block shadow-sm">
                            <i class="fas fa-save"></i> Simpan Pelanggan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection