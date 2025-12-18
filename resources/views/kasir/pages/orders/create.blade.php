@extends('kasir.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold text-info">Input Pesanan Kasir</h1>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle mr-2"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <form action="{{ route('kasir.orders.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4 border-left-info">
                    <div class="card-header py-3 bg-light">
                        <h6 class="m-0 font-weight-bold text-info">Informasi Transaksi</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Pelanggan</label>
                            <select name="customer_id" class="form-control select2" required>
                                <option value="">-- Pilih Pelanggan --</option>
                                @foreach($customers as $c)
                                    <option value="{{ $c->id }}" {{ old('customer_id') == $c->id ? 'selected' : '' }}>
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Tanggal Pengambilan</label>
                            <input type="date" name="pickup_date" class="form-control" 
                                   value="{{ old('pickup_date', now()->format('Y-m-d')) }}" 
                                   min="{{ now()->format('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Kode Voucher</label>
                            <input type="text" name="voucher_code" class="form-control" 
                                   placeholder="Masukkan kode voucher" value="{{ old('voucher_code') }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4 border-left-info">
                    <div class="card-header py-3 bg-light d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info">Item Roti</h6>
                        <button type="button" id="addRow" class="btn btn-info btn-sm shadow-sm">
                            <i class="fas fa-plus"></i> Tambah Baris
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-dark" id="orderTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Roti</th>
                                        <th width="120">Qty</th>
                                        <th width="180">Subtotal</th>
                                        <th width="50">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="row-item">
                                        <td>
                                            <select name="items[0][product_id]" class="form-control product-select" required>
                                                <option value="" data-price="0" data-stock="0">-- Pilih Produk --</option>
                                                @foreach($products as $p)
                                                    {{-- Di sini kita tambahkan teks Stok agar Kasir bisa lihat langsung --}}
                                                    <option value="{{ $p->id }}" data-price="{{ $p->price }}" data-stock="{{ $p->stock }}">
                                                        {{ $p->name }} (Rp{{ number_format($p->price) }}) - Stok: {{ $p->stock }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted stock-info font-italic"></small>
                                        </td>
                                        <td>
                                            <input type="number" name="items[0][quantity]" class="form-control qty-input" value="1" min="1" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control subtotal-input font-weight-bold" readonly value="Rp 0">
                                        </td>
                                        <td class="text-center">-</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-light">
                                        <th colspan="2" class="text-right align-middle font-weight-bold">Estimasi Total</th>
                                        <th colspan="2">
                                            <h5 class="m-0 font-weight-bold text-info" id="grandTotalDisplay">Rp 0</h5>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-info btn-block btn-lg shadow mt-3 font-weight-bold">
                            SIMPAN PESANAN <i class="fas fa-save ml-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    let rowCount = 1;

    // Logika Tambah Baris
    $('#addRow').click(function() {
        let newRow = `
        <tr class="row-item">
            <td>
                <select name="items[${rowCount}][product_id]" class="form-control product-select" required>
                    <option value="" data-price="0" data-stock="0">-- Pilih Produk --</option>
                    @foreach($products as $p)
                        <option value="{{ $p->id }}" data-price="{{ $p->price }}" data-stock="{{ $p->stock }}">
                            {{ $p->name }} (Rp{{ number_format($p->price) }}) - Stok: {{ $p->stock }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted stock-info font-italic"></small>
            </td>
            <td><input type="number" name="items[${rowCount}][quantity]" class="form-control qty-input" value="1" min="1" required></td>
            <td><input type="text" class="form-control subtotal-input font-weight-bold" readonly value="Rp 0"></td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm removeRow"><i class="fas fa-trash"></i></button>
            </td>
        </tr>`;
        $('#orderTable tbody').append(newRow);
        rowCount++;
    });

    // Hapus Baris
    $(document).on('click', '.removeRow', function() {
        $(this).closest('tr').remove();
        calculateGrandTotal();
    });

    // Perubahan Produk
    $(document).on('change', '.product-select', function() {
        let row = $(this).closest('tr');
        let option = $(this).find('option:selected');
        let stock = parseInt(option.data('stock')) || 0;
        
        // Tampilkan info stok di bawah dropdown
        row.find('.stock-info').text('Tersedia: ' + stock + ' pcs');
        
        // Batasi input qty maksimal sesuai stok
        let qtyInput = row.find('.qty-input');
        qtyInput.attr('max', stock);

        // Jika qty saat ini > stok yang baru dipilih, reset ke stok maksimal
        if (parseInt(qtyInput.val()) > stock) {
            qtyInput.val(stock);
        }

        updateRowSubtotal(row);
    });

    // Validasi Qty Real-time
    $(document).on('input', '.qty-input', function() {
        let row = $(this).closest('tr');
        let stock = parseInt(row.find('.product-select option:selected').data('stock')) || 0;
        let qty = parseInt($(this).val()) || 0;

        if (qty > stock) {
            alert('Stok tidak mencukupi! Maksimal tersedia: ' + stock);
            $(this).val(stock);
        }
        
        updateRowSubtotal(row);
    });

    // Update Harga Baris
    function updateRowSubtotal(row) {
        let price = parseInt(row.find('.product-select option:selected').data('price')) || 0;
        let qty = parseInt(row.find('.qty-input').val()) || 0;
        let subtotal = price * qty;
        
        row.find('.subtotal-input').val('Rp ' + new Intl.NumberFormat('id-ID').format(subtotal));
        calculateGrandTotal();
    }

    // Hitung Total Seluruhnya
    function calculateGrandTotal() {
        let total = 0;
        $('.row-item').each(function() {
            let price = parseInt($(this).find('.product-select option:selected').data('price')) || 0;
            let qty = parseInt($(this).find('.qty-input').val()) || 0;
            total += (price * qty);
        });
        $('#grandTotalDisplay').text('Rp ' + new Intl.NumberFormat('id-ID').format(total));
    }
</script>
@endpush
@endsection