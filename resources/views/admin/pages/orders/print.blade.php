<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk #{{ $order->id }}</title>
    <style>
        @media print {
            @page { size: 58mm auto; margin: 0; }
            body { width: 58mm; margin: 0; padding: 5px; }
            .no-print { display: none; }
        }
        body { font-family: 'Courier New', Courier, monospace; font-size: 9pt; color: #000; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .line { border-top: 1px dashed #000; margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; }
    </style>
</head>
<body onload="window.print(); window.onafterprint = function(){ window.close(); }">
    <div class="text-center">
        <strong>JAMILA BAKERY</strong><br>
        Jl. Raya No. 123, Kota<br>
        Telp: 0812-XXXX-XXXX
    </div>

    <div class="line"></div>
    <div>
        No: #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}<br>
        Tgl: {{ $order->created_at->format('d/m/y H:i') }}<br>
        Ksr: {{ $order->creator->name }}
    </div>
    <div class="line"></div>

    <table>
        @foreach($order->orderItems as $item)
        <tr>
            <td colspan="2">{{ $item->product->name }}</td>
        </tr>
        <tr>
            <td>{{ $item->quantity }} x {{ number_format($item->price, 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <div class="line"></div>
    <table>
        <tr>
            <td>TOTAL</td>
            <td class="text-right">{{ number_format($order->total_price, 0, ',', '.') }}</td>
        </tr>
        @if($order->payment)
        <tr>
            <td>BAYAR</td>
            <td class="text-right">{{ number_format($order->payment->amount, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>KEMBALI</td>
            <td class="text-right">{{ number_format($order->payment->change, 0, ',', '.') }}</td>
        </tr>
        @endif
    </table>

    <div class="line"></div>
    <div class="text-center">
        Terima Kasih<br>Selamat Menikmati!
    </div>
</body>
</html>