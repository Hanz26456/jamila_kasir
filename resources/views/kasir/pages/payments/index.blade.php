@extends('kasir.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800 text-info font-weight-bold">Antrean Pembayaran</h1>

    <div class="row">
        @foreach($orders as $order)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }} - {{ $order->customer->name }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-info btn-sm shadow-sm" data-toggle="modal" data-target="#modalBayar{{ $order->id }}">
                                <i class="fas fa-money-bill-wave"></i> Bayar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalBayar{{ $order->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('kasir.orders.bayar', $order->id) }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title">Proses Pembayaran #{{ $order->id }}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="text-center mb-4">
                                <small class="text-muted text-uppercase">Total Tagihan</small>
                                <h2 class="text-info font-weight-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h2>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Metode Pembayaran</label>
                                <select name="payment_method" class="form-control select-method" data-id="{{ $order->id }}" required>
                                    <option value="cash">Tunai (Cash)</option>
                                    <option value="qris">QRIS</option>
                                    <option value="bank_transfer">Transfer Bank</option>
                                </select>
                            </div>

                            <div id="section-tunai-{{ $order->id }}">
                                <div class="form-group">
                                    <label class="font-weight-bold text-success">Uang Tunai Pelanggan</label>
                                    <input type="number" name="bayar" class="form-control form-control-lg input-bayar" 
                                           data-total="{{ $order->total_price }}" placeholder="Masukkan nominal...">
                                </div>
                                <div class="alert alert-secondary border-0 bg-light">
                                    <strong class="text-dark">Kembalian: </strong> 
                                    <span class="text-kembalian font-weight-bold text-info">Rp 0</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-info btn-sm px-4 shadow-sm">SIMPAN & LUNAS</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script>
    // Logika Toggle Input Berdasarkan Metode Pembayaran
    $(document).on('change', '.select-method', function() {
        let method = $(this).val();
        let orderId = $(this).data('id');
        let modal = $(this).closest('.modal-content');
        let tunaiSection = $('#section-tunai-' + orderId);
        let inputBayar = tunaiSection.find('.input-bayar');
        let btnSimpan = modal.find('button[type="submit"]');

        if (method === 'cash') {
            tunaiSection.slideDown();
            inputBayar.prop('required', true);
            // Cek ulang saat pindah ke cash
            checkCashAmount(inputBayar, btnSimpan);
        } else {
            tunaiSection.slideUp();
            inputBayar.prop('required', false).val('');
            btnSimpan.prop('disabled', false); // QRIS/Bank Transfer selalu bisa bayar
        }
    });

    // Logika Hitung Kembalian & Validasi Tombol
    $(document).on('input', '.input-bayar', function() {
        let modal = $(this).closest('.modal-content');
        let btnSimpan = modal.find('button[type="submit"]');
        checkCashAmount($(this), btnSimpan);
    });

    // Fungsi pembantu untuk validasi uang
    function checkCashAmount(input, button) {
        let bayar = parseFloat(input.val()) || 0;
        let total = parseFloat(input.data('total'));
        let kembalian = bayar - total;
        
        // Update teks kembalian
        let display = kembalian > 0 ? new Intl.NumberFormat('id-ID').format(kembalian) : 0;
        input.closest('.modal-body').find('.text-kembalian').text('Rp ' + display);

        // Validasi tombol: Jika kurang dari total, disable tombol
        if (bayar < total) {
            button.prop('disabled', true);
            button.text('Uang Kurang');
            button.addClass('btn-secondary').removeClass('btn-info');
        } else {
            button.prop('disabled', false);
            button.text('SIMPAN & LUNAS');
            button.addClass('btn-info').removeClass('btn-secondary');
        }
    }
</script>
@endpush
@endsection