@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4 no-print">
        <h1 class="h3 mb-0 text-gray-800">Detail Pesanan #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h1>
        <div>
            @if($order->payment_status == 'paid')
                <button onclick="window.print()" class="btn btn-primary btn-sm shadow-sm">
                    <i class="fas fa-print fa-sm"></i> Cetak Struk
                </button>
            @endif
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm shadow-sm">
                <i class="fas fa-arrow-left fa-sm"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row no-print">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pesanan</h6>
                </div>
                <div class="card-body">
                    <p><strong>Pelanggan:</strong> {{ $order->customer->name }}</p>
                    <p><strong>Tgl Ambil:</strong> {{ \Carbon\Carbon::parse($order->pickup_date)->format('d M Y') }}</p>
                    <p><strong>Status Pesanan:</strong> 
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
                            <select name="status" class="form-control form-control-sm mb-2">
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
                            
                            <table class="table table-sm table-borderless text-left mt-3 small">
                                <tr>
                                    <td>Metode</td>
                                    <td>: <strong>{{ strtoupper($order->payment_method ?? $order->payment?->payment_method ?? 'N/A') }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Total Bayar</td>
                                    <td>: Rp {{ number_format($order->payment?->amount ?? $order->total_price, 0, ',', '.') }}</td>
                                </tr>
                                @if(($order->payment?->change ?? 0) > 0)
                                <tr class="text-danger">
                                    <td>Kembalian</td>
                                    <td>: Rp {{ number_format($order->payment->change, 0, ',', '.') }}</td>
                                </tr>
                                @endif
                            </table>
                            <hr>
                            <small class="text-muted">
                                Dibayar pada: {{ $order->payment?->paid_at ? \Carbon\Carbon::parse($order->payment->paid_at)->format('d/m/Y H:i') : $order->updated_at->format('d/m/Y H:i') }}
                            </small>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white shadow">
                    <h6 class="m-0 font-weight-bold">Daftar Item Belanja</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-flush m-0 text-dark">
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
                                    <th colspan="3" class="text-right"><i class="fas fa-tag fa-sm"></i> Potongan Voucher</th>
                                    <th class="text-right">- Rp {{ number_format($discountAmount, 0, ',', '.') }}</th>
                                </tr>
                                @endif
                                <tr>
                                    <th colspan="3" class="text-right h5 font-weight-bold text-dark">Total Akhir</th>
                                    <th class="text-right text-primary h5 font-weight-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <small class="text-muted">
                        <i class="fas fa-info-circle"></i> Pesanan dibuat oleh: <strong>{{ $order->creator->name ?? 'System' }}</strong> pada {{ $order->created_at->format('d/m/Y H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-none d-print-block">
    <div style="text-align:center;">
        <h4 style="margin:0;">JAMILA BAKERY</h4>
        <p style="font-size:12px; margin:5px 0;">Jl. Raya Toko Roti No.1<br>Telp: 0812-xxxx-xxxx</p>
    </div>
    <div style="border-top:1px dashed #000; margin:10px 0;"></div>
    <table style="width:100%; font-size:12px;">
        <tr>
            <td>Nota: #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
            <td style="text-align:right;">{{ $order->created_at->format('d/m/y H:i') }}</td>
        </tr>
        <tr>
            <td>Pelanggan:</td>
            <td style="text-align:right;">{{ $order->customer->name }}</td>
        </tr>
    </table>
    <div style="border-top:1px dashed #000; margin:10px 0;"></div>
    <table style="width:100%; font-size:12px; border-collapse: collapse;">
        @foreach($order->orderItems as $item)
        <tr>
            <td colspan="2">{{ $item->product->name }}</td>
        </tr>
        <tr>
            <td style="padding-bottom:5px;">{{ $item->quantity }} x {{ number_format($item->price) }}</td>
            <td style="text-align:right; vertical-align:top;">{{ number_format($item->subtotal) }}</td>
        </tr>
        @endforeach
    </table>
    <div style="border-top:1px dashed #000; margin:10px 0;"></div>
    <table style="width:100%; font-size:12px;">
        <tr>
            <td>Subtotal:</td>
            <td style="text-align:right;">Rp {{ number_format($subtotalOrder) }}</td>
        </tr>
        @if($discountAmount > 0)
        <tr>
            <td>Diskon:</td>
            <td style="text-align:right;">-Rp {{ number_format($discountAmount) }}</td>
        </tr>
        @endif
        <tr style="font-weight:bold;">
            <td>TOTAL:</td>
            <td style="text-align:right;">Rp {{ number_format($order->total_price) }}</td>
        </tr>
        <tr>
            <td>Bayar ({{ strtoupper($order->payment_method ?? $order->payment?->payment_method ?? 'Cash') }}):</td>
            <td style="text-align:right;">Rp {{ number_format($order->payment?->amount ?? $order->total_price) }}</td>
        </tr>
        @if(($order->payment?->change ?? 0) > 0)
        <tr>
            <td>Kembali:</td>
            <td style="text-align:right;">Rp {{ number_format($order->payment->change) }}</td>
        </tr>
        @endif
    </table>
    <div style="border-top:1px dashed #000; margin:10px 0;"></div>
    <p style="text-align:center; font-size:12px;">Terima Kasih Atas Kunjungan Anda!</p>
</div>

<style>
    @media print {
        /* Sembunyikan semua elemen UI admin */
        .no-print, #accordionSidebar, .navbar, .sticky-footer, .scroll-to-top {
            display: none !important;
        }
        /* Atur ukuran kertas struk */
        body {
            width: 80mm;
            margin: 0;
            padding: 0;
            color: #000 !important;
            background-color: #fff !important;
        }
        .container-fluid {
            padding: 0 !important;
            margin: 0 !important;
        }
        .card {
            border: none !important;
        }
    }
</style>
@endsection