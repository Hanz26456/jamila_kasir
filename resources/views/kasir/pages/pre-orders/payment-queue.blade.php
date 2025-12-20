@extends('kasir.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Antrean Ambil Pesanan (Pickup)</h1>
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No. Order</th>
                            <th>Nama Pelanggan</th>
                            <th>Produk</th>
                            <th>Sisa Tagihan</th>
                            <th>Status Produksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($preOrders as $po)
                        <tr>
                            <td>{{ $po->order_number }}</td>
                            <td>{{ $po->customer->name }} <br><small>{{ $po->customer->phone }}</small></td>
                            <td>{{ $po->product_name }} ({{ $po->quantity }} pcs)</td>
                            <td class="text-danger font-weight-bold">
                                Rp {{ number_format($po->remaining_payment, 0, ',', '.') }}
                            </td>
                            <td>
                                <span class="badge badge-{{ $po->status == 'ready' ? 'success' : 'info' }}">
                                    {{ strtoupper($po->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('kasir.pre-orders.pay-remaining', $po->id) }}" class="btn btn-primary">
                                    <i class="fas fa-money-bill-wave"></i> Proses Pelunasan
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada pesanan yang siap diambil hari ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $preOrders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection