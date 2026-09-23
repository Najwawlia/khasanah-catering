@extends('layouts.app')

@section('title', 'Riwayat Pesanan Saya - Khasanah Catering')

@section('styles')
<style>
    .orders-wrapper {
        max-width: 780px;
        margin: 3.2rem auto;
        padding: 0 1.5rem;
    }

    .orders-header {
        margin-bottom: 2.2rem;
    }

    .orders-eyebrow {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--primary-orange);
        margin-bottom: 6px;
    }

    .orders-title {
        font-family: var(--font-heading);
        font-size: 1.9rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    /* --- RECEIPT-STYLE LIST --- */
    .orders-list {
        border-top: 1px dashed var(--border-color);
    }

    .order-row {
        display: flex;
        align-items: center;
        gap: 1.4rem;
        padding: 1.5rem 0.3rem;
        border-bottom: 1px dashed var(--border-color);
        transition: background var(--transition-speed);
    }

    .order-row:hover {
        background: var(--bg-input);
        margin: 0 -0.8rem;
        padding-left: 1.1rem;
        padding-right: 1.1rem;
        border-radius: var(--radius-md);
    }

    .order-date-stub {
        flex-shrink: 0;
        width: 58px;
        text-align: center;
        border: 1.5px dashed var(--primary-orange);
        border-radius: 10px;
        padding: 8px 4px;
        color: var(--primary-orange);
    }

    .order-date-stub .day {
        font-family: var(--font-heading);
        font-size: 1.3rem;
        font-weight: 700;
        line-height: 1;
        display: block;
    }

    .order-date-stub .mon {
        font-size: 0.62rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        display: block;
        margin-top: 3px;
        opacity: 0.85;
    }

    .order-main { flex: 1; min-width: 0; }

    .order-code-line {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 4px;
        flex-wrap: wrap;
    }

    .order-code {
        font-weight: 800;
        font-size: 0.95rem;
        color: var(--text-primary);
    }

    .order-status-dot {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.74rem;
        font-weight: 600;
        color: var(--text-muted);
    }

    .order-status-dot i { font-size: 6px; }
    .dot-pending { color: var(--secondary-gold-dark); }
    .dot-paid { color: var(--success); }

    .order-items-summary {
        color: var(--text-secondary);
        font-size: 0.86rem;
        line-height: 1.5;
        margin-bottom: 5px;
    }

    .order-tracking-line {
        font-size: 0.76rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .order-tracking-line i { color: var(--primary-orange); font-size: 0.7rem; }

    .order-side {
        flex-shrink: 0;
        text-align: right;
    }

    .order-total {
        font-family: var(--font-heading);
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
        white-space: nowrap;
    }

    .order-action-link {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--primary-orange);
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: gap var(--transition-speed);
    }
    .order-action-link:hover { gap: 8px; }

    .order-action-link.is-urgent {
        color: var(--secondary-gold-dark);
    }

    @media (max-width: 620px) {
        .order-row { flex-wrap: wrap; }
        .order-date-stub { width: 50px; }
        .order-side { margin-left: calc(58px + 1.4rem); text-align: left; }
    }

    /* --- EMPTY STATE: quiet, editorial — no loud gradient block --- */
    .orders-empty {
        text-align: center;
        padding: 4rem 1rem 3rem;
        border-top: 1px dashed var(--border-color);
    }

    .orders-empty-icon { margin: 0 auto 1.3rem; display: block; }

    .orders-empty h3 {
        font-family: var(--font-heading);
        font-size: 1.25rem;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .orders-empty p {
        color: var(--text-muted);
        font-size: 0.88rem;
        line-height: 1.6;
        margin: 0 auto 1.6rem;
        max-width: 320px;
    }
</style>
@section('content')

<div class="orders-wrapper">
    <div class="orders-header">
        <div class="orders-eyebrow">Khasanah Catering</div>
        <h1 class="orders-title">Riwayat Pesanan Saya</h1>
    </div>

    @if($orders->count() > 0)
        <div class="orders-list">
            @php
                $trackLabels = [
                    'booking_received' => 'Booking Diterima',
                    'payment_verified' => 'Pembayaran Diverifikasi',
                    'kitchen_prep' => 'Diproses Dapur',
                    'ready' => 'Siap Diambil/Dikirim',
                ];
            @endphp
            @foreach($orders as $order)
                @php
                    $eventDate = \Carbon\Carbon::parse($order->event_date);
                    $itemNames = $order->items->pluck('menu_name');
                    $itemSummary = $itemNames->take(2)->implode(', ');
                    if ($itemNames->count() > 2) {
                        $itemSummary .= ', +' . ($itemNames->count() - 2) . ' lainnya';
                    }
                @endphp
                <div class="order-row">
                    <div class="order-date-stub">
                        <span class="day">{{ $eventDate->format('d') }}</span>
                        <span class="mon">{{ $eventDate->isoFormat('MMM') }}</span>
                    </div>

                    <div class="order-main">
                        <div class="order-code-line">
                            <span class="order-code">{{ $order->order_code }}</span>
                            <span class="order-status-dot">
                                <i class="fa-solid fa-circle {{ $order->payment_status === 'pending' ? 'dot-pending' : 'dot-paid' }}"></i>
                                {{ $order->payment_status === 'pending' ? 'Menunggu Bayar' : 'Lunas' }}
                            </span>
                        </div>
                        <div class="order-items-summary">{{ $itemSummary }}</div>
                        <div class="order-tracking-line">
                            <i class="fa-solid fa-truck-fast"></i> {{ $trackLabels[$order->tracking_status] ?? $order->tracking_status }}
                        </div>
                    </div>

                    <div class="order-side">
                        <div class="order-total">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>

                        @if($order->payment_status === 'pending')
                            <a href="{{ route('order.payment', $order->order_code) }}" class="order-action-link is-urgent">
                                Bayar Sekarang <i class="fa-solid fa-arrow-right" style="font-size:0.7rem;"></i>
                            </a>
                        @elseif($order->needsSettlement())
                            <a href="{{ route('order.settlement', $order->order_code) }}" class="order-action-link is-urgent">
                                Lunasi Sekarang <i class="fa-solid fa-arrow-right" style="font-size:0.7rem;"></i>
                            </a>
                        @else
                            <a href="{{ route('order.tracking', $order->order_code) }}" class="order-action-link">
                                Lacak Booking <i class="fa-solid fa-arrow-right" style="font-size:0.7rem;"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="orders-empty">
            <svg class="orders-empty-icon" width="46" height="46" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="10" y="16" width="44" height="34" rx="4" stroke="#B5502E" stroke-width="2.5"/>
                <path d="M10 24h44" stroke="#B5502E" stroke-width="2.5"/>
                <path d="M22 16v-3a4 4 0 0 1 4-4h12a4 4 0 0 1 4 4v3" stroke="#B5502E" stroke-width="2.5" stroke-linecap="round"/>
                <path d="M22 34l6 6 12-12" stroke="#B8892B" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h3>Belum Ada Riwayat Pesanan</h3>
            <p>Semua booking katering Anda akan tercatat di sini. Yuk mulai pesan menu favorit untuk acara Anda berikutnya.</p>
            <a href="{{ route('home') }}" class="btn-primary">
                <i class="fa-solid fa-utensils"></i> Jelajahi Katalog Menu
            </a>
        </div>
    @endif
</div>

@endsection
