@extends('layouts.admin')
@section('title', 'Kelola Menu - Admin')
@section('admin-title', 'Kelola Menu')
@section('content')
<div class="ph">
    <div class="ph-row">
        <div class="ph-badge"><i class="fa-solid fa-utensils"></i></div>
        <div>
            <h1 class="ph-title">Kelola Menu Katering</h1>
            <p class="ph-sub">Atur katalog menu, harga, dan ketersediaan.</p>
        </div>
    </div>
    <a href="{{ route('admin.menus.create') }}" class="btn btn-p">
        <i class="fa-solid fa-plus"></i> Tambah Menu
    </a>
</div>
<div class="box">
    <div class="box-body" style="padding-bottom:0;">
        <form action="{{ route('admin.menus.index') }}" method="GET" style="display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
            <div class="srch" style="flex:1; min-width:200px; max-width:340px;">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" placeholder="Cari nama menu atau kategori..." value="{{ request('search') }}">
            </div>
            @if(request('search'))
                <a href="{{ route('admin.menus.index') }}" class="btn btn-g btn-sm"><i class="fa-solid fa-xmark"></i> Reset</a>
            @endif
        </form>
    </div>
    <div class="t-wrap" style="margin-top:12px;">
        <table>
            <thead>
                <tr>
                    <th>Foto</th><th>Nama Menu</th><th>Kategori</th>
                    <th>Harga / Pack</th><th>Min. Pack</th><th>Status</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menus as $menu)
                    <tr>
                        <td><img src="{{ $menu->image }}" alt="{{ $menu->name }}" class="t-thumb"
                                 onerror="this.src='https://images.unsplash.com/photo-1555244162-803834f70033?w=100'"></td>
                        <td>
                            <div class="t-bold">{{ $menu->name }}</div>
                            @if($menu->is_bestseller)
                                <span class="tag t-warn" style="margin-top:3px;"><i class="fa-solid fa-star" style="font-size:.55rem;"></i> Bestseller</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $catTagClass = match($menu->category) {
                                    'Prasmanan' => 't-sapphire',
                                    'Nasi Kotak' => 't-warn',
                                    'Snack Box' => 't-emerald',
                                    'Custom / Tumpeng' => 't-teal',
                                    default => 't-acc-t',
                                };
                            @endphp
                            <span class="tag {{ $catTagClass }}">{{ $menu->category }}</span>
                        </td>
                        <td class="t-bold">Rp {{ number_format($menu->price_per_pax,0,',','.') }}</td>
                        <td class="t-mono">{{ $menu->min_pax }} pack</td>
                        <td>
                            @if($menu->is_available)
                                <span class="tag t-ok"><span class="tag-dot" style="background:var(--green);"></span>Tersedia</span>
                            @else
                                <span class="tag t-err"><span class="tag-dot" style="background:var(--red);"></span>Habis</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex; gap:6px;">
                                <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-g btn-sm btn-sq" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST"
                                      class="js-confirm"
                                      data-confirm-title="Hapus Menu"
                                      data-confirm-message="Apakah Anda yakin ingin menghapus menu '{{ $menu->name }}'? Tindakan ini tidak bisa dibatalkan."
                                      data-confirm-label="Ya, Hapus">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-r btn-sm btn-sq" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="t-empty">
                            <div class="t-empty-ic"><i class="fa-solid fa-utensils"></i></div>
                            <div class="t-empty-msg">
                                Belum ada data menu.
                                <a href="{{ route('admin.menus.create') }}">Tambah sekarang →</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
