<!DOCTYPE html>
<html>
<head>
    <title>Pre-Order {{ $preOrder->order_number }}</title>
    <style>
        /* Reset & Base Styling */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Courier New', monospace; 
            width: 80mm; 
            margin: 0 auto; 
            padding: 5px; 
            color: #000;
        }
        
        /* Typography */
        h2 { font-size: 18px; text-transform: uppercase; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .bold { font-weight: bold; }
        
        /* Layout Sections */
        .header { 
            text-align: center; 
            margin-bottom: 10px; 
            border-bottom: 2px dashed #000; 
            padding-bottom: 10px; 
        }
        .header p { font-size: 12px; line-height: 1.4; }

        .section { margin: 10px 0; font-size: 12px; }
        .section-title { 
            font-weight: bold; 
            border-bottom: 1px solid #000; 
            margin-bottom: 5px; 
            padding-bottom: 2px;
            text-transform: uppercase;
        }

        .row { display: flex; justify-content: space-between; margin: 3px 0; }
        .item-row { border-bottom: 1px dashed #000; padding: 5px 0; }
        
        .total-section { 
            margin-top: 10px; 
            padding-top: 5px; 
            border-top: 2px solid #000; 
        }
        
        .status-badge {
            display: inline-block;
            border: 1px solid #000;
            padding: 2px 5px;
            margin-top: 5px;
            font-weight: bold;
        }

        .footer { 
            text-align: center; 
            margin-top: 20px; 
            padding-top: 10px; 
            border-top: 2px dashed #000; 
            font-size: 11px; 
        }

        /* Printing Controls */
        @media print {
            body { width: 80mm; }
            .no-print { display: none; }
        }
        
        .btn-print {
            background: #333;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    {{-- Tombol Print (Sembunyi saat diprint) --}}
    <div class="no-print" style="text-align: center; margin-bottom: 20px;">
        <button onclick="window.print()" class="btn-print">CETAK STRUK</button>
        <a href="{{ route('admin.pre-orders.show', $preOrder) }}" class="btn-print" style="background: #777;">KEMBALI</a>
    </div>

    {{-- Header Toko --}}
    <div class="header">
        <h2>JAMILA BAKERY</h2>
        <p>Jl. Raya Pakisan, Bondowoso<br>
        Telp/WA: 0822-3798-2432</p>
    </div>

    {{-- Order Info --}}
    <div class="section">
        <div class="row">
            <span>No. Order:</span>
            <strong>{{ $preOrder->order_number }}</strong>
        </div>
        <div class="row">
            <span>Tgl Order:</span>
            <span>{{ \Carbon\Carbon::parse($preOrder->order_date)->format('d/m/y H:i') }}</span>
        </div>
        <div class="row">
            <span>Ambil/Kirim:</span>
            <strong style="text-decoration: underline;">{{ \Carbon\Carbon::parse($preOrder->delivery_date)->format('d/m/y') }}</strong>
        </div>
        <div class="row">
            <span>Metode:</span>
            <span>{{ strtoupper($preOrder->delivery_method) }}</span>
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
            <div class="bold">{{ $preOrder->product_name }}</div>
            <div class="row">
                <span>{{ $preOrder->quantity }} x {{ number_format($preOrder->price_per_unit, 0, ',', '.') }}</span>
                <span>{{ number_format($preOrder->total_price, 0, ',', '.') }}</span>
            </div>
            
            {{-- Spesifikasi (Disederhanakan) --}}
            @if($preOrder->specifications && count(array_filter($preOrder->specifications)) > 0)
            <div style="font-size: 11px; margin-top: 5px; border-left: 2px solid #000; padding-left: 5px;">
                @foreach($preOrder->specifications as $key => $value)
                    @if($value)
                        <div>- {{ ucfirst(str_replace('_', ' ', $key)) }}: {{ $value }}</div>
                    @endif
                @endforeach
            </div>
            @endif

            @if($preOrder->design_notes)
            <div style="font-size: 11px; margin-top: 3px; font-style: italic;">
                Ket: {{ $preOrder->design_notes }}
            </div>
            @endif
        </div>
    </div>

    {{-- Alamat Pengiriman (Jika ada) --}}
    @if($preOrder->delivery_method == 'delivery')
    <div class="section">
        <div class="section-title">Alamat Kirim</div>
        <div style="font-size: 11px;">{{ $preOrder->delivery_address }}</div>
        @if($preOrder->delivery_fee > 0)
        <div class="row">
            <span>Ongkir:</span>
            <span>{{ number_format($preOrder->delivery_fee, 0, ',', '.') }}</span>
        </div>
        @endif
    </div>
    @endif

    {{-- Pembayaran --}}
    <div class="total-section">
        <div class="row">
            <span>Total:</span>
            <span>Rp {{ number_format($preOrder->total_price + ($preOrder->delivery_fee ?? 0), 0, ',', '.') }}</span>
        </div>
        <div class="row">
            <span>DP ({{ $preOrder->dp_percentage }}%):</span>
            <span>Rp {{ number_format($preOrder->dp_amount, 0, ',', '.') }}</span>
        </div>
        <div class="row bold">
            <span>SISA TAGIHAN:</span>
            <span>Rp {{ number_format($preOrder->remaining_payment, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="text-center">
        <div class="status-badge">
            STATUS: {{ strtoupper(str_replace('_', ' ', $preOrder->payment_status)) }}
        </div>
    </div>

    {{-- Footer --}}
    <div class="footer">
        <p>Terima Kasih Atas Kepercayaan Anda</p>
        <p>Harap tunjukkan struk ini saat pengambilan</p>
        <p style="margin-top: 5px;">*** {{ date('d/m/Y H:i') }} ***</p>
    </div>

    {{-- Auto Print Script --}}
    <script>
        window.onload = function() {
            // Uncomment line di bawah jika ingin langsung muncul dialog print saat halaman dibuka
            // window.print();
        }
    </script>
</body>
</html>