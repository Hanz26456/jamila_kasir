@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Antrean Pembayaran</h1>
        <div>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-list fa-sm"></i> Daftar Pesanan
            </a>
        </div>
    </div>

    <div class="alert alert-info border-left-info shadow" role="alert">
        <i class="fas fa-info-circle"></i> Daftar di bawah ini hanya menampilkan pesanan dengan status <strong>Processing</strong> yang belum dibayar.
    </div>

    <div class="card shadow mb-4 border-left-warning">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pesanan Belum Lunas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th width="10%">No. Order</th>
                            <th>Pelanggan</th>
                            <th>Tgl Pesan</th>
                            <th>Total Tagihan</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingOrders as $order)
                        <tr>
                            <td class="font-weight-bold">#{{ $order->id }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y H:i') }}</td>
                            <td class="font-weight-bold text-danger">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td>
                                <a href="{{ route('admin.payments.create', $order->id) }}" class="btn btn-success btn-sm btn-block">
                                    <i class="fas fa-cash-register"></i> Bayar
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="mb-3">
                                    <i class="fas fa-check-circle text-success fa-3x"></i>
                                </div>
                                <h5 class="text-gray-800">Semua Beres!</h5>
                                <p class="mb-0">Tidak ada antrean pembayaran yang perlu diproses.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $pendingOrders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection