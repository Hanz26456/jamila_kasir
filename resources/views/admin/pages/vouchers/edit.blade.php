{{-- Ganti bagian select produk pada file edit.blade.php menjadi seperti ini --}}
<div class="form-group">
    <label>Berlaku Untuk Produk (Kosongkan jika ingin berlaku untuk SEMUA produk)</label>
    <select name="product_ids[]" class="form-control select2" multiple="multiple">
        @foreach($products as $product)
            <option value="{{ $product->id }}" 
                {{ in_array($product->id, $voucher->products->pluck('id')->toArray()) ? 'selected' : '' }}>
                {{ $product->name }}
            </option>
        @endforeach
    </select>
</div>