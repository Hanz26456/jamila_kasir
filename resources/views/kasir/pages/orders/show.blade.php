@extends('kasir.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4 no-print">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Detail Pesanan #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h1>
        <div class="btn-group">
            <a href="{{ route('kasir.orders.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            @if($order->payment_status == 'paid')
                {{-- Membuka route print di tab baru --}}
                <a href="{{ route('kasir.orders.print', $order->id) }}" target="_blank" class="btn btn-primary btn-sm ml-2">
                    <i class="fas fa-print"></i> Cetak Nota
                </a>
            @endif
        </div>
    </div>

    <div class="row no-print">
        <div class="col-lg-4">
            <div class="card shadow mb-4 border-left-info">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Info Pelanggan & Pengambilan</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td width="150">Nama Pelanggan</td>
                            <td width="10">:</td>
                            <td class="font-weight-bold">{{ $order->customer->name }}</td>
                        </tr>
                        <tr>
                            <td>No. Telepon</td>
                            <td>:</td>
                            <td>{{ $order->customer->phone }}</td>
                        </tr>
                        <tr>
                            <td>Tgl Ambil</td>
                            <td>:</td>
                            <td class="text-danger font-weight-bold">
                                {{ \Carbon\Carbon::parse($order->pickup_date)->format('d M Y') }}
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <div class="text-center py-2">
                        <small class="text-muted text-uppercase d-block mb-1 small font-weight-bold">Status Pembayaran</small>
                        @if($order->payment_status == 'paid')
                            <h5 class="text-success font-weight-bold"><i class="fas fa-check-circle"></i> LUNAS</h5>
                            <div class="bg-light p-2 rounded text-left small mt-2 border">
                                <div class="d-flex justify-content-between">
                                    <span>Metode:</span>
                                    <span class="font-weight-bold">{{ strtoupper($order->payment?->payment_method ?? 'CASH') }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Bayar:</span>
                                    <span>Rp {{ number_format($order->payment?->amount ?? $order->total_price, 0, ',', '.') }}</span>
                                </div>
                                @if(($order->payment?->change ?? 0) > 0)
                                <div class="d-flex justify-content-between text-danger font-weight-bold border-top mt-1 pt-1">
                                    <span>Kembalian:</span>
                                    <span>Rp {{ number_format($order->payment->change, 0, ',', '.') }}</span>
                                </div>
                                @endif
                            </div>
                        @else
                            <h5 class="text-danger font-weight-bold"><i class="fas fa-clock"></i> BELUM BAYAR</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow mb-4 border-left-info">
                <div class="card-header py-3 bg-light">
                    <h6 class="m-0 font-weight-bold text-info">Rincian Belanja</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light text-dark">
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
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $item->product->image ? asset('storage/'.$item->product->image) : 'https://ui-avatars.com/api/?name='.urlencode($item->product->name) }}" 
                                                 class="rounded mr-2 shadow-sm" style="width: 35px; height: 35px; object-fit: cover;">
                                            <span class="font-weight-bold">{{ $item->product->name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-right font-weight-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-light">
                                @php
                                    $subtotalKotor = $order->orderItems->sum('subtotal');
                                    $nominalDiskon = $subtotalKotor - $order->total_price;
                                @endphp
                                <tr>
                                    <th colspan="3" class="text-right text-muted">Subtotal</th>
                                    <th class="text-right">Rp {{ number_format($subtotalKotor, 0, ',', '.') }}</th>
                                </tr>
                                @if($nominalDiskon > 0)
                                <tr class="text-danger font-weight-bold">
                                    <th colspan="3" class="text-right">Potongan Voucher</th>
                                    <th class="text-right">- Rp {{ number_format($nominalDiskon, 0, ',', '.') }}</th>
                                </tr>
                                @endif
                                <tr class="text-info h5 font-weight-bold">
                                    <th colspan="3" class="text-right">TOTAL AKHIR</th>
                                    <th class="text-right border-left">Rp {{ number_format($order->total_price, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection