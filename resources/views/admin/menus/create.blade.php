@extends('layouts.admin')

@section('title', 'Tambah Menu Baru - Admin')

@section('content')

<div class="admin-header">
    <div>
        <h1 class="admin-title">Tambah Menu Katering Baru</h1>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Isi formulir di bawah ini untuk menambahkan paket katering ke katalog.</p>
    </div>
</div>

<div class="card-table" style="max-width: 700px;">
    <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="margin-bottom: 1.2rem;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600;">Nama Menu Katering</label>
            <input type="text" name="name" required placeholder="Contoh: Paket Prasmanan Royal Sultan" 
                   style="width: 100%; background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-main); padding: 12px; border-radius: var(--radius-md); outline: none;">
        </div>

        <div style="margin-bottom: 1.2rem;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600;">Kategori</label>
            <select name="category" id="categorySelect" required onchange="handleCategoryChange()" style="width: 100%; background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-main); padding: 12px; border-radius: var(--radius-md); outline: none;">
                <option value="Prasmanan">Prasmanan</option>
                <option value="Nasi Kotak">Nasi Kotak</option>
                <option value="Snack Box">Snack Box</option>
                <option value="Custom / Tumpeng">Custom / Tumpeng</option>
            </select>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.2rem;">
            <div>
                <label style="display: block; margin-bottom: 6px; font-weight: 600;">Harga per Pack (Rp)</label>
                <input type="number" name="price_per_pax" required placeholder="75000" 
                       style="width: 100%; background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-main); padding: 12px; border-radius: var(--radius-md); outline: none;">
            </div>
            <div>
                <label style="display: block; margin-bottom: 6px; font-weight: 600;">Minimal Pemesanan Pack</label>
                <input type="number" name="min_pax" id="minPaxInput" value="30" min="30" required 
                       style="width: 100%; background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-main); padding: 12px; border-radius: var(--radius-md); outline: none;">
                <small id="minPaxHint" style="color: var(--text-muted); font-size: 0.8rem; margin-top: 4px; display: none;">
                    Menu Custom / Tumpeng tidak wajib punya minimal pack (boleh diisi 1).
                </small>
            </div>
        </div>

        <div style="margin-bottom: 1.2rem;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600;">Foto Menu</label>
            <input type="file" name="image" accept="image/*"
                   style="width: 100%; background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-main); padding: 12px; border-radius: var(--radius-md); outline: none;">
            <small style="color: var(--text-muted); font-size: 0.8rem; margin-top: 4px; display: block;">
                Format JPG, PNG, atau WEBP, maksimal 2MB. Jika tidak diunggah, akan dipakai foto default.
            </small>
            @error('image')
                <span style="color: var(--danger-red); font-size: 0.85rem; margin-top: 4px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 1.2rem;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600;">Deskripsi Menu & Rincian Lauk</label>
            <textarea name="description" rows="4" required placeholder="Rincian lauk pauk, desert, dan minuman..." 
                      style="width: 100%; background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-main); padding: 12px; border-radius: var(--radius-md); outline: none;"></textarea>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                <input type="checkbox" name="is_available" value="1" checked style="width: 18px; height: 18px;">
                <span>Tersedia untuk dipesan (Is Available)</span>
            </label>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                <input type="checkbox" name="is_bestseller" value="1" style="width: 18px; height: 18px;">
                <span>Tandai sebagai <strong>Bestseller</strong> (tampil di 6 menu utama homepage)</span>
            </label>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn-sm btn-orange" style="padding: 12px 24px; font-size: 1rem;">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Menu Baru
            </button>
            <a href="{{ route('admin.menus.index') }}" class="btn-sm btn-red" style="padding: 12px 24px; font-size: 1rem; text-decoration: none;">Batal</a>
        </div>
    </form>
</div>

<script>
    function handleCategoryChange() {
        const category = document.getElementById('categorySelect').value;
        const minPaxInput = document.getElementById('minPaxInput');
        const minPaxHint = document.getElementById('minPaxHint');
        const isTumpeng = category === 'Custom / Tumpeng';

        minPaxInput.min = isTumpeng ? 1 : 30;
        minPaxHint.style.display = isTumpeng ? 'block' : 'none';
        if (isTumpeng && parseInt(minPaxInput.value) < 1) {
            minPaxInput.value = 1;
        }
    }
</script>

@endsection
