@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="h3">Buat Pre-Order Baru</h1>
        </div>
    </div>

    <form action="{{ route('admin.pre-orders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
            <div class="col-md-8">
                {{-- Customer & Basic Info --}}
                <div class="card">
                    <div class="card-header">
                        <h5>Informasi Customer & Pesanan</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Customer <span class="text-danger">*</span></label>
                            <select name="customer_id" class="form-control @error('customer_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Customer --</option>
                                @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }} - {{ $customer->phone }}
                                </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Pengambilan/Delivery <span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="delivery_date" 
                                           class="form-control @error('delivery_date') is-invalid @enderror" 
                                           value="{{ old('delivery_date') }}" required>
                                    @error('delivery_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tipe Order <span class="text-danger">*</span></label>
                                    <select name="order_type" class="form-control @error('order_type') is-invalid @enderror" required>
                                        <option value="custom_cake" {{ old('order_type') == 'custom_cake' ? 'selected' : '' }}>Custom Cake</option>
                                        <option value="pre_order" {{ old('order_type') == 'pre_order' ? 'selected' : '' }}>Pre-Order</option>
                                        <option value="catering" {{ old('order_type') == 'catering' ? 'selected' : '' }}>Catering</option>
                                    </select>
                                    @error('order_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" name="product_name" 
                                   class="form-control @error('product_name') is-invalid @enderror" 
                                   value="{{ old('product_name') }}" 
                                   placeholder="Contoh: Kue Ulang Tahun 2 Tingkat Tema Unicorn" required>
                            @error('product_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Deskripsi Pesanan <span class="text-danger">*</span></label>
                            <textarea name="description" rows="4" 
                                      class="form-control @error('description') is-invalid @enderror" 
                                      placeholder="Jelaskan detail pesanan..." required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Catatan Desain</label>
                            <textarea name="design_notes" rows="3" 
                                      class="form-control @error('design_notes') is-invalid @enderror" 
                                      placeholder="Contoh: Tulisan 'Happy Birthday Sarah', Umur 7 tahun, warna pink-ungu">{{ old('design_notes') }}</textarea>
                            <small class="form-text text-muted">Tulisan di kue, dekorasi khusus, dll</small>
                            @error('design_notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Foto Referensi</label>
                            <input type="file" name="reference_image" 
                                   class="form-control @error('reference_image') is-invalid @enderror" 
                                   accept="image/*">
                            <small class="form-text text-muted">Upload foto contoh desain (Max 5MB)</small>
                            @error('reference_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Spesifikasi Detail --}}
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Spesifikasi Detail</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ukuran</label>
                                    <input type="text" name="spec_size" class="form-control" 
                                           value="{{ old('spec_size') }}" 
                                           placeholder="Contoh: 2 tingkat, Diameter 20cm">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bentuk</label>
                                    <input type="text" name="spec_shape" class="form-control" 
                                           value="{{ old('spec_shape') }}" 
                                           placeholder="Contoh: Bulat, Kotak, Love">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rasa</label>
                                    <input type="text" name="spec_flavor" class="form-control" 
                                           value="{{ old('spec_flavor') }}" 
                                           placeholder="Contoh: Red Velvet, Coklat, Vanilla">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Filling/Isian</label>
                                    <input type="text" name="spec_filling" class="form-control" 
                                           value="{{ old('spec_filling') }}" 
                                           placeholder="Contoh: Cream Cheese, Buttercream">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tema Warna</label>
                                    <input type="text" name="spec_color_theme" class="form-control" 
                                           value="{{ old('spec_color_theme') }}" 
                                           placeholder="Contoh: Pink-Ungu, Biru Tosca">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Topping/Dekorasi</label>
                                    <input type="text" name="spec_topping" class="form-control" 
                                           value="{{ old('spec_topping') }}" 
                                           placeholder="Contoh: Unicorn Fondant, Fresh Fruit">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Delivery Method --}}
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Metode Pengambilan</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Metode <span class="text-danger">*</span></label>
                            <select name="delivery_method" id="deliveryMethod" 
                                    class="form-control @error('delivery_method') is-invalid @enderror" required>
                                <option value="pickup" {{ old('delivery_method') == 'pickup' ? 'selected' : '' }}>Pickup (Ambil di Toko)</option>
                                <option value="delivery" {{ old('delivery_method') == 'delivery' ? 'selected' : '' }}>Delivery (Antar)</option>
                            </select>
                            @error('delivery_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="deliveryAddressField" style="display: none;">
                            <div class="form-group">
                                <label>Alamat Pengiriman <span class="text-danger">*</span></label>
                                <textarea name="delivery_address" rows="3" 
                                          class="form-control @error('delivery_address') is-invalid @enderror" 
                                          placeholder="Alamat lengkap untuk pengiriman">{{ old('delivery_address') }}</textarea>
                                @error('delivery_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Biaya Pengiriman</label>
                                <input type="number" name="delivery_fee" class="form-control" 
                                       value="{{ old('delivery_fee', 0) }}" min="0" step="1000">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Notes --}}
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Catatan Tambahan</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Catatan dari Customer</label>
                            <textarea name="customer_notes" rows="3" class="form-control" 
                                      placeholder="Permintaan khusus dari customer...">{{ old('customer_notes') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Catatan Admin (Internal)</label>
                            <textarea name="admin_notes" rows="3" class="form-control" 
                                      placeholder="Catatan internal untuk admin/produksi...">{{ old('admin_notes') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pricing Sidebar --}}
            <div class="col-md-4">
                <div class="card sticky-top" style="top: 20px;">
                    <div class="card-header bg-primary text-white">
                        <h5>Harga & Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Quantity <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" id="quantity" 
                                   class="form-control @error('quantity') is-invalid @enderror" 
                                   value="{{ old('quantity', 1) }}" min="1" required>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Harga per Unit <span class="text-danger">*</span></label>
                            <input type="number" name="price_per_unit" id="pricePerUnit" 
                                   class="form-control @error('price_per_unit') is-invalid @enderror" 
                                   value="{{ old('price_per_unit') }}" min="0" step="1000" required>
                            @error('price_per_unit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Persentase DP <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="dp_percentage" id="dpPercentage" 
                                       class="form-control @error('dp_percentage') is-invalid @enderror" 
                                       value="{{ old('dp_percentage', 50) }}" min="0" max="100" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            @error('dp_percentage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        {{-- Calculation Display --}}
                        <div class="alert alert-info">
                            <table class="table table-sm mb-0">
                                <tr>
                                    <td><strong>Total Harga:</strong></td>
                                    <td class="text-right"><strong><span id="totalPrice">Rp 0</span></strong></td>
                                </tr>
                                <tr>
                                    <td>DP (<span id="dpPercent">50</span>%):</td>
                                    <td class="text-right"><span id="dpAmount">Rp 0</span></td>
                                </tr>
                                <tr>
                                    <td>Sisa Pembayaran:</td>
                                    <td class="text-right"><span id="remainingAmount">Rp 0</span></td>
                                </tr>
                            </table>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg">
                            <i class="fas fa-save"></i> Buat Pre-Order
                        </button>
                        <a href="{{ route('admin.pre-orders.index') }}" class="btn btn-secondary btn-block">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
// Show/hide delivery address field
document.getElementById('deliveryMethod').addEventListener('change', function() {
    const deliveryAddressField = document.getElementById('deliveryAddressField');
    if (this.value === 'delivery') {
        deliveryAddressField.style.display = 'block';
    } else {
        deliveryAddressField.style.display = 'none';
    }
});

// Auto calculate pricing
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
    document.getElementById('dpPercent').textContent = dpPercentage;
}

function formatRupiah(amount) {
    return 'Rp ' + new Intl.NumberFormat('id-ID').format(amount);
}

document.getElementById('quantity').addEventListener('input', calculatePrice);
document.getElementById('pricePerUnit').addEventListener('input', calculatePrice);
document.getElementById('dpPercentage').addEventListener('input', calculatePrice);

// Initial calculation
calculatePrice();

// Initial delivery method check
if (document.getElementById('deliveryMethod').value === 'delivery') {
    document.getElementById('deliveryAddressField').style.display = 'block';
}
</script>
@endpush
@endsection