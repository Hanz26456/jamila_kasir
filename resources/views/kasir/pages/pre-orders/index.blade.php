@extends('kasir.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-0 text-gray-800">Daftar Pre-Order</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('kasir.pre-orders.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Buat Pre-Order Baru
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Siap Diambil (Hari Ini)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['ready_today'] }} Pesanan</div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Jadwal Pengiriman Hari Ini</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pickup_today'] }} Pesanan</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form action="{{ route('kasir.pre-orders.index') }}" method="GET" class="form-inline">
                <select name="status" class="form-control mr-2">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed (DP)</option>
                    <option value="ready" {{ request('status') == 'ready' ? 'selected' : '' }}>Siap Diambil</option>
                </select>
                <button type="submit" class="btn btn-secondary">Filter</button>
                <a href="{{ route('kasir.pre-orders.index', ['today' => 1]) }}" class="btn btn-info ml-2">Pengiriman Hari Ini</a>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No. Order</th>
                            <th>Pelanggan</th>
                            <th>Produk</th>
                            <th>Tgl Ambil</th>
                            <th>Status</th>
                            <th>Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($preOrders as $po)
                        <tr>
                            <td><strong>{{ $po->order_number }}</strong></td>
                            <td>{{ $po->customer->name }}</td>
                            <td>{{ $po->product_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($po->delivery_date)->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge badge-{{ $po->status == 'ready' ? 'success' : ($po->status == 'pending' ? 'warning' : 'primary') }}">
                                    {{ strtoupper($po->status) }}
                                </span>
                            </td>
                            <td>
                                <span class="text-{{ $po->payment_status == 'paid' ? 'success' : 'danger' }}">
                                    {{ $po->payment_status == 'unpaid' ? 'Belum DP' : ($po->payment_status == 'dp_paid' ? 'DP Paid' : 'Lunas') }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('kasir.pre-orders.show', $po->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                @if($po->payment_status == 'unpaid')
                                    <a href="{{ route('kasir.pre-orders.pay-dp', $po->id) }}" class="btn btn-sm btn-warning">Bayar DP</a>
                                @elseif($po->payment_status == 'dp_paid')
                                    <a href="{{ route('kasir.pre-orders.pay-remaining', $po->id) }}" class="btn btn-sm btn-success">Pelunasan</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $preOrders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection