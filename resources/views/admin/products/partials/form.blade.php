@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label for="name" class="form-label">Nama Produk</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name ?? '') }}"
        required>
</div>
<div class="mb-3">
    <label for="description" class="form-label">Deskripsi Produk</label>
    <input type="text" class="form-control" id="description" name="description"
        value="{{ old('description', $product->description ?? '') }}">
</div>
<div class="mb-3">
    <label for="price" class="form-label">Harga</label>
    <input type="number" class="form-control" id="price" name="price"
        value="{{ old('price', $product->price ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="stock" class="form-label">Stok</label>
    <input type="number" class="form-control" id="stock" name="stock"
        value="{{ old('stock', $product->stock ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="image" class="form-label">Gambar Produk</label>
    <input type="file" class="form-control" id="image" name="image">
    @isset($product)
        @if ($product->image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $product->image) }}" width="150" alt="Current Image">
            </div>
        @endif
    @endisset
</div>
<div class="mb-3">
    <label for="rating" class="form-label">Rating (1-5)</label>
    <input type="number" class="form-control" id="rating" name="rating"
        value="{{ old('rating', $product->rating ?? '') }}">
</div>
<div class="mb-3">
    <label for="discount" class="form-label">Diskon (%)</label>
    <input type="number" class="form-control" id="discount" name="discount"
        value="{{ old('discount', $product->discount ?? '') }}">
</div>
<div class="mb-3">
    <label for="link" class="form-label">Link Eksternal</label>
    <input type="url" class="form-control" id="link" name="link"
        value="{{ old('link', $product->link ?? '') }}">
</div>
<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>

<script>
    document.getElementById('productForm').addEventListener('submit', function() {
        // Temukan semua tombol submit di dalam form ini
        let buttons = this.querySelectorAll('button[type="submit"]');

        // Nonaktifkan semua tombol tersebut
        buttons.forEach(function(button) {
            button.setAttribute('disabled', 'disabled');
            button.innerText = 'Menyimpan...'; // Opsional: Beri tahu pengguna
        });
    });
</script>
