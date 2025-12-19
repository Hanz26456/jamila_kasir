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
                                <thead class="bg-light text-center">
                                    <tr>
                                        <th>Roti</th>
                                        <th width="80">Foto</th>
                                        <th width="100">Qty</th>
                                        <th width="150">Subtotal</th>
                                        <th width="50">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="row-item">
                                        <td>
                                            <select name="items[0][product_id]" class="form-control product-select" required>
                                                <option value="" data-price="0" data-stock="0" data-image="">-- Pilih Produk --</option>
                                                @foreach($products as $p)
                                                    <option value="{{ $p->id }}" 
                                                            data-price="{{ $p->price }}" 
                                                            data-stock="{{ $p->stock }}"
                                                            data-image="{{ $p->image ? asset('storage/' . $p->image) : 'https://ui-avatars.com/api/?name='.urlencode($p->name).'&color=7F9CF5&background=EBF4FF' }}">
                                                        {{ $p->name }} (Rp{{ number_format($p->price) }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted stock-info font-italic d-block mt-1"></small>
                                        </td>
                                        <td class="text-center align-middle">
                                            <img src="" class="img-preview img-thumbnail shadow-sm" style="width: 55px; height: 55px; object-fit: cover; display: none;">
                                        </td>
                                        <td>
                                            <input type="number" name="items[0][quantity]" class="form-control qty-input text-center" value="1" min="1" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control subtotal-input font-weight-bold text-right" readonly value="Rp 0">
                                        </td>
                                        <td class="text-center align-middle">-</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-light">
                                        <th colspan="3" class="text-right align-middle font-weight-bold">Estimasi Total</th>
                                        <th colspan="2">
                                            <h5 class="m-0 font-weight-bold text-info text-right" id="grandTotalDisplay">Rp 0</h5>
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

    // Fungsi Update Foto & Subtotal
    function updateRowUI(row) {
        let option = row.find('.product-select option:selected');
        let imageUrl = option.data('image');
        let price = parseInt(option.data('price')) || 0;
        let stock = parseInt(option.data('stock')) || 0;
        let qtyInput = row.find('.qty-input');
        let qty = parseInt(qtyInput.val()) || 0;

        // Update Image
        let previewImg = row.find('.img-preview');
        if (imageUrl && option.val() !== "") {
            previewImg.attr('src', imageUrl).show();
        } else {
            previewImg.hide();
        }

        // Update Stock Info
        row.find('.stock-info').text(option.val() !== "" ? 'Tersedia: ' + stock + ' pcs' : '');
        qtyInput.attr('max', stock);

        // Update Subtotal
        let subtotal = price * qty;
        row.find('.subtotal-input').val('Rp ' + new Intl.NumberFormat('id-ID').format(subtotal));
        
        calculateGrandTotal();
    }

    // Logika Tambah Baris
    $('#addRow').click(function() {
        let newRow = `
        <tr class="row-item">
            <td>
                <select name="items[${rowCount}][product_id]" class="form-control product-select" required>
                    <option value="" data-price="0" data-stock="0" data-image="">-- Pilih Produk --</option>
                    @foreach($products as $p)
                        <option value="{{ $p->id }}" 
                                data-price="{{ $p->price }}" 
                                data-stock="{{ $p->stock }}"
                                data-image="{{ $p->image ? asset('storage/' . $p->image) : 'https://ui-avatars.com/api/?name='.urlencode($p->name).'&color=7F9CF5&background=EBF4FF' }}">
                            {{ $p->name }} (Rp{{ number_format($p->price) }})
                        </option>
                    @endforeach
                </select>
                <small class="text-muted stock-info font-italic d-block mt-1"></small>
            </td>
            <td class="text-center align-middle">
                <img src="" class="img-preview img-thumbnail shadow-sm" style="width: 55px; height: 55px; object-fit: cover; display: none;">
            </td>
            <td><input type="number" name="items[${rowCount}][quantity]" class="form-control qty-input text-center" value="1" min="1" required></td>
            <td><input type="text" class="form-control subtotal-input font-weight-bold text-right" readonly value="Rp 0"></td>
            <td class="text-center align-middle">
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

    // Event saat produk berubah
    $(document).on('change', '.product-select', function() {
        updateRowUI($(this).closest('tr'));
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
        
        updateRowUI(row);
    });

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