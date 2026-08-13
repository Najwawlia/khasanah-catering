@extends('layouts.admin')

@section('title', 'Kategori Menu - Admin')
@section('admin-title', 'Kategori Menu')

@section('content')

<div class="admin-header">
    <div>
        <h1 class="admin-title">Kategori Menu Katering</h1>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Ringkasan jumlah menu pada tiap kategori katalog.</p>
    </div>
</div>

<div class="category-grid">
    @php
        $colors = ['orange', 'gold', 'coral', 'olive'];
        $icons = ['fa-bowl-rice', 'fa-box', 'fa-cookie-bite', 'fa-drumstick-bite'];
    @endphp
    @forelse($categories as $i => $cat)
        <a href="{{ route('admin.menus.index', ['search' => $cat->category]) }}" class="category-card cat-{{ $colors[$i % 4] }}">
            <div class="category-icon"><i class="fa-solid {{ $icons[$i % 4] }}"></i></div>
            <div>
                <div class="category-name">{{ $cat->category }}</div>
                <div class="category-count">{{ $cat->total_menu }} menu &middot; {{ $cat->total_tersedia }} tersedia</div>
            </div>
            <i class="fa-solid fa-arrow-right category-arrow"></i>
        </a>
    @empty
        <p style="color: var(--text-muted);">Belum ada kategori menu.</p>
    @endforelse
</div>

@endsection
