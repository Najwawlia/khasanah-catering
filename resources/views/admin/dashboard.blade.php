@extends('layouts.admin')

@section('title', 'Admin Dashboard - Khasanah Catering')

@section('styles')
<style>
    .admin-welcome {
        background: linear-gradient(120deg, var(--charcoal) 0%, #4A372A 100%);
        border-radius: var(--radius-lg);
        padding: 2rem 2.2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .admin-welcome::after {
        content: '';
        position: absolute;
        right: -40px; top: -40px;
        width: 180px; height: 180px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(184, 137, 43, 0.35), transparent 70%);
    }

    .admin-welcome h1 {
        color: #FFFFFF;
        font-size: 1.9rem;
        margin-bottom: 0.4rem;
    }

    .admin-welcome p {
        color: rgba(255,255,255,0.7);
        font-size: 0.92rem;
        position: relative;
        z-index: 1;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .stat-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 1.6rem;
        display: flex;
        align-items: center;
        gap: 1.2rem;
        transition: all var(--transition-speed);
        animation: fadeSlideUp 0.5s cubic-bezier(0.4,0,0.2,1) backwards;
    }

    .stat-card:nth-child(1) { animation-delay: 0.05s; }
    .stat-card:nth-child(2) { animation-delay: 0.15s; }
    .stat-card:nth-child(3) { animation-delay: 0.25s; }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-hover);
        border-color: transparent;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }

    .stat-orange { background: var(--primary-orange-light); color: var(--primary-orange-hover); }
    .stat-green { background: var(--quaternary-olive-light); color: var(--quaternary-olive-dark); }
    .stat-blue { background: var(--secondary-gold-light); color: var(--secondary-gold-dark); }

    .stat-val {
        font-family: var(--font-heading);
        font-size: 1.65rem;
        font-weight: 700;
        color: var(--text-main);
        line-height: 1.2;
    }

    .stat-label {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-top: 2px;
    }

    .card-table {
        animation: fadeSlideUp 0.5s cubic-bezier(0.4,0,0.2,1) 0.3s backwards;
    }

    .card-table h3 {
        font-size: 1.25rem;
    }
</style>
@section('content')

<div class="admin-welcome">
    <h1>Selamat Datang, Admin ✦</h1>
    <p>Berikut ringkasan performa dapur dan pemesanan katering Khasanah hari ini.</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon stat-orange"><i class="fa-solid fa-money-bill-wave"></i></div>
        <div>
            <div class="stat-val">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            <div class="stat-label">Total Omset / Pendapatan</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-blue"><i class="fa-solid fa-boxes-packing"></i></div>
        <div>
            <div class="stat-val">{{ $totalOrders }}</div>
            <div class="stat-label">Total Booking Pesanan</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-green"><i class="fa-solid fa-utensils"></i></div>
        <div>
            <div class="stat-val">{{ $totalMenus }}</div>
            <div class="stat-label">Total Menu Katering Active</div>
        </div>
    </div>
</div>

<div class="card-table">
    <h3 style="margin-bottom: 1.2rem;">Pesanan Terbaru Masuk</h3>
    <table>
        <thead>
            <tr>
                <th>Kode Booking</th>
                <th>Pemesan</th>
                <th>Tgl Acara</th>
                <th>Total Tagihan</th>
                <th>Status Bayar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentOrders as $order)
                <tr>
                    <td><strong style="color: var(--primary-orange);">{{ $order->order_code }}</strong></td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->event_date)->format('d M Y') }}</td>
                    <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td><span style="color: var(--success); font-weight: 700;">{{ strtoupper($order->payment_status) }}</span></td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-sm btn-blue">
                            <i class="fa-solid fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: var(--text-muted);">Belum ada pesanan masuk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
