@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Proses Pembayaran</h1>
        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm"></i> Kembali ke Order
        </a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger shadow border-left-danger">
            <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">Ringkasan Tagihan #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <small class="text-uppercase font-weight-bold text-muted small">Total yang Harus Dibayar</small>
                        <h2 class="display-4 font-weight-bold text-primary mt-2">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </h2>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-6 text-muted">Pelanggan:</div>
                        <div class="col-6 text-right font-weight-bold">{{ $order->customer->name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-muted">Tanggal Pesan:</div>
                        <div class="col-6 text-right font-weight-bold">{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-muted">Status Saat Ini:</div>
                        <div class="col-6 text-right">
                            <span class="badge badge-warning text-uppercase">{{ $order->status }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card shadow mb-4 border-bottom-success">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-success">Input Transaksi Pembayaran</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.payments.store', $order->id) }}" method="POST" id="formPembayaran">
                        @csrf
                        
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark">Metode Pembayaran</label>
                            <select name="payment_method" id="payment_method" class="form-control form-control-lg select-custom @error('payment_method') is-invalid @enderror" required>
                                <option value="cash">Tunai (Cash)</option>
                                <option value="qris">QRIS</option>
                                <option value="bank_transfer">Transfer Bank</option>
                            </select>
                            @error('payment_method') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div id="section_cash">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-dark">Jumlah Uang Diterima (Rp)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light font-weight-bold">Rp</span>
                                    </div>
                                    <input type="number" name="amount" id="input_bayar" 
                                           class="form-control form-control-lg font-weight-bold @error('amount') is-invalid @enderror" 
                                           value="{{ old('amount', (int)$order->total_price) }}" 
                                           data-total="{{ (int)$order->total_price }}"
                                           placeholder="0" required>
                                </div>
                                @error('amount') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            <div id="kembalian_box" class="alert alert-secondary border-0 mb-4" style="background-color: #f8f9fc;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="font-weight-bold text-muted">Kembalian:</span>
                                    <h4 class="mb-0 font-weight-bold text-success" id="text_kembalian">Rp 0</h4>
                                </div>
                            </div>
                        </div>

                        <hr>
                        
                        <button type="submit" id="btn_konfirmasi" class="btn btn-success btn-block btn-lg shadow py-3 font-weight-bold">
                            <i class="fas fa-check-double mr-2"></i> KONFIRMASI PEMBAYARAN
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputBayar = document.getElementById('input_bayar');
        const paymentMethod = document.getElementById('payment_method');
        const btnKonfirmasi = document.getElementById('btn_konfirmasi');
        const textKembalian = document.getElementById('text_kembalian');
        const totalTagihan = parseInt(inputBayar.getAttribute('data-total'));
        const sectionCash = document.getElementById('section_cash');

        // Fungsi Validasi Utama
        function validasiPembayaran() {
            const method = paymentMethod.value;
            const nominalBayar = parseFloat(inputBayar.value) || 0;

            if (method === 'cash') {
                // Hitung Kembalian
                const kembalian = nominalBayar - totalTagihan;
                
                if (nominalBayar < totalTagihan) {
                    // Jika Uang Kurang
                    btnKonfirmasi.disabled = true;
                    btnKonfirmasi.innerHTML = '<i class="fas fa-times-circle mr-2"></i> UANG KURANG';
                    btnKonfirmasi.classList.replace('btn-success', 'btn-danger');
                    textKembalian.innerText = 'Rp 0';
                    textKembalian.classList.replace('text-success', 'text-danger');
                } else {
                    // Jika Uang Cukup/Lebih
                    btnKonfirmasi.disabled = false;
                    btnKonfirmasi.innerHTML = '<i class="fas fa-check-double mr-2"></i> KONFIRMASI PEMBAYARAN';
                    btnKonfirmasi.classList.replace('btn-danger', 'btn-success');
                    textKembalian.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(kembalian);
                    textKembalian.classList.replace('text-danger', 'text-success');
                }
            } else {
                // Jika QRIS atau Bank Transfer, asumsikan nominal pas
                btnKonfirmasi.disabled = false;
                btnKonfirmasi.classList.replace('btn-danger', 'btn-success');
                btnKonfirmasi.innerHTML = '<i class="fas fa-check-double mr-2"></i> KONFIRMASI PEMBAYARAN';
            }
        }

        // Event Listener untuk Input Bayar
        inputBayar.addEventListener('input', validasiPembayaran);

        // Event Listener untuk Ganti Metode
        paymentMethod.addEventListener('change', function() {
            if (this.value !== 'cash') {
                inputBayar.value = totalTagihan; // Otomatis set pas untuk non-tunai
                // sectionCash.style.opacity = '0.5'; // Opsional: visual cue
            } else {
                // sectionCash.style.opacity = '1';
            }
            validasiPembayaran();
        });

        // Jalankan validasi sekali saat halaman dimuat
        validasiPembayaran();
    });
</script>
@endpush

<style>
    .select-custom {
        height: calc(1.5em + 1rem + 2px) !important;
        font-size: 1.1rem;
    }
    .input-group-text {
        border-radius: 0.35rem 0 0 0.35rem;
    }
    #input_bayar {
        border-radius: 0 0.35rem 0.35rem 0;
    }
</style>
@endsection