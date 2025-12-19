@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Proses Pembayaran</h1>
        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm"></i> Batal
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
                    <h6 class="m-0 font-weight-bold">Ringkasan Pesanan #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h6>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-3">Item yang Dibeli:</h6>
                        @foreach($order->orderItems as $item)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div style="line-height: 1.2;">
                                <span class="text-dark font-weight-bold small">{{ $item->product->name }}</span><br>
                                <small class="text-muted">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</small>
                            </div>
                            <div class="text-dark font-weight-bold small">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <hr>

                    <div class="row mb-2">
                        <div class="col-6 text-muted">Pelanggan:</div>
                        <div class="col-6 text-right font-weight-bold">{{ $order->customer->name }}</div>
                    </div>
                    
                    @php 
                        $rawSubtotal = $order->orderItems->sum('subtotal');
                        $discount = $rawSubtotal - $order->total_price;
                    @endphp

                    @if($discount > 0)
                    <div class="row mb-2">
                        <div class="col-6 text-muted">Diskon/Voucher:</div>
                        <div class="col-6 text-right font-weight-bold text-danger">- Rp {{ number_format($discount, 0, ',', '.') }}</div>
                    </div>
                    @endif

                    <div class="text-center bg-light p-3 rounded mt-3">
                        <small class="text-uppercase font-weight-bold text-muted small">Total Tagihan</small>
                        <h2 class="font-weight-bold text-primary mb-0">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card shadow mb-4 border-bottom-success">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-success">Input Pembayaran</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.payments.store', $order->id) }}" method="POST" id="formPembayaran">
                        @csrf
                        
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark small text-uppercase">Metode Pembayaran</label>
                            <select name="payment_method" id="payment_method" class="form-control form-control-lg select-custom" required>
                                <option value="cash" selected>Tunai (Cash)</option>
                                <option value="qris">QRIS</option>
                                <option value="bank_transfer">Transfer Bank</option>
                            </select>
                        </div>

                        <div id="section_cash">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-dark small text-uppercase">Uang Diterima (Rp)</label>
                                <div class="input-group input-group-lg">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white font-weight-bold">Rp</span>
                                    </div>
                                    <input type="number" name="amount" id="input_bayar" 
                                           class="form-control form-control-lg font-weight-bold @error('amount') is-invalid @enderror" 
                                           value="{{ (int)$order->total_price }}" 
                                           data-total="{{ (int)$order->total_price }}"
                                           required>
                                </div>
                                @error('amount') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="small text-muted font-weight-bold">Nominal Cepat:</label>
                                <div class="d-flex flex-wrap" style="gap: 8px;">
                                    <button type="button" class="btn btn-outline-secondary btn-sm btn-quick" data-amount="{{ (int)$order->total_price }}">Uang Pas</button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm btn-quick" data-amount="20000">20.000</button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm btn-quick" data-amount="50000">50.000</button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm btn-quick" data-amount="100000">100.000</button>
                                </div>
                            </div>

                            <div id="kembalian_box" class="p-4 border-0 mb-4 rounded shadow-sm" style="background-color: #f0fff4;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="font-weight-bold text-dark h6 mb-0">KEMBALIAN:</span>
                                    <h3 class="mb-0 font-weight-bold text-success" id="text_kembalian">Rp 0</h3>
                                </div>
                            </div>
                        </div>

                        <hr>
                        
                        <button type="submit" id="btn_konfirmasi" class="btn btn-success btn-block btn-lg shadow py-3 font-weight-bold">
                            <i class="fas fa-check-circle mr-2"></i> SELESAIKAN PEMBAYARAN
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
        const btnQuicks = document.querySelectorAll('.btn-quick');

        function formatRupiah(number) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(number);
        }

        function validasiPembayaran() {
            const nominalBayar = parseFloat(inputBayar.value) || 0;
            const kembalian = nominalBayar - totalTagihan;

            if (paymentMethod.value === 'cash') {
                if (nominalBayar < totalTagihan) {
                    btnKonfirmasi.disabled = true;
                    btnKonfirmasi.innerHTML = '<i class="fas fa-times-circle mr-2"></i> NOMINAL KURANG';
                    btnKonfirmasi.className = 'btn btn-danger btn-block btn-lg shadow py-3 font-weight-bold';
                    textKembalian.innerText = 'Rp 0';
                    textKembalian.className = 'mb-0 font-weight-bold text-danger';
                } else {
                    btnKonfirmasi.disabled = false;
                    btnKonfirmasi.innerHTML = '<i class="fas fa-check-circle mr-2"></i> SELESAIKAN PEMBAYARAN';
                    btnKonfirmasi.className = 'btn btn-success btn-block btn-lg shadow py-3 font-weight-bold';
                    textKembalian.innerText = formatRupiah(kembalian);
                    textKembalian.className = 'mb-0 font-weight-bold text-success';
                }
            } else {
                // Non-tunai
                btnKonfirmasi.disabled = false;
                btnKonfirmasi.className = 'btn btn-success btn-block btn-lg shadow py-3 font-weight-bold';
                btnKonfirmasi.innerHTML = '<i class="fas fa-check-circle mr-2"></i> SELESAIKAN PEMBAYARAN';
            }
        }

        // Event Nominal Cepat
        btnQuicks.forEach(btn => {
            btn.addEventListener('click', function() {
                inputBayar.value = this.getAttribute('data-amount');
                validasiPembayaran();
            });
        });

        inputBayar.addEventListener('input', validasiPembayaran);

        paymentMethod.addEventListener('change', function() {
            if (this.value !== 'cash') {
                inputBayar.value = totalTagihan;
                document.getElementById('section_cash').style.opacity = '0.6';
                document.getElementById('input_bayar').readOnly = true;
            } else {
                document.getElementById('section_cash').style.opacity = '1';
                document.getElementById('input_bayar').readOnly = false;
            }
            validasiPembayaran();
        });

        validasiPembayaran();
    });
</script>
@endpush

<style>
    .select-custom {
        height: auto !important;
        padding: 12px !important;
        font-size: 1.1rem;
    }
    .input-group-text {
        border-right: none;
    }
    #input_bayar {
        border-left: none;
        font-size: 1.5rem;
        height: auto;
    }
    .btn-quick {
        border-radius: 20px;
        padding: 5px 15px;
        transition: all 0.2s;
    }
    .btn-quick:hover {
        background-color: #4e73df;
        color: white;
    }
</style>
@endsection