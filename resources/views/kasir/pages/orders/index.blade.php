@extends('kasir.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Riwayat Pesanan</h1>
        <a href="{{ route('kasir.orders.create') }}" class="btn btn-info btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Pesanan Baru
        </a>
    </div>

    <div class="card shadow mb-4 border-left-info">
        <div class="card-header py-3 bg-light">
            <h6 class="m-0 font-weight-bold text-info">Daftar Transaksi Jamila Bakery</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%">
                    <thead class="bg-light text-center">
                        <tr>
                            <th>No. Nota</th>
                            <th>Pelanggan</th>
                            <th>Tgl Ambil</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td class="text-center font-weight-bold">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($order->pickup_date)->format('d/m/Y') }}</td>
                            <td class="text-right font-weight-bold text-dark">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                <span class="badge badge-{{ $order->status == 'done' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }} text-uppercase px-2">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('kasir.orders.show', $order->id) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($order->payment_status == 'paid')
                                        <a href="{{ route('kasir.orders.print', $order->id) }}" target="_blank" class="btn btn-secondary btn-sm" title="Cetak Nota">
                                            <i class="fas fa-print"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada pesanan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection