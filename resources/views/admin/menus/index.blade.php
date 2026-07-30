@extends('layouts.admin')

@section('title', 'Kelola Menu Katering - Admin')

@section('content')

<div class="admin-header">
    <div>
        <h1 class="admin-title">SCRUD Menu Makanan Katering</h1>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Kelola data katalog menu katering, harga per pax, dan ketersediaan.</p>
    </div>

    <a href="{{ route('admin.menus.create') }}" class="btn-sm btn-orange" style="padding: 10px 18px; font-size: 0.9rem;">
        <i class="fa-solid fa-plus"></i> Tambah Menu Baru
    </a>
</div>

<div class="card-table">
    <!-- SEARCH BAR -->
    <form action="{{ route('admin.menus.index') }}" method="GET" style="margin-bottom: 1.5rem; display: flex; gap: 10px;">
        <input type="text" name="search" placeholder="Cari nama menu / kategori..." value="{{ request('search') }}" 
               style="background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-main); padding: 10px 16px; border-radius: var(--radius-md); width: 300px; outline: none;">
        <button type="submit" class="btn-sm btn-blue"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama Menu</th>
                <th>Kategori</th>
                <th>Harga / Pax</th>
                <th>Min. Pax</th>
                <th>Status</th>
                <th>Aksi SCRUD</th>
            </tr>
        </thead>
        <tbody>
            @forelse($menus as $menu)
                <tr>
                    <td>
                        <img src="{{ $menu->image }}" alt="{{ $menu->name }}" style="width: 50px; height: 50px; border-radius: 8px; object-fit: cover;">
                    </td>
                    <td><strong>{{ $menu->name }}</strong></td>
                    <td><span style="color: var(--primary-orange);">{{ $menu->category }}</span></td>
                    <td>Rp {{ number_format($menu->price_per_pax, 0, ',', '.') }}</td>
                    <td>{{ $menu->min_pax }} Pax</td>
                    <td>
                        @if($menu->is_available)
                            <span style="color: #34d399; font-weight: 700;">Tersedia</span>
                        @else
                            <span style="color: #f87171;">Habis</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 6px;">
                            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn-sm btn-blue" title="Edit Menu">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Yakin mau menghapus menu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm btn-red" title="Hapus Menu">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: var(--text-muted);">Belum ada data menu.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 1.5rem;">
        {{ $menus->links() }}
    </div>
</div>

@endsection
