@extends('layouts.admin')

@section('title', 'Laporan Penjualan - Admin')
@section('admin-title', 'Laporan Penjualan')

@section('content')

<div class="admin-header">
    <div>
        <h1 class="admin-title">Laporan & Ringkasan Penjualan</h1>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Rekap omset bulanan dan performa menu paling laris.</p>
    </div>
</div>

<div class="stats-grid" style="margin-bottom: 2rem;">
    <div class="stat-card">
        <div class="stat-icon stat-orange"><i class="fa-solid fa-sack-dollar"></i></div>
        <div>
            <div class="stat-val">Rp {{ number_format($totalRevenueAllTime, 0, ',', '.') }}</div>
            <div class="stat-label">Total Omset Sepanjang Waktu</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-blue"><i class="fa-solid fa-receipt"></i></div>
        <div>
            <div class="stat-val">{{ $totalOrdersAllTime }}</div>
            <div class="stat-label">Total Pesanan Masuk</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-green"><i class="fa-solid fa-chart-simple"></i></div>
        <div>
            <div class="stat-val">Rp {{ number_format($avgOrderValue, 0, ',', '.') }}</div>
            <div class="stat-label">Rata-rata Nilai per Pesanan</div>
        </div>
    </div>
</div>

<div class="dashboard-grid">
    <div class="card-table">
        <h3 style="margin-bottom: 1.2rem;">Omset 6 Bulan Terakhir</h3>
        <div class="chart-wrap">
            <canvas id="monthlyRevenueChart"></canvas>
        </div>
    </div>

    <div class="card-table">
        <h3 style="margin-bottom: 1.2rem;">Menu Paling Laris</h3>
        @forelse($topMenus as $i => $menu)
            <div class="rank-row">
                <div class="rank-number rank-{{ $i }}">{{ $i + 1 }}</div>
                <div style="flex: 1;">
                    <strong>{{ $menu->menu_name }}</strong>
                    <div style="font-size: 0.82rem; color: var(--text-muted);">{{ $menu->total_pax }} pack terjual</div>
                </div>
                <div style="font-weight: 700; color: var(--primary-orange);">Rp {{ number_format($menu->total_omset, 0, ',', '.') }}</div>
            </div>
        @empty
            <p style="color: var(--text-muted);">Belum ada data penjualan menu.</p>
        @endforelse
    </div>
</div>

@endsection

@section('scripts')
<script>
    const ctx = document.getElementById('monthlyRevenueChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($monthlyRevenue->pluck('month')) !!},
            datasets: [{
                label: 'Omset',
                data: {!! json_encode($monthlyRevenue->pluck('total')) !!},
                backgroundColor: '#B5502E',
                borderRadius: 8,
                maxBarThickness: 46,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#EFE4D4' }, ticks: { callback: v => 'Rp ' + (v/1000) + 'k' } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endsection
