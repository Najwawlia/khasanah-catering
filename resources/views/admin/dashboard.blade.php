@extends('layouts.admin')

@section('title', 'Admin Dashboard - Khasanah Catering')

@section('styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .stat-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.2rem;
    }

    .stat-icon {
        width: 55px;
        height: 55px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .stat-orange { background: rgba(255, 107, 0, 0.15); color: var(--primary-orange); }
    .stat-green { background: rgba(16, 185, 129, 0.15); color: var(--accent-green); }
    .stat-blue { background: rgba(59, 130, 246, 0.15); color: var(--accent-blue); }

    .stat-val {
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--text-main);
    }

    .stat-label {
        font-size: 0.85rem;
        color: var(--text-muted);
    }
</style>
@section('content')

<div class="admin-header">
    <div>
        <h1 class="admin-title">Dashboard Overview</h1>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Selamat datang di Panel Manajemen Dapur & Katering Khasanah Catering</p>
    </div>
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
                    <td><span style="color: var(--success);">{{ strtoupper($order->payment_status) }}</span></td>
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
