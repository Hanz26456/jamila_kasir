@extends('kasir.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Riwayat Pesanan</h1>
        <a href="{{ route('kasir.orders.create') }}" class="btn btn-info btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Pesanan Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-left-success shadow show mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4 border-left-info">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info">Daftar Transaksi Jamila Bakery</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th>No. Nota</th>
                            <th>Pelanggan</th>
                            <th>Tgl Ambil</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td><strong>#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</strong></td>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->pickup_date)->format('d/m/Y') }}</td>
                            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>
                                @if($order->status == 'pending')
                                    <span class="badge badge-warning text-uppercase">Pending</span>
                                @elseif($order->status == 'processing')
                                    <span class="badge badge-info text-uppercase">Proses</span>
                                @elseif($order->status == 'done')
                                    <span class="badge badge-success text-uppercase">Selesai</span>
                                @else
                                    <span class="badge badge-secondary text-uppercase">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('kasir.orders.show', $order->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada pesanan hari ini.</td>
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