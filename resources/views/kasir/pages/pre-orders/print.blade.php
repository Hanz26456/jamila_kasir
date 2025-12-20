<!DOCTYPE html>
<html>
<head>
    <title>Pre-Order {{ $preOrder->order_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Courier New', monospace; 
            width: 80mm; 
            margin: 0 auto; 
            padding: 10px; 
            color: #000;
        }
        .header { text-align: center; margin-bottom: 15px; border-bottom: 2px dashed #000; padding-bottom: 10px; }
        .header h2 { font-size: 18px; margin-bottom: 5px; text-transform: uppercase; }
        .header p { font-size: 12px; line-height: 1.4; }
        
        .section { margin: 10px 0; font-size: 12px; }
        .section-title { font-weight: bold; border-bottom: 1px solid #000; margin-bottom: 5px; padding-bottom: 3px; text-transform: uppercase; }
        
        .row { display: flex; justify-content: space-between; margin: 3px 0; }
        .item-row { border-bottom: 1px dashed #ccc; padding: 5px 0; }
        
        .total-section { margin-top: 10px; padding-top: 5px; border-top: 2px solid #000; }
        .footer { text-align: center; margin-top: 15px; padding-top: 10px; border-top: 2px dashed #000; font-size: 11px; }
        
        .status-badge {
            border: 1px solid #000;
            padding: 2px 5px;
            font-weight: bold;
            display: inline-block;
            margin-top: 5px;
        }

        @media print {
            .no-print { display: none; }
            body { width: 80mm; }
        }
        
        .btn-print {
            background: #4e73df;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 20px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    {{-- Navigasi Cetak --}}
    <div class="no-print" style="text-align: center;">
        <button onclick="window.print()" class="btn-print">CETAK SEKARANG</button>
        <a href="{{ route('kasir.pre-orders.show', $preOrder->id) }}" class="btn-print" style="background: #858796;">KEMBALI</a>
    </div>

    {{-- Header --}}
    <div class="header">
        <h2>JAMILA BAKERY</h2>
        <p>Jl. Contoh No. 123, Jember<br>
        Telp: 0331-123456</p>
    </div>

    {{-- Info Order --}}
    <div class="section">
        <div class="row">
            <span>No. Order:</span>
            <strong>{{ $preOrder->order_number }}</strong>
        </div>
        <div class="row">
            <span>Tanggal:</span>
            <span>{{ \Carbon\Carbon::parse($preOrder->order_date)->format('d/m/Y H:i') }}</span>
        </div>
        <div class="row">
            <span>Kasir:</span>
            <span>{{ $preOrder->creator->name }}</span>
        </div>
    </div>

    {{-- Customer --}}
    <div class="section">
        <div class="section-title">Pelanggan</div>
        <div class="row">
            <span>Nama:</span>
            <span>{{ $preOrder->customer->name }}</span>
        </div>
        <div class="row">
            <span>Telp:</span>
            <span>{{ $preOrder->customer->phone }}</span>
        </div>
    </div>

    {{-- Detail Pesanan --}}
    <div class="section">
        <div class="section-title">Detail Pesanan</div>
        <div class="item-row">
            <strong>{{ $preOrder->product_name }}</strong>
            <div class="row">
                <span>{{ $preOrder->quantity }} x {{ number_format($preOrder->price_per_unit, 0, ',', '.') }}</span>
                <span>{{ number_format($preOrder->total_price, 0, ',', '.') }}</span>
            </div>
            @if($preOrder->delivery_method == 'delivery')
            <div class="row" style="font-size: 11px; margin-top: 5px;">
                <span>Ongkir:</span>
                <span>{{ number_format($preOrder->delivery_fee, 0, ',', '.') }}</span>
            </div>
            @endif
        </div>
    </div>

    {{-- Penyerahan --}}
    <div class="section">
        <div class="row">
            <span>Metode:</span>
            <strong>{{ strtoupper($preOrder->delivery_method) }}</strong>
        </div>
        <div class="row">
            <span>Tgl Ambil:</span>
            <strong>{{ \Carbon\Carbon::parse($preOrder->delivery_date)->format('d/m/Y') }}</strong>
        </div>
    </div>

    {{-- Pembayaran --}}
    <div class="total-section">
        <div class="row">
            <span>Total Bayar:</span>
            <span>Rp {{ number_format($preOrder->total_price + ($preOrder->delivery_fee ?? 0), 0, ',', '.') }}</span>
        </div>
        <div class="row">
            <span>DP Paid:</span>
            <span>Rp {{ number_format($preOrder->dp_amount, 0, ',', '.') }}</span>
        </div>
        <div class="row" style="font-weight: bold; font-size: 14px; border-top: 1px dashed #000; margin-top: 5px; padding-top: 5px;">
            <span>SISA:</span>
            <span>Rp {{ number_format($preOrder->remaining_payment, 0, ',', '.') }}</span>
        </div>
    </div>

    <div style="text-align: center;">
        <div class="status-badge">
            {{ strtoupper(str_replace('_', ' ', $preOrder->payment_status)) }}
        </div>
    </div>

    {{-- Footer --}}
    <div class="footer">
        <p>Terima Kasih Atas Pesanan Anda</p>
        <p>Struk ini adalah bukti pengambilan resmi</p>
        <p style="margin-top: 5px;">{{ date('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>