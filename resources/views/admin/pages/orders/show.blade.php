@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4 no-print">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Detail Pesanan #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h1>
        <div>
            @if($order->payment_status == 'paid')
                {{-- Tombol Cetak Struk mengarah ke route khusus print agar rapi di printer thermal --}}
                <a href="{{ route('admin.orders.print', $order->id) }}" target="_blank" class="btn btn-primary btn-sm shadow-sm">
                    <i class="fas fa-print fa-sm"></i> Cetak Struk
                </a>
            @endif
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm shadow-sm">
                <i class="fas fa-arrow-left fa-sm"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row no-print">
        <div class="col-lg-4">
            {{-- Card Informasi Pesanan --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pesanan</h6>
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>Pelanggan:</strong> {{ $order->customer->name }}</p>
                    <p class="mb-1"><strong>Tgl Ambil:</strong> {{ \Carbon\Carbon::parse($order->pickup_date)->format('d M Y') }}</p>
                    <p class="mb-1"><strong>Status:</strong> 
                        <span class="badge badge-{{ $order->status == 'done' ? 'success' : ($order->status == 'canceled' ? 'danger' : 'info') }}">
                            {{ strtoupper($order->status) }}
                        </span>
                    </p>
                    <hr>
                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="small font-weight-bold">Update Status Pesanan</label>
                            <select name="status" class="form-control form-control-sm mb-2 shadow-sm">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="done" {{ $order->status == 'done' ? 'selected' : '' }}>Done</option>
                                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm btn-block shadow-sm">Update Status</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Card Status Pembayaran --}}
            <div class="card shadow mb-4 border-left-{{ $order->payment_status == 'paid' ? 'success' : 'danger' }}">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-primary">Status Pembayaran</h6>
                </div>
                <div class="card-body">
                    @if($order->payment_status == 'unpaid')
                        <div class="text-center py-2">
                            <i class="fas fa-exclamation-circle text-danger fa-2x mb-2"></i>
                            <h5 class="text-danger font-weight-bold">BELUM DIBAYAR</h5>
                            <p class="small text-muted">Tagihan: <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></p>
                            <a href="{{ route('admin.payments.create', $order->id) }}" class="btn btn-success btn-sm btn-block shadow-sm">
                                <i class="fas fa-cash-register mr-1"></i> PROSES PEMBAYARAN
                            </a>
                        </div>
                    @else
                        <div class="text-center">
                            <i class="fas fa-check-circle text-success fa-2x mb-2"></i>
                            <h5 class="text-success font-weight-bold">LUNAS</h5>
                            
                            <div class="bg-light p-2 rounded text-left small mt-3 border">
                                <div class="d-flex justify-content-between">
                                    <span>Metode:</span>
                                    <span class="font-weight-bold">{{ strtoupper($order->payment?->payment_method ?? 'N/A') }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Uang Bayar:</span>
                                    <span>Rp {{ number_format($order->payment?->amount ?? $order->total_price, 0, ',', '.') }}</span>
                                </div>
                                @if(($order->payment?->change ?? 0) > 0)
                                <div class="d-flex justify-content-between text-danger font-weight-bold">
                                    <span>Kembalian:</span>
                                    <span>Rp {{ number_format($order->payment->change, 0, ',', '.') }}</span>
                                </div>
                                @endif
                            </div>
                            <hr class="my-2">
                            <small class="text-muted font-italic">
                                Dibayar: {{ $order->payment?->paid_at ? \Carbon\Carbon::parse($order->payment->paid_at)->format('d/m/y H:i') : '-' }}
                            </small>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow mb-4 border-bottom-primary">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-primary text-uppercase">Daftar Item Belanja</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-dark">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0">Produk</th>
                                    <th class="text-center border-0">Harga</th>
                                    <th class="text-center border-0">Qty</th>
                                    <th class="text-right border-0">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td class="font-weight-bold">{{ $item->product->name }}</td>
                                    <td class="text-center">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-right font-weight-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-light border-top font-weight-bold">
                                @php
                                    $subtotalOrder = $order->orderItems->sum('subtotal');
                                    $discountAmount = $subtotalOrder - $order->total_price;
                                @endphp
                                <tr>
                                    <td colspan="3" class="text-right text-muted">Subtotal</td>
                                    <td class="text-right">Rp {{ number_format($subtotalOrder, 0, ',', '.') }}</td>
                                </tr>
                                @if($discountAmount > 0)
                                <tr class="text-danger">
                                    <td colspan="3" class="text-right"><i class="fas fa-tag fa-sm"></i> Potongan Voucher</td>
                                    <td class="text-right">- Rp {{ number_format($discountAmount, 0, ',', '.') }}</td>
                                </tr>
                                @endif
                                <tr class="h5 font-weight-bold text-primary">
                                    <td colspan="3" class="text-right">Total Akhir</td>
                                    <td class="text-right border-left">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-0">
                    <small class="text-muted">
                        <i class="fas fa-user-circle mr-1"></i> Operator: {{ $order->creator->name ?? 'System' }} 
                        | <i class="fas fa-calendar-alt ml-2 mr-1"></i> Tgl Order: {{ $order->created_at->format('d M Y H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection