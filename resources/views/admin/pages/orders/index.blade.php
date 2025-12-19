@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Daftar Pesanan</h1>
        <a href="{{ route('admin.orders.create') }}" class="btn btn-primary shadow-sm font-weight-bold">
            <i class="fas fa-plus fa-sm text-white-50"></i> Buat Pesanan Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow border-left-success" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    <div class="card shadow mb-4 border-left-primary">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th>No. Order</th>
                            <th>Pelanggan</th>
                            <th>Total Harga</th>
                            <th>Status Order</th>
                            <th>Pembayaran</th>
                            <th>Tgl Ambil</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td class="font-weight-bold">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="text-dark font-weight-bold">{{ $order->customer->name }}</td>
                            <td>
                                <span class="font-weight-bold text-dark">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                @php
                                    $originalPrice = $order->orderItems->sum('subtotal');
                                    $isDiscounted = $originalPrice > $order->total_price;
                                @endphp
                                
                                @if($isDiscounted)
                                    <small class="badge badge-danger ml-1" title="Potongan: Rp {{ number_format($originalPrice - $order->total_price) }}">
                                        <i class="fas fa-tag"></i> PROMO
                                    </small>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-{{ $order->status == 'done' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }} px-2 py-1">
                                    {{ strtoupper($order->status) }}
                                </span>
                            </td>
                            <td>
                                @if($order->payment_status == 'unpaid')
                                    <span class="badge badge-pill badge-danger font-weight-bold shadow-sm">UNPAID</span>
                                @else
                                    <span class="badge badge-pill badge-success font-weight-bold shadow-sm">PAID</span>
                                @endif
                            </td>
                            <td class="small">{{ \Carbon\Carbon::parse($order->pickup_date)->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info shadow-sm" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($order->payment_status == 'unpaid')
                                        <a href="{{ route('admin.payments.create', $order->id) }}" class="btn btn-sm btn-success shadow-sm" title="Bayar">
                                            <i class="fas fa-cash-register"></i>
                                        </a>
                                    @else
                                        {{-- Tombol cetak instan di index --}}
                                        <a href="{{ route('admin.orders.print', $order->id) }}" target="_blank" class="btn btn-sm btn-secondary shadow-sm" title="Cetak Struk">
                                            <i class="fas fa-print"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">Belum ada data pesanan hari ini.</td>
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