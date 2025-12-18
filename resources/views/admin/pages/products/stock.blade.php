@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Monitoring Stok Produk</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-boxes fa-sm text-white-50"></i> Kelola Produk
        </a>
    </div>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Stok Kritis (< 10)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $lowStockProducts->count() }} Produk</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($lowStockProducts->count() > 0)
    <div class="card shadow mb-4 border-left-danger">
        <div class="card-header py-3 bg-danger text-white">
            <h6 class="m-0 font-weight-bold">PERINGATAN: Stok Hampir Habis!</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Stok Saat Ini</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lowStockProducts as $low)
                        <tr>
                            <td class="font-weight-bold text-danger">{{ $low->name }}</td>
                            <td>{{ $low->category->name }}</td>
                            <td>
                                <span class="badge badge-danger p-2">{{ $low->stock }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.products.edit', $low->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Stok
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Status Stok Semua Produk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Status Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allProducts as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>
                                @if($product->stock <= 0)
                                    <span class="badge badge-secondary p-2 w-100">HABIS (0)</span>
                                @elseif($product->stock < 10)
                                    <span class="badge badge-danger p-2 w-100 text-left">KRITIS ({{ $product->stock }})</span>
                                @elseif($product->stock < 30)
                                    <span class="badge badge-warning p-2 w-100 text-left text-dark">MENIPIS ({{ $product->stock }})</span>
                                @else
                                    <span class="badge badge-success p-2 w-100 text-left">AMAN ({{ $product->stock }})</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $allProducts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection