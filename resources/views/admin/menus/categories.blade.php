@extends('layouts.admin')
@section('title', 'Kategori Menu - Admin')
@section('admin-title', 'Kategori Menu')
@section('content')
<div class="ph">
    <div>
        <h1 class="ph-title">Kategori Menu</h1>
        <p class="ph-sub">Klik kategori untuk memfilter daftar menu.</p>
    </div>
    <a href="{{ route('admin.menus.index') }}" class="btn btn-g"><i class="fa-solid fa-list"></i> Semua Menu</a>
</div>
<div class="cgrid">
    @php
        $catIcons = ['fa-bowl-rice','fa-box','fa-cookie-bite','fa-drumstick-bite'];
    @endphp
    @forelse($categories as $i => $cat)
        <a href="{{ route('admin.menus.index', ['search' => $cat->category]) }}" class="ccard">
            <div class="cico"><i class="fa-solid {{ $catIcons[$i%4] }}"></i></div>
            <div style="flex:1; min-width:0;">
                <div class="cname">{{ $cat->category }}</div>
                <div class="ccnt">{{ $cat->total_menu }} menu &middot; {{ $cat->total_tersedia }} tersedia</div>
            </div>
            <i class="fa-solid fa-arrow-right carr"></i>
        </a>
    @empty
        <div style="grid-column:1/-1; text-align:center; padding:3rem; color:var(--ink-3);">
            <i class="fa-solid fa-layer-group" style="font-size:1.5rem; opacity:.3; display:block; margin-bottom:10px;"></i>
            Belum ada kategori menu.
        </div>
    @endforelse
</div>
@endsection
