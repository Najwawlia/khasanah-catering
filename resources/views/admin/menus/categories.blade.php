@extends('layouts.admin')
@section('title', 'Kategori Menu - Admin')
@section('admin-title', 'Kategori Menu')
@section('content')
<div class="ph">
    <div class="ph-row">
        <div class="ph-badge"><i class="fa-solid fa-layer-group"></i></div>
        <div>
            <h1 class="ph-title">Kategori Menu</h1>
            <p class="ph-sub">Klik kategori untuk memfilter daftar menu.</p>
        </div>
    </div>
    <a href="{{ route('admin.menus.index') }}" class="btn btn-g"><i class="fa-solid fa-list"></i> Semua Menu</a>
</div>
<div class="cgrid">
    @php
        $catIcons  = ['fa-bowl-rice','fa-box','fa-cookie-bite','fa-drumstick-bite'];
        $catAccent = [
            ['fg' => 'var(--accent)', 'bg' => 'var(--accent-s)'],
            ['fg' => 'var(--gold)',   'bg' => 'var(--gold-s)'],
            ['fg' => 'var(--green)',  'bg' => 'var(--green-s)'],
            ['fg' => 'var(--coral)',  'bg' => 'var(--coral-s)'],
        ];
    @endphp
    @forelse($categories as $i => $cat)
        <a href="{{ route('admin.menus.index', ['search' => $cat->category]) }}" class="ccard">
            <div class="cico" style="background:{{ $catAccent[$i%4]['bg'] }}; color:{{ $catAccent[$i%4]['fg'] }}; border-color:transparent;">
                <i class="fa-solid {{ $catIcons[$i%4] }}"></i>
            </div>
            <div style="flex:1; min-width:0;">
                <div class="cname">{{ $cat->category }}</div>
                <div class="ccnt">{{ $cat->total_menu }} menu &middot; {{ $cat->total_tersedia }} tersedia</div>
            </div>
            <i class="fa-solid fa-arrow-right carr"></i>
        </a>
    @empty
        <div class="t-empty" style="grid-column:1/-1;">
            <div class="t-empty-ic"><i class="fa-solid fa-layer-group"></i></div>
            <div class="t-empty-msg">Belum ada kategori menu.</div>
        </div>
    @endforelse
</div>
@endsection
