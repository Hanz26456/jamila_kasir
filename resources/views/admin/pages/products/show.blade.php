@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Produk</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Produk: {{ $product->name }}</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Nama Produk</th>
                            <td>: {{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>: <span class="badge badge-info">{{ $product->category->name }}</span></td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>: <strong class="text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</strong></td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>: 
                                @if($product->stock < 10)
                                    <span class="badge badge-danger">{{ $product->stock }} (Stok Menipis)</span>
                                @else
                                    <span class="badge badge-success">{{ $product->stock }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>: 
                                {!! $product->status 
                                    ? '<span class="badge badge-success">Aktif</span>' 
                                    : '<span class="badge badge-secondary">Nonaktif</span>' 
                                !!}
                            </td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>: <br><p class="mt-2 text-justify text-dark">{{ $product->description ?? 'Tidak ada deskripsi.' }}</p></td>
                        </tr>
                        <tr>
                            <th>Tanggal Dibuat</th>
                            <td>: {{ $product->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Terakhir Diupdate</th>
                            <td>: {{ $product->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer bg-white">
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit Produk
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Foto Produk</h6>
                </div>
                <div class="card-body text-center">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="img-fluid rounded shadow-sm border"
                             style="max-height: 400px; width: 100%; object-fit: contain;">
                    @else
                        <div class="bg-light d-flex flex-column align-items-center justify-content-center border rounded py-5">
                            <i class="fas fa-image fa-4x text-gray-300 mb-3"></i>
                            <p class="text-gray-500">Tidak ada foto tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection