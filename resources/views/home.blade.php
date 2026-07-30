@extends('layouts.app')

@section('title', 'KhaCate - Booking Katering Premium & Modern')

@section('styles')
<style>
    /* --- HERO SECTION --- */
    .hero-section {
        position: relative;
        padding: 5rem 2rem;
        background: linear-gradient(180deg, rgba(30, 30, 30, 0.95) 0%, var(--bg-main) 100%), 
                    url('https://images.unsplash.com/photo-1555244162-803834f70033?w=1600&auto=format&fit=crop&q=80') center/cover no-repeat;
        border-bottom: 1px solid var(--border-color);
        text-align: center;
        overflow: hidden;
    }

    .hero-content {
        max-width: 900px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 102, 0, 0.15);
        border: 1px solid var(--primary-orange);
        color: var(--primary-orange);
        padding: 6px 16px;
        border-radius: 30px;
        font-size: 0.9rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        box-shadow: 0 0 15px var(--primary-glow);
    }

    .hero-title {
        font-size: 3.2rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 1.2rem;
        color: var(--text-primary);
    }

    .hero-title span {
        color: var(--primary-orange);
    }

    .hero-subtitle {
        font-size: 1.15rem;
        color: var(--text-secondary);
        max-width: 700px;
        margin: 0 auto 2.5rem;
        line-height: 1.6;
    }

    .hero-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    /* --- CATEGORY FILTERS --- */
    .filter-section {
        max-width: 1200px;
        margin: 3rem auto 2rem;
        padding: 0 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .category-pills {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .pill-btn {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        color: var(--text-secondary);
        padding: 8px 18px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all var(--transition-speed);
    }

    .pill-btn:hover, .pill-btn.active {
        background: var(--primary-orange);
        color: var(--text-primary);
        border-color: var(--primary-orange);
        box-shadow: 0 0 15px var(--primary-glow);
    }

    .search-box {
        display: flex;
        align-items: center;
        background: var(--bg-input);
        border: 1px solid var(--border-color);
        border-radius: 30px;
        padding: 6px 16px;
        width: 300px;
        transition: all var(--transition-speed);
    }

    .search-box:focus-within {
        border-color: var(--primary-orange);
        box-shadow: 0 0 12px var(--primary-glow);
    }

    .search-box input {
        background: transparent;
        border: none;
        outline: none;
        color: var(--text-primary);
        padding: 6px;
        width: 100%;
    }

    .search-box input::placeholder {
        color: var(--text-secondary);
    }

    .search-box i {
        color: var(--text-secondary);
    }

    /* --- MENU GRID --- */
    .menu-container {
        max-width: 1200px;
        margin: 0 auto 4rem;
        padding: 0 1.5rem;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
    }

    .menu-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: all var(--transition-speed);
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .menu-card:hover {
        transform: translateY(-8px);
        border-color: var(--primary-orange);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.5), 0 0 20px var(--primary-glow);
    }

    .card-img-wrapper {
        position: relative;
        height: 220px;
        overflow: hidden;
    }

    .card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .menu-card:hover .card-img {
        transform: scale(1.08);
    }

    .card-category-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(30, 30, 30, 0.85);
        backdrop-filter: blur(8px);
        color: var(--primary-orange);
        border: 1px solid var(--primary-orange);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
    }

    .min-pax-badge {
        position: absolute;
        bottom: 15px;
        right: 15px;
        background: var(--primary-orange);
        color: var(--text-primary);
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
    }

    .card-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .menu-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.6rem;
        color: var(--text-primary);
    }

    .menu-desc {
        color: var(--text-secondary);
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 1.2rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-footer-row {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
    }

    .price-tag {
        display: flex;
        flex-direction: column;
    }

    .price-label {
        font-size: 0.75rem;
        color: var(--text-secondary);
    }

    .price-amount {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--primary-orange);
    }

    /* --- MODAL DIALOG --- */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(8px);
        z-index: 2000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-box {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        width: 100%;
        max-width: 550px;
        padding: 2rem;
        position: relative;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
        animation: popup 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @keyframes popup {
        from { opacity: 0; transform: scale(0.8); }
        to { opacity: 1; transform: scale(1); }
    }

    .close-modal-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(255, 255, 255, 0.1);
        color: var(--text-secondary);
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: none;
        transition: all var(--transition-speed);
    }

    .close-modal-btn:hover {
        color: var(--text-primary);
        background: var(--error);
    }

    .modal-title {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .modal-price {
        font-size: 1.3rem;
        color: var(--primary-orange);
        font-weight: 800;
        margin-bottom: 1rem;
    }

    .form-group {
        margin-bottom: 1.2rem;
    }

    .form-group label {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 6px;
        color: var(--text-primary);
    }

    .form-input {
        width: 100%;
        background: var(--bg-input);
        border: 1px solid var(--border-color);
        color: var(--text-primary);
        padding: 12px;
        border-radius: var(--radius-sm);
        font-size: 1rem;
        outline: none;
        transition: all var(--transition-speed);
    }

    .form-input::placeholder {
        color: var(--text-secondary);
    }

    .form-input:focus {
        border-color: var(--primary-orange);
        box-shadow: 0 0 10px var(--primary-glow);
    }

    .subtotal-preview {
        background: rgba(255, 102, 0, 0.1);
        border: 1px dashed var(--primary-orange);
        padding: 1rem;
        border-radius: var(--radius-sm);
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
    }
</style>
@section('content')

<!-- HERO SECTION -->
<section class="hero-section">
    <div class="hero-content">
        <div class="hero-badge">
            <i class="fa-solid fa-crown"></i> Standard Katering Bintang Lima
        </div>
        <h1 class="hero-title">
            Nikmati Kelezatan Kuliner <br> untuk <span>Setiap Acara Spesial Anda</span>
        </h1>
        <p class="hero-subtitle">
            Sistem Booking Katering Online Terpercaya. Prasmanan Modern, Nasi Kotak Eksklusif, hingga Custom Tumpeng dengan Garansi Kualitas Rasa Terbaik & Pengiriman Tepat Waktu.
        </p>
        <div class="hero-buttons">
            <a href="#katalog" class="btn-primary">
                <i class="fa-solid fa-utensils"></i> Lihat Katalog Menu
            </a>
            <a href="https://wa.me/621325032009?text=Halo%20Admin,%20saya%20mau%20konsultasi%20menu%20katering" target="_blank" class="btn-secondary">
                <i class="fa-brands fa-whatsapp"></i> Konsultasi Acara Free
            </a>
        </div>
    </div>
</section>

<!-- CATEGORY FILTER & SEARCH -->
<section class="filter-section" id="katalog">
    <div class="category-pills">
        <a href="{{ route('home') }}" class="pill-btn {{ !request('category') || request('category') == 'All' ? 'active' : '' }}">
            Semua Menu
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('home', ['category' => $cat]) }}" class="pill-btn {{ request('category') == $cat ? 'active' : '' }}">
                {{ $cat }}
            </a>
        @endforeach
    </div>

    <form action="{{ route('home') }}" method="GET" class="search-box">
        @if(request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="search" placeholder="Cari menu katering..." value="{{ request('search') }}">
    </form>
</section>

<!-- MENU GRID -->
<section class="menu-container">
    @forelse($menus as $menu)
        <div class="menu-card">
            <div class="card-img-wrapper">
                <img src="{{ $menu->image }}" alt="{{ $menu->name }}" class="card-img" onerror="this.src='https://images.unsplash.com/photo-1555244162-803834f70033?w=800'">
                <span class="card-category-badge">{{ $menu->category }}</span>
                <span class="min-pax-badge"><i class="fa-solid fa-users"></i> Min. {{ $menu->min_pax }} Pax</span>
            </div>
            <div class="card-body">
                <h3 class="menu-title">{{ $menu->name }}</h3>
                <p class="menu-desc">{{ $menu->description }}</p>
                
                <div class="card-footer-row">
                    <div class="price-tag">
                        <span class="price-label">Harga per Pax</span>
                        <span class="price-amount">Rp {{ number_format($menu->price_per_pax, 0, ',', '.') }}</span>
                    </div>

                    <button class="btn-primary" style="padding: 8px 16px; font-size: 0.9rem;" 
                            onclick="openOrderModal('{{ $menu->id }}', '{{ addslashes($menu->name) }}', '{{ $menu->price_per_pax }}', '{{ $menu->min_pax }}')">
                        <i class="fa-solid fa-cart-plus"></i> Pesan
                    </button>
                </div>
            </div>
        </div>
    @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 4rem 1rem; background: var(--bg-card); border-radius: var(--radius-lg); border: 1px dashed var(--border-color);">
            <i class="fa-solid fa-utensils" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
            <h3 style="color: var(--text-main);">Menu Tidak Ditemukan</h3>
            <p style="color: var(--text-muted);">Coba cari kata kunci lain atau pilih kategori lain.</p>
        </div>
    @endforelse
</section>

<!-- MODAL TAMBAH KE KERANJANG -->
<div class="modal-overlay" id="orderModal">
    <div class="modal-box">
        <button class="close-modal-btn" onclick="closeOrderModal()">&times;</button>
        <h3 class="modal-title" id="modalMenuName">Nama Menu Katering</h3>
        <div class="modal-price" id="modalMenuPrice">Rp 0 / pax</div>
        
        <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
            @csrf
            <input type="hidden" name="menu_id" id="modalMenuId">
            
            <div class="form-group">
                <label for="paxInput">Jumlah Porsi (Pax) <span style="color: var(--primary-orange);">(Minimal 30 Pax)</span></label>
                <input type="number" name="pax_quantity" id="paxInput" class="form-input" min="30" value="30" oninput="calculateSubtotal()" required>
                <small style="color: var(--text-muted); font-size: 0.8rem; margin-top: 4px; display: block;">
                    <i class="fa-solid fa-circle-info" style="color: var(--primary-orange);"></i> Pemesanan di bawah 30 pax akan ditolak oleh sistem katering.
                </small>
            </div>

            <div class="subtotal-preview">
                <span>Total Biaya (Perkiraan):</span>
                <span id="subtotalText" style="color: var(--primary-orange); font-size: 1.2rem;">Rp 0</span>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%;">
                <i class="fa-solid fa-cart-shopping"></i> Tambahkan ke Keranjang
            </button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    let currentPrice = 0;

    function openOrderModal(id, name, price, minPax) {
        currentPrice = parseFloat(price);
        document.getElementById('modalMenuId').value = id;
        document.getElementById('modalMenuName').innerText = name;
        document.getElementById('modalMenuPrice').innerText = 'Rp ' + Number(price).toLocaleString('id-ID') + ' / pax';
        
        const paxInput = document.getElementById('paxInput');
        paxInput.value = minPax || 30;
        paxInput.min = 30;

        calculateSubtotal();
        document.getElementById('orderModal').classList.add('active');
    }

    function closeOrderModal() {
        document.getElementById('orderModal').classList.remove('active');
    }

    function calculateSubtotal() {
        const pax = parseInt(document.getElementById('paxInput').value) || 0;
        const subtotal = pax * currentPrice;
        document.getElementById('subtotalText').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
    }

    // Modal click outside to close
    window.onclick = function(event) {
        const modal = document.getElementById('orderModal');
        if (event.target == modal) {
            closeOrderModal();
        }
    }
</script>
@endsection
