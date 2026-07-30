@extends('layouts.admin')

@section('title', 'Edit Menu - Admin')

@section('content')

<div class="admin-header">
    <div>
        <h1 class="admin-title">Edit Menu: {{ $menu->name }}</h1>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Perbarui rincian menu katering.</p>
    </div>
</div>

<div class="card-table" style="max-width: 700px;">
    <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 1.2rem;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600;">Nama Menu Katering</label>
            <input type="text" name="name" value="{{ old('name', $menu->name) }}" required 
                   style="width: 100%; background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-main); padding: 12px; border-radius: var(--radius-md); outline: none;">
        </div>

        <div style="margin-bottom: 1.2rem;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600;">Kategori</label>
            <select name="category" required style="width: 100%; background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-main); padding: 12px; border-radius: var(--radius-md); outline: none;">
                <option value="Prasmanan" {{ $menu->category == 'Prasmanan' ? 'selected' : '' }}>Prasmanan</option>
                <option value="Nasi Kotak" {{ $menu->category == 'Nasi Kotak' ? 'selected' : '' }}>Nasi Kotak</option>
                <option value="Snack Box" {{ $menu->category == 'Snack Box' ? 'selected' : '' }}>Snack Box</option>
                <option value="Custom / Tumpeng" {{ $menu->category == 'Custom / Tumpeng' ? 'selected' : '' }}>Custom / Tumpeng</option>
            </select>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.2rem;">
            <div>
                <label style="display: block; margin-bottom: 6px; font-weight: 600;">Harga per Pax (Rp)</label>
                <input type="number" name="price_per_pax" value="{{ old('price_per_pax', $menu->price_per_pax) }}" required 
                       style="width: 100%; background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-main); padding: 12px; border-radius: var(--radius-md); outline: none;">
            </div>
            <div>
                <label style="display: block; margin-bottom: 6px; font-weight: 600;">Minimal Pemesanan Pax</label>
                <input type="number" name="min_pax" value="{{ old('min_pax', $menu->min_pax) }}" min="30" required 
                       style="width: 100%; background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-main); padding: 12px; border-radius: var(--radius-md); outline: none;">
            </div>
        </div>

        <div style="margin-bottom: 1.2rem;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600;">URL Gambar Foto Menu</label>
            <input type="url" name="image" value="{{ old('image', $menu->image) }}" 
                   style="width: 100%; background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-main); padding: 12px; border-radius: var(--radius-md); outline: none;">
        </div>

        <div style="margin-bottom: 1.2rem;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600;">Deskripsi Menu & Rincian Lauk</label>
            <textarea name="description" rows="4" required style="width: 100%; background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-main); padding: 12px; border-radius: var(--radius-md); outline: none;">{{ old('description', $menu->description) }}</textarea>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                <input type="checkbox" name="is_available" value="1" {{ $menu->is_available ? 'checked' : '' }} style="width: 18px; height: 18px;">
                <span>Tersedia untuk dipesan (Is Available)</span>
            </label>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn-sm btn-orange" style="padding: 12px 24px; font-size: 1rem;">
                <i class="fa-solid fa-pen"></i> Update Menu
            </button>
            <a href="{{ route('admin.menus.index') }}" class="btn-sm btn-red" style="padding: 12px 24px; font-size: 1rem; text-decoration: none;">Batal</a>
        </div>
    </form>
</div>

@endsection
