<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</title>
    <style>
        /* Pengaturan Kertas Thermal */
        @media print {
            @page { 
                size: 58mm auto; /* Gunakan 80mm jika printer Anda ukuran besar */
                margin: 0; 
            }
            body { 
                width: 58mm; 
                margin: 0; 
                padding: 5mm; 
            }
            .no-print { display: none; }
        }

        body {
            font-family: 'Courier New', Courier, monospace; /* Font khas struk belanja */
            font-size: 10pt;
            line-height: 1.2;
            color: #000;
            background-color: #fff;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        
        .line {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .item-name {
            display: block;
            margin-bottom: 2px;
        }

        .footer {
            margin-top: 15px;
            font-size: 9pt;
        }
    </style>
</head>
<body onload="window.print(); window.onafterprint = function(){ window.close(); }">

    <div class="text-center">
        <span class="font-bold" style="font-size: 12pt;">JAMILA BAKERY</span><br>
        Jl. Raya Toko No. 123<br>
        Bondowoso<br>
        Telp: 0812-xxxx-xxxx
    </div>

    <div class="line"></div>

    <table>
        <tr>
            <td>Nota : #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
        </tr>
        <tr>
            <td>Tgl  : {{ $order->created_at->format('d/m/y H:i') }}</td>
        </tr>
        <tr>
            <td>Ksr  : {{ $order->creator->name }}</td>
        </tr>
        <tr>
            <td>Plg  : {{ $order->customer->name }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <table>
        @foreach($order->orderItems as $item)
        <tr>
            <td colspan="2"><span class="item-name">{{ $item->product->name }}</span></td>
        </tr>
        <tr>
            <td>{{ $item->quantity }} x {{ number_format($item->price, 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <div class="line"></div>

    <table>
        @php
            $subtotalKotor = $order->orderItems->sum('subtotal');
            $discount = $subtotalKotor - $order->total_price;
        @endphp

        <tr>
            <td>Subtotal</td>
            <td class="text-right">{{ number_format($subtotalKotor, 0, ',', '.') }}</td>
        </tr>

        @if($discount > 0)
        <tr>
            <td>Diskon</td>
            <td class="text-right">-{{ number_format($discount, 0, ',', '.') }}</td>
        </tr>
        @endif

        <tr>
            <td class="font-bold">TOTAL</td>
            <td class="text-right font-bold">{{ number_format($order->total_price, 0, ',', '.') }}</td>
        </tr>

        @if($order->payment)
        <tr>
            <td>Bayar ({{ strtoupper($order->payment->payment_method) }})</td>
            <td class="text-right">{{ number_format($order->payment->amount, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="font-bold">KEMBALI</td>
            <td class="text-right font-bold">{{ number_format($order->payment->change, 0, ',', '.') }}</td>
        </tr>
        @endif
    </table>

    <div class="line"></div>

    <div class="text-center footer">
        Terima Kasih Atas Kunjungan Anda<br>
        Barang yang sudah dibeli<br>
        tidak dapat ditukar/dikembalikan
    </div>

    <div class="no-print text-center" style="margin-top: 20px;">
        <button onclick="window.print()" style="padding: 10px;">Cetak Ulang</button>
        <button onclick="window.close()" style="padding: 10px;">Tutup Halaman</button>
    </div>

</body>
</html>