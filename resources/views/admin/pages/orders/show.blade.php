@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pesanan #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-4">
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pesanan</h6>
                </div>
                <div class="card-body">
                    <p><strong>Pelanggan:</strong> {{ $order->customer->name }}</p>
                    <p><strong>Tgl Ambil:</strong> {{ \Carbon\Carbon::parse($order->pickup_date)->format('d M Y') }}</p>
                    <p><strong>Status Pesanan:</strong> 
                        <span class="badge badge-{{ $order->status == 'done' ? 'success' : 'info' }}">
                            {{ strtoupper($order->status) }}
                        </span>
                    </p>
                    <hr>
                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="small font-weight-bold">Update Status Pesanan</label>
                            <select name="status" class="form-control form-control-sm mb-2">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="done" {{ $order->status == 'done' ? 'selected' : '' }}>Done</option>
                                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm btn-block">Update Status</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow mb-4 border-left-{{ $order->payment_status == 'paid' ? 'success' : 'danger' }}">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status Pembayaran</h6>
                </div>
                <div class="card-body">
                    @if($order->payment_status == 'unpaid')
                        <div class="text-center py-2">
                            <i class="fas fa-exclamation-circle text-danger fa-2x mb-2"></i>
                            <h5 class="text-danger font-weight-bold">BELUM DIBAYAR</h5>
                            <p class="small text-muted">Tagihan: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            <a href="{{ route('admin.payments.create', $order->id) }}" class="btn btn-success btn-sm btn-block shadow-sm">
                                <i class="fas fa-cash-register"></i> PROSES PEMBAYARAN
                            </a>
                        </div>
                    @else
                        <div class="text-center py-2">
                            <i class="fas fa-check-circle text-success fa-2x mb-2"></i>
                            <h5 class="text-success font-weight-bold">LUNAS</h5>
                            <p class="mb-0 small">Metode: <strong>{{ strtoupper($order->payment->payment_method) }}</strong></p>
                            <small class="text-muted">Dibayar pada: {{ \Carbon\Carbon::parse($order->payment->paid_at)->format('d/m/Y H:i') }}</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">Daftar Item Belanja</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-flush m-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td class="font-weight-bold text-dark">{{ $item->product->name }}</td>
                                    <td class="text-center">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-right font-weight-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-light">
                                @php
                                    $subtotalOrder = $order->orderItems->sum('subtotal');
                                    $discountAmount = $subtotalOrder - $order->total_price;
                                @endphp

                                <tr>
                                    <th colspan="3" class="text-right text-muted">Subtotal</th>
                                    <th class="text-right">Rp {{ number_format($subtotalOrder, 0, ',', '.') }}</th>
                                </tr>

                                @if($discountAmount > 0)
                                <tr class="text-danger">
                                    <th colspan="3" class="text-right">
                                        <i class="fas fa-tag fa-sm"></i> Potongan Voucher
                                    </th>
                                    <th class="text-right">- Rp {{ number_format($discountAmount, 0, ',', '.') }}</th>
                                </tr>
                                @endif

                                <tr>
                                    <th colspan="3" class="text-right h5 font-weight-bold text-dark">Total Akhir</th>
                                    <th class="text-right text-primary h5 font-weight-bold">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <small class="text-muted">
                        <i class="fas fa-info-circle"></i> Pesanan dibuat oleh: {{ $order->creator->name ?? 'System' }} pada {{ $order->created_at->format('d/m/Y H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection