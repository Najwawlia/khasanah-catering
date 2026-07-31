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
        padding: 1.5rem;
        box-shadow: var(--shadow-soft);
    }

    .cart-item-row {
        display: flex;
        align-items: center;
        gap: 1.2rem;
        padding: 1.2rem 0;
        border-bottom: 1px solid var(--border-color);
    }

    .cart-item-row:last-child {
        border-bottom: none;
    }

    .cart-item-img {
        width: 90px;
        height: 90px;
        border-radius: var(--radius-md);
        object-fit: cover;
    }

    .cart-item-info {
        flex: 1;
    }

    .cart-item-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 4px;
    }

    .cart-item-price {
        color: var(--primary-orange);
        font-weight: 700;
        font-size: 0.95rem;
    }

    .cart-item-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .pax-input-group {
        display: flex;
        align-items: center;
        background: var(--bg-input);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-sm);
        padding: 4px;
        transition: all var(--transition-speed);
    }

    .pax-input-group:focus-within {
        border-color: var(--primary-orange);
        box-shadow: 0 0 10px var(--primary-glow);
    }

    .pax-input {
        width: 70px;
        background: transparent;
        border: none;
        color: var(--text-primary);
        text-align: center;
        font-weight: 700;
        outline: none;
    }

    .btn-icon-danger {
        background: rgba(239, 68, 68, 0.15);
        color: var(--error);
        border: 1px solid rgba(239, 68, 68, 0.3);
        width: 36px;
        height: 36px;
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all var(--transition-speed);
    }

    .btn-icon-danger:hover {
        background: var(--error);
        color: var(--text-primary);
    }

    /* --- SUMMARY CARD --- */
    .summary-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 1.8rem;
        position: sticky;
        top: 100px;
        box-shadow: var(--shadow-soft);
    }

    .summary-title {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        padding-bottom: 0.8rem;
        border-bottom: 1px solid var(--border-color);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        color: var(--text-secondary);
        font-size: 0.95rem;
    }

    .summary-total-row {
        display: flex;
        justify-content: space-between;
        margin-top: 1.5rem;
        padding-top: 1rem;
        border-top: 1px dashed var(--border-color);
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--text-primary);
    }

    .notice-box {
        background: rgba(255, 102, 0, 0.1);
        border-left: 3px solid var(--primary-orange);
        padding: 10px 14px;
        border-radius: 4px;
        font-size: 0.85rem;
        color: var(--primary-orange);
        margin-bottom: 1.5rem;
        line-height: 1.5;
    }
</style>
@section('content')

<div class="cart-wrapper">
    <div class="cart-header">
        <h1 class="cart-title">
            <i class="fa-solid fa-cart-shopping"></i> Keranjang Pemesanan
        </h1>
    </div>

    @if(count($cart) > 0)
        <div class="cart-grid">
            <div class="cart-table-card">
                @foreach($cart as $id => $item)
                    <div class="cart-item-row">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="cart-item-img" onerror="this.src='https://images.unsplash.com/photo-1555244162-803834f70033?w=800'">
                        
                        <div class="cart-item-info">
                            <h3 class="cart-item-title">{{ $item['name'] }}</h3>
                            <div class="cart-item-price">Rp {{ number_format($item['price'], 0, ',', '.') }} / pack</div>
                            <small style="color: var(--text-muted);">
                                Subtotal: <strong style="color: var(--text-main);">Rp {{ number_format($item['price'] * $item['pax_quantity'], 0, ',', '.') }}</strong>
                            </small>
                        </div>

                        <div class="cart-item-actions">
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="pax-input-group">
                                @csrf
                                <input type="number" name="pax_quantity" class="pax-input" value="{{ $item['pax_quantity'] }}" min="{{ $item['category'] === 'Custom / Tumpeng' ? 1 : 30 }}" onchange="this.form.submit()">
                                <span style="font-size: 0.8rem; color: var(--text-muted); padding-right: 6px;">pack</span>
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
                    <h3 class="summary-title">Ringkasan Booking</h3>
                    
                    <div class="notice-box">
                        <i class="fa-solid fa-circle-info"></i> Standard Katering Minimal <strong>30 Pack/Porsi</strong> berlaku untuk semua menu, kecuali <strong>Custom / Tumpeng</strong>.
                    </div>

                    <div class="summary-row">
                        <span>Total Pack Dipesan:</span>
                        <span style="font-weight: 700; color: var(--text-main);">
                            {{ array_sum(array_column($cart, 'pax_quantity')) }} Porsi
                        </span>
                    </div>

                    <div class="summary-total-row">
                        <span>Total Biaya:</span>
                        <span style="color: var(--primary-orange);">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="btn-primary" style="width: 100%; margin-top: 1.5rem;">
                        <i class="fa-solid fa-calendar-check"></i> Pilih Tanggal & Checkout
                    </a>
                </div>
            </div>
        </div>
    @else
        <div style="text-align: center; padding: 5rem 1rem; background: var(--bg-card); border-radius: var(--radius-lg); border: 1px dashed var(--border-color);">
            <i class="fa-solid fa-basket-shopping" style="font-size: 4rem; color: var(--text-muted); margin-bottom: 1.2rem;"></i>
            <h2>Keranjang Pemesanan Masih Kosong</h2>
            <p style="color: var(--text-muted); margin: 0.5rem 0 1.8rem;">Silakan pilih paket menu katering lezat kami di halaman beranda.</p>
            <a href="{{ route('home') }}" class="btn-primary">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Katalog Menu
            </a>
        </div>
    @endif
</div>

@endsection
