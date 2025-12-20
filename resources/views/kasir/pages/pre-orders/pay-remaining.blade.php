@extends('kasir.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-left-success">
                <div class="card-header py-3 bg-success text-white">
                    <h6 class="m-0 font-weight-bold">Proses Pelunasan: {{ $preOrder->order_number }}</h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <small>Pelanggan:</small><br>
                        <strong>{{ $preOrder->customer->name }}</strong>
                        <hr class="my-1">
                        <div class="d-flex justify-content-between">
                            <span>Sisa yang harus dibayar:</span>
                            <h4 class="font-weight-bold mb-0">Rp {{ number_format($preOrder->remaining_payment, 0, ',', '.') }}</h4>
                        </div>
                    </div>

                    <form action="{{ route('kasir.pre-orders.pay-remaining', $preOrder->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Metode Pembayaran</label>
                            <select name="payment_method" class="form-control form-control-lg" required id="method">
                                <option value="cash">💵 Tunai (Cash)</option>
                                <option value="qris">📱 QRIS</option>
                                <option value="bank_transfer">🏦 Transfer Bank</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Uang yang Diterima</label>
                            <input type="number" name="amount" id="pay_input" class="form-control form-control-lg" 
                                   value="{{ $preOrder->remaining_payment }}" 
                                   min="{{ $preOrder->remaining_payment }}" required>
                        </div>

                        <div class="card bg-light mb-3">
                            <div class="card-body py-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Kembalian:</span>
                                    <h3 class="text-success font-weight-bold mb-0" id="change_display">Rp 0</h3>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success btn-block btn-lg shadow">
                            <i class="fas fa-check-circle"></i> SELESAIKAN PESANAN
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const payInput = document.getElementById('pay_input');
    const changeDisplay = document.getElementById('change_display');
    const totalRem = {{ $preOrder->remaining_payment }};
    const methodSelect = document.getElementById('method');

    function calculateChange() {
        const val = parseInt(payInput.value) || 0;
        const change = val - totalRem;
        changeDisplay.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(change > 0 ? change : 0);
    }

    payInput.addEventListener('input', calculateChange);
    
    // Jika non-cash, otomatis samakan nominal bayar dengan sisa tagihan
    methodSelect.addEventListener('change', function() {
        if(this.value !== 'cash') {
            payInput.value = totalRem;
            payInput.readOnly = true;
        } else {
            payInput.readOnly = false;
        }
        calculateChange();
    });
</script>
@endsection