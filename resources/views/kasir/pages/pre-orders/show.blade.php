@extends('kasir.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pre-Order: {{ $preOrder->order_number }}</h1>
        <div>
            <a href="{{ route('kasir.pre-orders.index') }}" class="btn btn-secondary btn-sm shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
            </a>
            <a href="{{ route('kasir.pre-orders.print', $preOrder->id) }}" class="btn btn-primary btn-sm shadow-sm">
                <i class="fas fa-print fa-sm text-white-50"></i> Cetak Struk
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pesanan</h6>
                    <span class="badge badge-{{ $preOrder->status == 'ready' ? 'success' : 'primary' }}">
                        STATUS: {{ strtoupper($preOrder->status) }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>{{ $preOrder->product_name }}</h5>
                            <p class="text-muted">{{ $preOrder->description }}</p>
                            
                            <table class="table table-sm table-borderless mt-3">
                                <tr><td>Quantity</td><td>: <strong>{{ $preOrder->quantity }} pcs</strong></td></tr>
                                <tr><td>Metode</td><td>: <span class="badge badge-info">{{ strtoupper($preOrder->delivery_method) }}</span></td></tr>
                                <tr><td>Tgl Kirim/Ambil</td><td>: <strong>{{ \Carbon\Carbon::parse($preOrder->delivery_date)->format('d M Y') }}</strong></td></tr>
                            </table>
                        </div>
                        <div class="col-md-6 border-left">
                            <h6 class="font-weight-bold">Catatan Desain:</h6>
                            <p class="small">{{ $preOrder->design_notes ?? '-' }}</p>
                            
                            @if($preOrder->reference_image)
                                <h6 class="font-weight-bold">Referensi Gambar:</h6>
                                <img src="{{ asset('storage/' . $preOrder->reference_image) }}" 
                                     class="img-fluid rounded border shadow-sm" style="max-height: 200px">
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Histori Perjalanan Pesanan</h6>
                </div>
                <div class="card-body">
                    <div class="timeline-small">
                        @foreach($preOrder->statusHistories as $history)
                        <div class="mb-3 border-left-primary pl-3">
                            <div class="small text-muted">{{ $history->changed_at->format('d/m/Y H:i') }}</div>
                            <div class="font-weight-bold">Status: {{ strtoupper($history->new_status) }}</div>
                            <div class="small italic text-gray-600">"{{ $history->notes }}"</div>
                            <div class="small text-primary">Oleh: {{ $history->changer->name }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-light">
                    <h6 class="m-0 font-weight-bold text-dark">Data Pelanggan</h6>
                </div>
                <div class="card-body">
                    <h5 class="font-weight-bold text-primary">{{ $preOrder->customer->name }}</h5>
                    <p class="mb-1"><i class="fab fa-whatsapp"></i> {{ $preOrder->customer->phone }}</p>
                    @if($preOrder->delivery_method == 'delivery')
                        <hr>
                        <h6 class="font-weight-bold">Alamat Kirim:</h6>
                        <p class="small">{{ $preOrder->delivery_address }}</p>
                    @endif
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3 {{ $preOrder->payment_status == 'paid' ? 'bg-success' : 'bg-danger' }} text-white">
                    <h6 class="m-0 font-weight-bold">Ringkasan Pembayaran</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total Harga</span>
                        <strong>Rp {{ number_format($preOrder->total_price, 0, ',', '.') }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2 text-success">
                        <span>DP Paid</span>
                        <strong>- Rp {{ number_format($preOrder->dp_amount, 0, ',', '.') }}</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="h5">SISA</span>
                        <span class="h5 font-weight-bold text-danger">Rp {{ number_format($preOrder->remaining_payment, 0, ',', '.') }}</span>
                    </div>

                    @if($preOrder->payment_status == 'unpaid')
                        <a href="{{ route('kasir.pre-orders.pay-dp', $preOrder->id) }}" class="btn btn-warning btn-block">BAYAR DP SEKARANG</a>
                    @elseif($preOrder->payment_status == 'dp_paid')
                        <a href="{{ route('kasir.pre-orders.pay-remaining', $preOrder->id) }}" class="btn btn-success btn-block">PROSES PELUNASAN</a>
                    @else
                        <div class="alert alert-success text-center font-weight-bold">LUNAS</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection