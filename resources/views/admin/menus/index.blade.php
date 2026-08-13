@extends('layouts.admin')

@section('title', 'Kelola Menu Katering - Admin')

@section('admin-title', 'Kelola Menu')

@section('content')

<div class="admin-header">
    <div>
        <h1 class="admin-title">Kelola Menu Katering</h1>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Kelola data katalog menu katering, harga per pack, dan ketersediaan.</p>
    </div>

    <a href="{{ route('admin.menus.create') }}" class="btn-sm btn-orange" style="padding: 11px 20px; font-size: 0.88rem;">
        <i class="fa-solid fa-plus"></i> Tambah Menu Baru
    </a>
</div>

<div class="card-table">
    <!-- SEARCH BAR -->
    <form action="{{ route('admin.menus.index') }}" method="GET" style="margin-bottom: 1.5rem;">
        <div class="admin-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="search" placeholder="Cari nama menu / kategori..." value="{{ request('search') }}">
        </div>
    </form>

    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama Menu</th>
                <th>Kategori</th>
                <th>Harga / Pack</th>
                <th>Min. Pack</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($menus as $menu)
                <tr>
                    <td>
                        <img src="{{ $menu->image }}" alt="{{ $menu->name }}" style="width: 46px; height: 46px; border-radius: 50%; object-fit: cover;">
                    </td>
                    <td>
                        <strong>{{ $menu->name }}</strong>
                        @if($menu->is_bestseller)
                            <i class="fa-solid fa-star" style="color: var(--secondary-gold-dark); margin-left: 4px;" title="Bestseller"></i>
                        @endif
                    </td>
                    <td><span class="pill-badge pill-rose">{{ $menu->category }}</span></td>
                    <td>Rp {{ number_format($menu->price_per_pax, 0, ',', '.') }}</td>
                    <td>{{ $menu->min_pax }} Pack</td>
                    <td>
                        @if($menu->is_available)
                            <span class="pill-badge pill-olive">Tersedia</span>
                        @else
                            <span class="pill-badge pill-red">Habis</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 6px;">
                            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn-sm btn-blue" title="Edit Menu">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Yakin mau menghapus menu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm btn-red" title="Hapus Menu">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 2rem 0;">Belum ada data menu.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
