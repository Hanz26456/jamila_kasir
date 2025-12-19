@extends('kasir.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800 text-info font-weight-bold">Antrean Pembayaran</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow border-left-success" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

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
                            <button class="btn btn-info btn-sm shadow-sm font-weight-bold" data-toggle="modal" data-target="#modalBayar{{ $order->id }}">
                                <i class="fas fa-money-bill-wave mr-1"></i> BAYAR
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalBayar{{ $order->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <form action="{{ route('kasir.orders.bayar', $order->id) }}" method="POST">
                    @csrf
                    <div class="modal-content text-dark">
                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title font-weight-bold">Kasir: Pembayaran #{{ $order->id }}</h5>
                            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <h6 class="font-weight-bold text-dark border-bottom pb-2 small">RINCIAN PESANAN:</h6>
                                @foreach($order->orderItems as $item)
                                <div class="d-flex align-items-center mb-2 border-bottom pb-2">
                                    <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://ui-avatars.com/api/?name='.urlencode($item->product->name) }}" 
                                         class="rounded shadow-sm mr-3" style="width: 45px; height: 45px; object-fit: cover; border: 1px solid #ddd;">
                                    <div class="flex-grow-1">
                                        <div class="small font-weight-bold text-dark">{{ $item->product->name }}</div>
                                        <small class="text-muted">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</small>
                                    </div>
                                    <div class="text-right small font-weight-bold text-dark">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="text-center mb-4 bg-light py-3 rounded border">
                                <small class="text-muted text-uppercase font-weight-bold small">Total Harus Dibayar</small>
                                <h2 class="text-info font-weight-bold mb-0">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h2>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold small text-uppercase text-dark">Metode Pembayaran</label>
                                <select name="payment_method" class="form-control select-method font-weight-bold" data-id="{{ $order->id }}" required>
                                    <option value="cash" selected>Tunai (Cash)</option>
                                    <option value="qris">QRIS</option>
                                    <option value="bank_transfer">Transfer Bank</option>
                                </select>
                            </div>

                            <div id="section-tunai-{{ $order->id }}">
                                <div class="form-group mb-2">
                                    <label class="font-weight-bold text-success small text-uppercase">Uang Tunai Diterima</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-success text-white font-weight-bold">Rp</span>
                                        </div>
                                        <input type="number" name="bayar" class="form-control form-control-lg input-bayar font-weight-bold text-primary" 
                                               data-total="{{ $order->total_price }}" placeholder="0">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex flex-wrap" style="gap: 5px;">
                                        <button type="button" class="btn btn-outline-primary btn-sm btn-shortcut" data-value="{{ (int)$order->total_price }}">Uang Pas</button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm btn-shortcut" data-value="20000">20rb</button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm btn-shortcut" data-value="50000">50rb</button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm btn-shortcut" data-value="100000">100rb</button>
                                    </div>
                                </div>

                                <div class="p-3 rounded shadow-sm border bg-white">
                                    <small class="text-dark font-weight-bold text-uppercase small">Kembalian:</small> 
                                    <h3 class="text-kembalian font-weight-bold text-info mb-0">Rp 0</h3>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary btn-sm px-3" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-info btn-block btn-lg shadow font-weight-bold btn-submit-bayar">
                                SELESAIKAN PEMBAYARAN
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Fungsi Format Rupiah
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(angka);
        }

        // 1. LOGIKA SHORTCUT TOMBOL NOMINAL
        $(document).on('click', '.btn-shortcut', function() {
            let nominal = $(this).data('value');
            let modal = $(this).closest('.modal-content');
            let inputBayar = modal.find('.input-bayar');

            inputBayar.val(nominal); // Isi nominal
            inputBayar.trigger('input'); // Pemicu kalkulasi kembalian
        });

        // 2. REAL-TIME VALIDASI & HITUNG KEMBALIAN
        $(document).on('input', '.input-bayar', function() {
            let modal = $(this).closest('.modal-content');
            let totalTagihan = parseFloat($(this).data('total')) || 0;
            let nominalBayar = parseFloat($(this).val()) || 0;
            
            let displayKembalian = modal.find('.text-kembalian');
            let btnSelesaikan = modal.find('.btn-submit-bayar');
            
            let selisih = nominalBayar - totalTagihan;

            if (nominalBayar < totalTagihan) {
                // KONDISI: UANG KURANG
                displayKembalian.text('Rp 0').addClass('text-danger').removeClass('text-info');
                btnSelesaikan.prop('disabled', true).text('UANG KURANG').addClass('btn-danger').removeClass('btn-info');
            } else {
                // KONDISI: UANG CUKUP/LEBIH
                displayKembalian.text(formatRupiah(selisih)).addClass('text-info').removeClass('text-danger');
                btnSelesaikan.prop('disabled', false).text('SELESAIKAN PEMBAYARAN').addClass('btn-info').removeClass('btn-danger');
            }
        });

        // 3. TOGGLE SECTION TUNAI (QRIS/Transfer Sembunyikan Input Tunai)
        $(document).on('change', '.select-method', function() {
            let orderId = $(this).data('id');
            let method = $(this).val();
            let modal = $(this).closest('.modal-content');
            let tunaiBox = $('#section-tunai-' + orderId);
            let btnSelesaikan = modal.find('.btn-submit-bayar');

            if (method !== 'cash') {
                tunaiBox.slideUp(); // Sembunyikan section tunai
                btnSelesaikan.prop('disabled', false).text('SELESAIKAN PEMBAYARAN').addClass('btn-info').removeClass('btn-danger');
            } else {
                tunaiBox.slideDown(); // Munculkan kembali
                modal.find('.input-bayar').trigger('input'); // Validasi ulang cash
            }
        });
    });
</script>
@endpush