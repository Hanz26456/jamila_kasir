@extends('kasir.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800 text-info font-weight-bold">Monitoring Stok Roti</h1>

    <div class="row">
        @foreach($products as $product)
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 {{ $product->stock <= 5 ? 'border-left-danger' : 'border-left-info' }}">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1 {{ $product->stock <= 5 ? 'text-danger' : 'text-info' }}">
                                {{ $product->category->name ?? 'Roti' }}
                            </div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">{{ $product->name }}</div>
                            <div class="mt-2">
                                <span class="badge {{ $product->stock <= 5 ? 'badge-danger' : 'badge-info' }}">
                                    Stok: {{ $product->stock }} Pcs
                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bread-slice fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Roti</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Sisa Stok</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? '-' }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>
                                <span class="font-weight-bold {{ $product->stock <= 5 ? 'text-danger' : '' }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td>
                                @if($product->stock > 0)
                                    <span class="badge badge-success">Tersedia</span>
                                @else
                                    <span class="badge badge-danger">Habis</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection