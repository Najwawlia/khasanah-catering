@extends('layouts.app')

@section('title', 'Riwayat Pesanan Saya - Khasanah Catering')

@section('styles')
<style>
    .orders-wrapper {
        max-width: 1000px;
        margin: 3rem auto;
        padding: 0 1.5rem;
    }

    .orders-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .orders-title i {
        color: var(--primary-orange);
    }

    .order-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 1.8rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-soft);
        transition: all var(--transition-speed);
    }

    .order-card:hover {
        border-color: var(--primary-orange);
        box-shadow: var(--shadow-hover);
    }

    .order-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 1rem;
        flex-wrap: wrap;
        gap: 10px;
    }

    .status-pill {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
    }

    .status-pending { background: rgba(234, 179, 8, 0.15); color: #B45309; border: 1px solid #E8A320; }
    .status-paid { background: rgba(34, 197, 94, 0.2); color: var(--success); border: 1px solid var(--success); }
</style>
@section('content')

<div class="orders-wrapper">
    <h1 class="orders-title">
        <i class="fa-solid fa-receipt"></i> Riwayat Pesanan Katering Saya
    </h1>

    @forelse($orders as $order)
        <div class="order-card">
            <div class="order-card-header">
                <div>
                    <strong style="color: var(--primary-orange); font-size: 1.1rem;">{{ $order->order_code }}</strong>
                    <span style="color: var(--text-muted); font-size: 0.85rem; margin-left: 10px;">
                        Acara: {{ \Carbon\Carbon::parse($order->event_date)->format('d M Y') }}
                    </span>
                </div>
                <div>
                    <span class="status-pill {{ $order->payment_status === 'pending' ? 'status-pending' : 'status-paid' }}">
                        Status Bayar: {{ strtoupper($order->payment_status) }}
                    </span>
                </div>
            </div>

            <div style="margin-bottom: 1rem;">
                @foreach($order->items as $item)
                    <div style="display: flex; justify-content: space-between; font-size: 0.95rem; margin-bottom: 4px;">
                        <span>{{ $item->menu_name }} ({{ $item->pax_quantity }} pax)</span>
                        <strong>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong>
                    </div>
                @endforeach
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 1rem; border-top: 1px dashed var(--border-color);">
                <div>
                    Total: <strong style="color: var(--primary-orange); font-size: 1.2rem;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                </div>

                <div>
                    @if($order->payment_status === 'pending')
                        <a href="{{ route('order.payment', $order->order_code) }}" class="btn-primary" style="padding: 8px 16px; font-size: 0.9rem;">
                            <i class="fa-solid fa-credit-card"></i> Bayar Sekarang
                        </a>
                    @else
                        <a href="{{ route('order.tracking', $order->order_code) }}" class="btn-secondary" style="padding: 8px 16px; font-size: 0.9rem;">
                            <i class="fa-solid fa-truck-fast"></i> Lacak Booking
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div style="text-align: center; padding: 4rem 1rem; background: var(--bg-card); border-radius: var(--radius-lg); border: 1px dashed var(--border-color);">
            <i class="fa-solid fa-box-open" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
            <h3>Belum Ada Pesanan</h3>
            <p style="color: var(--text-muted);">Anda belum pernah melakukan booking katering.</p>
        </div>
    @endforelse
</div>

@endsection
