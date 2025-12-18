@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Proses Pembayaran</h1>
        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm"></i> Kembali ke Order
        </a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger shadow">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">Ringkasan Tagihan #{{ $order->id }}</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <small class="text-uppercase font-weight-bold text-muted">Total Tagihan</small>
                        <h2 class="display-4 font-weight-bold text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h2>
                    </div>
                    <hr>
                    <div class="row small mb-2">
                        <div class="col-6 text-muted">Pelanggan:</div>
                        <div class="col-6 text-right font-weight-bold">{{ $order->customer->name }}</div>
                    </div>
                    <div class="row small mb-2">
                        <div class="col-6 text-muted">Tanggal Pesan:</div>
                        <div class="col-6 text-right font-weight-bold">{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card shadow mb-4 border-bottom-success">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Input Transaksi</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.payments.store', $order->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="font-weight-bold">Metode Pembayaran</label>
                            <select name="payment_method" class="form-control form-control-lg @error('payment_method') is-invalid @enderror" required>
                                <option value="cash">Tunai (Cash)</option>
                                <option value="qris">QRIS</option>
                                <option value="bank_transfer">Transfer Bank</option>
                            </select>
                            @error('payment_method') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Jumlah Uang Diterima (Rp)</label>
                            <input type="number" name="amount" id="input_bayar" 
                                   class="form-control form-control-lg @error('amount') is-invalid @enderror" 
                                   value="{{ old('amount', (int)$order->total_price) }}" 
                                   min="{{ (int)$order->total_price }}" required>
                            <small class="text-muted">Pastikan nominal lebih besar atau sama dengan total tagihan.</small>
                            @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div id="kembalian_box" class="alert alert-warning d-none">
                            <h5 class="mb-0">Kembalian: <strong id="text_kembalian">Rp 0</strong></h5>
                        </div>

                        <hr>
                        <button type="submit" class="btn btn-success btn-block btn-lg shadow">
                            <i class="fas fa-check-double"></i> KONFIRMASI PEMBAYARAN
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const inputBayar = document.getElementById('input_bayar');
    const totalTagihan = {{ (int)$order->total_price }};
    const boxKembalian = document.getElementById('kembalian_box');
    const textKembalian = document.getElementById('text_kembalian');

    inputBayar.addEventListener('input', function() {
        const nominalBayar = parseFloat(this.value) || 0;
        if (nominalBayar > totalTagihan) {
            const hitung = nominalBayar - totalTagihan;
            textKembalian.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(hitung);
            boxKembalian.classList.remove('d-none');
        } else {
            boxKembalian.classList.add('d-none');
        }
    });
</script>
@endsection