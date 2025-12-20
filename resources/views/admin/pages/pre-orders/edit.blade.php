FILE: resources/views/admin/pages/pre-orders/edit.blade.php
========================================= --}}

@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="h3">Edit Pre-Order: {{ $preOrder->order_number }}</h1>
        </div>
    </div>

    <form action="{{ route('admin.pre-orders.update', $preOrder) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Informasi Pesanan</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Tanggal Pengambilan/Delivery <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="delivery_date" 
                                   class="form-control @error('delivery_date') is-invalid @enderror" 
                                   value="{{ old('delivery_date', $preOrder->delivery_date->format('Y-m-d\TH:i')) }}" required>
                            @error('delivery_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" name="product_name" 
                                   class="form-control @error('product_name') is-invalid @enderror" 
                                   value="{{ old('product_name', $preOrder->product_name) }}" required>
                            @error('product_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Deskripsi Pesanan <span class="text-danger">*</span></label>
                            <textarea name="description" rows="4" 
                                      class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $preOrder->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Catatan Desain</label>
                            <textarea name="design_notes" rows="3" 
                                      class="form-control">{{ old('design_notes', $preOrder->design_notes) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Foto Referensi</label>
                            @if($preOrder->reference_image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $preOrder->reference_image) }}" 
                                     alt="Current Image" style="max-width: 200px;" class="img-thumbnail">
                            </div>
                            @endif
                            <input type="file" name="reference_image" class="form-control" accept="image/*">
                            <small class="form-text text-muted">Upload foto baru jika ingin mengganti</small>
                        </div>

                        <div class="form-group">
                            <label>Metode <span class="text-danger">*</span></label>
                            <select name="delivery_method" id="deliveryMethod" class="form-control" required>
                                <option value="pickup" {{ $preOrder->delivery_method == 'pickup' ? 'selected' : '' }}>Pickup</option>
                                <option value="delivery" {{ $preOrder->delivery_method == 'delivery' ? 'selected' : '' }}>Delivery</option>
                            </select>
                        </div>

                        <div id="deliveryAddressField" style="{{ $preOrder->delivery_method == 'delivery' ? '' : 'display:none;' }}">
                            <div class="form-group">
                                <label>Alamat Pengiriman</label>
                                <textarea name="delivery_address" rows="3" class="form-control">{{ old('delivery_address', $preOrder->delivery_address) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Catatan Admin</label>
                            <textarea name="admin_notes" rows="3" class="form-control">{{ old('admin_notes', $preOrder->admin_notes) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h5>Harga & Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Quantity <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" id="quantity" class="form-control" 
                                   value="{{ old('quantity', $preOrder->quantity) }}" min="1" required>
                        </div>

                        <div class="form-group">
                            <label>Harga per Unit <span class="text-danger">*</span></label>
                            <input type="number" name="price_per_unit" id="pricePerUnit" class="form-control" 
                                   value="{{ old('price_per_unit', $preOrder->price_per_unit) }}" min="0" step="1000" required>
                        </div>

                        <div class="form-group">
                            <label>Persentase DP <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="dp_percentage" id="dpPercentage" class="form-control" 
                                       value="{{ old('dp_percentage', $preOrder->dp_percentage) }}" min="0" max="100" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="alert alert-info">
                            <table class="table table-sm mb-0">
                                <tr>
                                    <td><strong>Total:</strong></td>
                                    <td class="text-right"><strong><span id="totalPrice">Rp 0</span></strong></td>
                                </tr>
                                <tr>
                                    <td>DP:</td>
                                    <td class="text-right"><span id="dpAmount">Rp 0</span></td>
                                </tr>
                                <tr>
                                    <td>Sisa:</td>
                                    <td class="text-right"><span id="remainingAmount">Rp 0</span></td>
                                </tr>
                            </table>
                        </div>

                        <button type="submit" class="btn btn-warning btn-block">
                            <i class="fas fa-save"></i> Update Pre-Order
                        </button>
                        <a href="{{ route('admin.pre-orders.show', $preOrder) }}" class="btn btn-secondary btn-block">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('deliveryMethod').addEventListener('change', function() {
    document.getElementById('deliveryAddressField').style.display = 
        this.value === 'delivery' ? 'block' : 'none';
});

function calculatePrice() {
    const quantity = parseFloat(document.getElementById('quantity').value) || 0;
    const pricePerUnit = parseFloat(document.getElementById('pricePerUnit').value) || 0;
    const dpPercentage = parseFloat(document.getElementById('dpPercentage').value) || 0;
    
    const totalPrice = quantity * pricePerUnit;
    const dpAmount = (totalPrice * dpPercentage) / 100;
    const remainingAmount = totalPrice - dpAmount;
    
    document.getElementById('totalPrice').textContent = formatRupiah(totalPrice);
    document.getElementById('dpAmount').textContent = formatRupiah(dpAmount);
    document.getElementById('remainingAmount').textContent = formatRupiah(remainingAmount);
}

function formatRupiah(amount) {
    return 'Rp ' + new Intl.NumberFormat('id-ID').format(amount);
}

document.getElementById('quantity').addEventListener('input', calculatePrice);
document.getElementById('pricePerUnit').addEventListener('input', calculatePrice);
document.getElementById('dpPercentage').addEventListener('input', calculatePrice);

calculatePrice();
</script>
@endpush
@endsection