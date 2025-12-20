@extends('kasir.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-warning text-white font-weight-bold">
                    Pembayaran DP: {{ $preOrder->order_number }}
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <p class="mb-1">Pelanggan: <strong>{{ $preOrder->customer->name }}</strong></p>
                        <p class="mb-1">Total Pesanan: <strong>Rp {{ number_format($preOrder->total_price, 0, ',', '.') }}</strong></p>
                        <hr>
                        <h4 class="text-center text-primary">Minimal DP: <br>Rp {{ number_format($preOrder->dp_amount, 0, ',', '.') }}</h4>
                    </div>

                   <form action="{{ route('kasir.pre-orders.pay-dp', $preOrder->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Metode Pembayaran</label>
                            <select name="payment_method" class="form-control" required id="method">
                                <option value="cash">Tunai (Cash)</option>
                                <option value="qris">QRIS</option>
                                <option value="bank_transfer">Transfer Bank</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jumlah Bayar</label>
                            <input type="number" name="amount" class="form-control form-control-lg" 
                                   value="{{ $preOrder->dp_amount }}" min="{{ $preOrder->dp_amount }}" required id="pay_amount">
                        </div>

                        <div id="cash_calculator" class="alert alert-secondary">
                            <div class="d-flex justify-content-between">
                                <span>Kembalian:</span>
                                <strong id="change_amount">Rp 0</strong>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg">Konfirmasi Pembayaran DP</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const input = document.getElementById('pay_amount');
    const changeText = document.getElementById('change_amount');
    const minDp = {{ $preOrder->dp_amount }};

    input.addEventListener('input', function() {
        let change = this.value - minDp;
        changeText.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(change > 0 ? change : 0);
    });
</script>
@endsection