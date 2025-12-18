@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Pesanan</h1>
        <a href="{{ route('admin.orders.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Buat Pesanan Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No. Order</th>
                            <th>Pelanggan</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Status Pembayaran</th>
                            <th>Tgl Ambil</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td>
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                @php
                                    // Hitung selisih antara subtotal item dengan total_price akhir
                                    $originalPrice = $order->orderItems->sum('subtotal');
                                    $isDiscounted = $originalPrice > $order->total_price;
                                @endphp
                                
                                @if($isDiscounted)
                                    <i class="fas fa-tag text-success ml-1" title="Potongan Voucher"></i>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-{{ $order->status == 'done' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                            @if($order->payment_status == 'unpaid')
                                <span class="badge badge-pill badge-danger">Unpaid</span>
                            @else
                                <span class="badge badge-pill badge-success">Paid</span>
                            @endif
                        </td>
                            <td>{{ \Carbon\Carbon::parse($order->pickup_date)->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                @if($order->payment_status == 'unpaid')
                                <a href="{{ route('admin.payments.create', $order->id) }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-cash-register"></i> Bayar
                                </a>
                            @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada pesanan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection