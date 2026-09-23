@extends('layouts.app')

@section('title', 'Keranjang Katering Anda - Khasanah Catering')

@section('styles')
<style>
    .cart-wrapper {
        max-width: 1100px;
        margin: 3rem auto;
        padding: 0 1.5rem;
    }

    .cart-header {
        margin-bottom: 2rem;
    }

    .cart-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .cart-title i {
        color: var(--primary-orange);
    }

    .cart-count-badge {
        font-family: var(--font-heading);
        font-size: 0.72rem;
        font-weight: 700;
        color: var(--primary-orange);
        background: var(--primary-orange-light);
        padding: 3px 11px;
        border-radius: 20px;
        margin-left: 2px;
    }

    .cart-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    @media (max-width: 850px) {
        .cart-grid {
            grid-template-columns: 1fr;
        }
    }

    .cart-table-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 0.4rem;
        box-shadow: var(--shadow-soft);
    }

    .cart-item-row {
        display: flex;
        align-items: center;
        gap: 1.1rem;
        padding: 1.1rem;
        border-radius: var(--radius-md);
        transition: background var(--transition-speed);
    }

    .cart-item-row:hover {
        background: var(--bg-input);
    }

    .cart-item-row + .cart-item-row {
        border-top: 1px solid var(--border-color);
    }

    .cart-item-img {
        width: 84px;
        height: 84px;
        border-radius: var(--radius-md);
        object-fit: cover;
        border: 1px solid var(--border-color);
        flex-shrink: 0;
    }

    .cart-item-info {
        flex: 1;
        min-width: 0;
    }

    .cart-item-tag {
        display: inline-block;
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        color: var(--tertiary-coral-dark);
        background: var(--tertiary-coral-light);
        padding: 2px 8px;
        border-radius: 20px;
        margin-bottom: 5px;
    }

    .cart-item-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 3px;
        line-height: 1.3;
    }

    .cart-item-price {
        color: var(--text-secondary);
        font-weight: 600;
        font-size: 0.85rem;
    }

    .cart-item-subtotal {
        color: var(--primary-orange);
        font-weight: 800;
        font-size: 0.98rem;
        margin-top: 2px;
    }

    .cart-item-actions {
        display: flex;
        align-items: center;
        gap: 0.7rem;
        flex-shrink: 0;
    }

    @media (max-width: 560px) {
        .cart-item-row {
            flex-wrap: wrap;
        }
        .cart-item-info {
            flex-basis: calc(100% - 100px);
        }
        .cart-item-actions {
            flex-basis: 100%;
            justify-content: space-between;
            margin-top: 0.7rem;
        }
    }

    /* --- EMPTY CART STATE --- */
    .empty-cart {
        display: grid;
        grid-template-columns: 1fr 1.15fr;
        gap: 0;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-soft);
    }

    @media (max-width: 760px) {
        .empty-cart { grid-template-columns: 1fr; }
    }

    .empty-cart-msg {
        padding: 2.8rem 2.4rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .empty-cart-icon {
        width: 58px;
        height: 58px;
        margin-bottom: 1.2rem;
    }

    .empty-cart-msg h2 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }

    .empty-cart-msg p {
        color: var(--text-secondary);
        font-size: 0.92rem;
        line-height: 1.6;
        margin-bottom: 1.6rem;
        max-width: 340px;
    }

    .empty-cart-suggest {
        background: var(--bg-input);
        padding: 2.2rem 2rem;
        border-left: 1px solid var(--border-color);
    }

    @media (max-width: 760px) {
        .empty-cart-suggest { border-left: none; border-top: 1px solid var(--border-color); }
    }

    .empty-cart-suggest-label {
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: var(--text-muted);
        margin-bottom: 1rem;
    }

    .suggest-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px;
        border-radius: var(--radius-md);
        margin-bottom: 6px;
        transition: background var(--transition-speed);
    }

    .suggest-item:hover {
        background: var(--bg-card);
    }

    .suggest-item-img {
        width: 52px;
        height: 52px;
        border-radius: var(--radius-sm);
        object-fit: cover;
        flex-shrink: 0;
        border: 1px solid var(--border-color);
    }

    .suggest-item-info {
        flex: 1;
        min-width: 0;
    }

    .suggest-item-name {
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--text-primary);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .suggest-item-price {
        font-size: 0.78rem;
        color: var(--primary-orange);
        font-weight: 600;
    }

    .suggest-item-arrow {
        color: var(--text-muted);
        font-size: 0.8rem;
        flex-shrink: 0;
    }

    .cart-qty-stepper {
        display: flex;
        align-items: stretch;
        background: var(--bg-input);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-sm);
        overflow: hidden;
        transition: all var(--transition-speed);
    }

    .cart-qty-stepper:focus-within {
        border-color: var(--primary-orange);
        box-shadow: 0 0 10px var(--primary-glow);
    }

    .cart-qty-stepper .qty-btn {
        background: transparent;
        border: none;
        color: var(--primary-orange);
        width: 30px;
        flex-shrink: 0;
        font-size: 0.7rem;
        cursor: pointer;
        transition: all var(--transition-speed);
    }

    .cart-qty-stepper .qty-btn:hover {
        background: var(--primary-orange);
        color: #FFFFFF;
    }

    .cart-qty-input {
        width: 52px;
        min-width: 0;
        text-align: center;
        background: transparent;
        border: none;
        border-left: 1px solid var(--border-color);
        border-right: 1px solid var(--border-color);
        color: var(--text-primary);
        font-weight: 700;
        font-size: 0.85rem;
        outline: none;
        -moz-appearance: textfield;
    }

    .cart-qty-input::-webkit-outer-spin-button,
    .cart-qty-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .btn-icon-danger {
        background: var(--bg-input);
        color: var(--text-muted);
        border: 1px solid var(--border-color);
        width: 34px;
        height: 34px;
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 0.85rem;
        transition: all var(--transition-speed);
    }

    .btn-icon-danger:hover {
        background: rgba(239, 68, 68, 0.12);
        border-color: rgba(239, 68, 68, 0.3);
        color: var(--error);
    }

    /* --- SUMMARY CARD --- */
    .summary-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 1.6rem;
        position: sticky;
        top: 100px;
        box-shadow: var(--shadow-soft);
    }

    .summary-title {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 1.4rem;
        padding-bottom: 0.9rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .summary-title i { color: var(--primary-orange); font-size: 1rem; }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        color: var(--text-secondary);
        font-size: 0.92rem;
    }

    .summary-total-row {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        margin-top: 1.4rem;
        padding-top: 1.1rem;
        border-top: 1px dashed var(--border-color);
    }

    .summary-total-row span:first-child {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--text-secondary);
    }

    .summary-total-row span:last-child {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--primary-orange);
        font-family: var(--font-heading);
    }

    .notice-box {
        background: var(--primary-orange-light);
        border-left: 3px solid var(--primary-orange);
        padding: 10px 14px;
        border-radius: 4px;
        font-size: 0.82rem;
        color: var(--text-primary);
        margin-bottom: 1.3rem;
        line-height: 1.5;
    }
    .notice-box i { color: var(--primary-orange); }
</style>
@section('content')

<div class="cart-wrapper">
    <div class="cart-header">
        <h1 class="cart-title">
            <i class="fa-solid fa-cart-shopping"></i> Keranjang Pemesanan
            @if(count($cart) > 0)
                <span class="cart-count-badge">{{ count($cart) }} menu</span>
            @endif
        </h1>
    </div>

    @if(count($cart) > 0)
        <div class="cart-grid">
            <div class="cart-table-card">
                @foreach($cart as $id => $item)
                    <div class="cart-item-row">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="cart-item-img" onerror="this.src='https://images.unsplash.com/photo-1555244162-803834f70033?w=800'">

                        <div class="cart-item-info">
                            <span class="cart-item-tag">{{ $item['category'] }}</span>
                            <h3 class="cart-item-title">{{ $item['name'] }}</h3>
                            <div class="cart-item-price">Rp {{ number_format($item['price'], 0, ',', '.') }} / pack</div>
                            <div class="cart-item-subtotal">Rp {{ number_format($item['price'] * $item['pax_quantity'], 0, ',', '.') }}</div>
                        </div>

                        <div class="cart-item-actions">
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="qty-stepper cart-qty-stepper" data-min="{{ $item['category'] === 'Custom / Tumpeng' ? 1 : 30 }}">
                                @csrf
                                <button type="button" class="qty-btn qty-minus" onclick="stepCartQty(this, -1)"><i class="fa-solid fa-minus"></i></button>
                                <input type="number" name="pax_quantity" class="qty-input cart-qty-input" value="{{ $item['pax_quantity'] }}" min="{{ $item['category'] === 'Custom / Tumpeng' ? 1 : 30 }}" onchange="this.form.submit()">
                                <button type="button" class="qty-btn qty-plus" onclick="stepCartQty(this, 1)"><i class="fa-solid fa-plus"></i></button>
                            </form>

                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon-danger" title="Hapus Item" onclick="return confirm('Hapus menu ini dari keranjang?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- RINGKASAN BELANJA -->
            <div>
                <div class="summary-card">
                    <h3 class="summary-title"><i class="fa-solid fa-clipboard-list"></i> Ringkasan Booking</h3>

                    <div class="notice-box">
                        <i class="fa-solid fa-circle-info"></i> Standard Katering Minimal <strong>30 Pack/Porsi</strong> berlaku untuk semua menu, kecuali <strong>Custom / Tumpeng</strong>.
                    </div>

                    <div class="summary-row">
                        <span>Total Pack Dipesan</span>
                        <span style="font-weight: 700; color: var(--text-main);">
                            {{ array_sum(array_column($cart, 'pax_quantity')) }} Porsi
                        </span>
                    </div>

                    <div class="summary-total-row">
                        <span>Total Biaya</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="btn-primary" style="width: 100%; margin-top: 1.5rem;">
                        <i class="fa-solid fa-calendar-check"></i> Pilih Tanggal & Checkout
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="empty-cart">
            <div class="empty-cart-msg">
                <svg class="empty-cart-icon" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 50h48" stroke="#B5502E" stroke-width="3" stroke-linecap="round"/>
                    <path d="M14 50c0-13.8 8.06-25 18-25s18 11.2 18 25" stroke="#B5502E" stroke-width="3" stroke-linecap="round"/>
                    <path d="M32 25v-6" stroke="#B5502E" stroke-width="3" stroke-linecap="round"/>
                    <circle cx="32" cy="14" r="4" fill="#F3E1D6" stroke="#B5502E" stroke-width="3"/>
                </svg>
                <h2>Keranjang Kamu Masih Kosong</h2>
                <p>Belum ada menu katering yang dipilih. Yuk lihat menu favorit kami, atau jelajahi katalog lengkapnya.</p>
                <a href="{{ route('home') }}" class="btn-primary" style="align-self: flex-start;">
                    <i class="fa-solid fa-utensils"></i> Jelajahi Katalog Menu
                </a>
            </div>

            @if($suggestedMenus->count() > 0)
                <div class="empty-cart-suggest">
                    <div class="empty-cart-suggest-label">Menu Favorit Pelanggan</div>
                    @foreach($suggestedMenus as $menu)
                        <a href="{{ route('home') }}#menu-{{ $menu->id }}" class="suggest-item">
                            <img src="{{ $menu->image }}" alt="{{ $menu->name }}" class="suggest-item-img" onerror="this.src='https://images.unsplash.com/photo-1555244162-803834f70033?w=200'">
                            <div class="suggest-item-info">
                                <div class="suggest-item-name">{{ $menu->name }}</div>
                                <div class="suggest-item-price">Rp {{ number_format($menu->price_per_pax, 0, ',', '.') }} / pack</div>
                            </div>
                            <i class="fa-solid fa-chevron-right suggest-item-arrow"></i>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    @endif
</div>

@endsection

@section('scripts')
<script>
    function stepCartQty(btn, amount) {
        const form = btn.closest('.cart-qty-stepper');
        const input = form.querySelector('.cart-qty-input');
        const min = parseInt(form.dataset.min) || 1;
        let current = parseInt(input.value) || min;
        current += amount;
        if (current < min) current = min;
        input.value = current;
        form.submit();
    }
</script>
@endsection
