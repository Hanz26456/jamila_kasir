@extends('kasir.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pesanan #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h1>
        <div class="btn-group">
            <a href="{{ route('kasir.orders.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button onclick="window.print()" class="btn btn-primary btn-sm ml-2">
                <i class="fas fa-print"></i> Cetak Struk
            </button>
        </div>
    </div>

    <div class="row">
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
                        <hr>
                        <tr>
                            <td>Tanggal Pesan</td>
                            <td>:</td>
                            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td>Rencana Ambil</td>
                            <td>:</td>
                            <td class="text-danger font-weight-bold">
                                {{ \Carbon\Carbon::parse($order->pickup_date)->format('d M Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Status Pesanan</td>
                            <td>:</td>
                            <td>
                                <span class="badge badge-info">{{ strtoupper($order->status) }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow mb-4 border-left-info">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Daftar Roti yang Dibeli</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead class="bg-light text-dark">
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center">Harga Satuan</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td class="text-center">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-right font-weight-bold">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-light">
                                
                            @php
                                $subtotalKotor = $order->orderItems->sum('subtotal');
                                $nominalDiskon = $subtotalKotor - $order->total_price;
                            @endphp

                            <tr>
                                <th colspan="3" class="text-right">Subtotal</th>
                                <th class="text-right">Rp {{ number_format($subtotalKotor, 0, ',', '.') }}</th>
                            </tr>

                            {{-- Hanya muncul jika ada potongan diskon/voucher --}}
                            @if($nominalDiskon > 0)
                            <tr class="text-danger">
                                <th colspan="3" class="text-right">
                                    <i class="fas fa-ticket-alt mr-1"></i> Potongan Voucher
                                </th>
                                <th class="text-right">- Rp {{ number_format($nominalDiskon, 0, ',', '.') }}</th>
                            </tr>
                            @endif

                            <tr>
                                <th colspan="3" class="text-right">Total Akhir (Setelah Diskon)</th>
                                <th class="text-right text-info h5 font-weight-bold">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </th>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        /* Hilangkan elemen navigasi */
        .btn, footer, .sidebar, .navbar, .card-header { display: none !important; }
        
        /* Setting ukuran kertas thermal */
        body { 
            width: 80mm; /* Atur ke 58mm jika printer kecil */
            margin: 0; 
            padding: 0; 
            font-family: 'Courier New', Courier, monospace; 
            font-size: 12px;
        }
        
        .container-fluid, .card, .card-body { 
            width: 100% !important; 
            margin: 0 !important; 
            padding: 0 !important; 
            border: none !important;
        }

        .table-bordered, .table-bordered td, .table-bordered th {
            border: none !important;
            border-bottom: 1px dashed #000 !important;
        }

        .text-info { color: #000 !important; }
        
        /* Header Toko */
        .print-header {
            text-align: center;
            margin-bottom: 10px;
        }
    }
</style>

{{-- Tambahkan Header Toko di dalam konten yang hanya muncul saat print --}}
<div class="d-none d-print-block print-header">
    <h4>JAMILA BAKERY</h4>
    <p>Jl. Raya Toko Roti No. 1<br>Telp: 0812-xxxx-xxxx</p>
    <hr style="border-top: 1px dashed #000;">
</div>
@endsection