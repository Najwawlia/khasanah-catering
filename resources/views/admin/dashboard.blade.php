@extends('layouts.admin')

@section('title', 'Dashboard - Admin Khasanah Catering')
@section('admin-title', 'Dashboard')

@section('content')

<div class="admin-header">
    <div>
        <h1 class="admin-title">Selamat Datang, Admin ✦</h1>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Ringkasan performa dapur & pemesanan katering.</p>
    </div>
</div>

<!-- BENTO STATS: 1 hero revenue card + 4 compact tiles -->
<div class="bento-grid" style="margin-bottom: 1.5rem;">
    <div class="hero-revenue">
        <div class="hero-revenue-label">Pendapatan Bulan Ini</div>
        <div class="hero-revenue-val">Rp {{ number_format($revenueThisMonth, 0, ',', '.') }}</div>
        <div class="hero-revenue-sub"><i class="fa-solid fa-arrow-trend-up"></i> Dari {{ $ordersToday }} pesanan masuk hari ini</div>
    </div>

    <div class="stat-tile" style="animation-delay:.05s;">
        <div class="stat-tile-icon stat-orange"><i class="fa-solid fa-utensils"></i></div>
        <div>
            <div class="stat-tile-label">Total Menu</div>
            <div class="stat-tile-val">{{ $totalMenus }}</div>
        </div>
    </div>

    <div class="stat-tile" style="animation-delay:.1s;">
        <div class="stat-tile-icon stat-blue"><i class="fa-solid fa-users"></i></div>
        <div>
            <div class="stat-tile-label">Total Pelanggan</div>
            <div class="stat-tile-val">{{ $totalCustomers }}</div>
        </div>
    </div>

    <div class="stat-tile" style="animation-delay:.15s;">
        <div class="stat-tile-icon stat-rose"><i class="fa-solid fa-cart-shopping"></i></div>
        <div>
            <div class="stat-tile-label">Pesanan Hari Ini</div>
            <div class="stat-tile-val">{{ $ordersToday }}</div>
        </div>
    </div>

    <div class="stat-tile" style="animation-delay:.2s;">
        <div class="stat-tile-icon stat-green"><i class="fa-solid fa-hourglass-half"></i></div>
        <div>
            <div class="stat-tile-label">Menunggu Bayar</div>
            <div class="stat-tile-val">{{ $pendingOrders->count() }}</div>
        </div>
    </div>
</div>

<!-- SALES AREA CHART - full width -->
<div class="card-table" style="margin-bottom: 1.5rem;">
    <div class="panel-header">
        <div>
            <h3>Tren Penjualan 7 Hari Terakhir</h3>
            <p>Total omset transaksi yang berhasil dibayar per hari</p>
        </div>
    </div>
    <div class="chart-wrap" style="height: 240px;">
        <canvas id="salesChart"></canvas>
    </div>
</div>

<div class="dashboard-grid">
    <!-- CATEGORY BREAKDOWN AS RANKED BARS (not a donut, keeps it distinct) -->
    <div class="card-table">
        <div class="panel-header">
            <div>
                <h3>Sebaran Menu per Kategori</h3>
                <p>Proporsi jumlah menu pada tiap kategori katalog</p>
            </div>
        </div>
        @php
            $catColors = ['#B5502E', '#B8892B', '#C97B6D', '#6B7F5B'];
            $catMax = $categoryDistribution->max('total') ?: 1;
        @endphp
        @foreach($categoryDistribution as $i => $cat)
            <div style="margin-bottom: 1.1rem;">
                <div style="display: flex; justify-content: space-between; font-size: 0.86rem; margin-bottom: 6px;">
                    <span style="font-weight: 600;">{{ $cat->category }}</span>
                    <span style="color: var(--text-muted);">{{ $cat->total }} menu</span>
                </div>
                <div style="background: var(--bg-soft); border-radius: 20px; height: 9px; overflow: hidden;">
                    <div style="width: {{ ($cat->total / $catMax) * 100 }}%; height: 100%; border-radius: 20px; background: {{ $catColors[$i % 4] }};"></div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- PENDING PAYMENTS -->
    <div class="card-table">
        <div class="panel-header">
            <div>
                <h3><i class="fa-solid fa-triangle-exclamation" style="color: var(--secondary-gold-dark);"></i> Menunggu Verifikasi</h3>
                <p>Pesanan dengan status bayar pending</p>
            </div>
            <span class="pill-badge pill-red">{{ $pendingOrders->count() }}</span>
        </div>
        @forelse($pendingOrders as $order)
            <a href="{{ route('admin.orders.show', $order->id) }}" style="display: flex; justify-content: space-between; align-items: center; padding: 9px 0; border-bottom: 1px solid var(--bg-soft);">
                <div>
                    <strong style="font-size: 0.87rem;">{{ $order->customer_name }}</strong>
                    <div style="font-size: 0.76rem; color: var(--text-muted);">{{ $order->order_code }}</div>
                </div>
                <span style="font-weight: 700; color: var(--primary-orange); font-size: 0.85rem;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </a>
        @empty
            <p style="color: var(--text-muted); text-align: center; padding: 1.5rem 0;">Semua pesanan sudah terverifikasi 🎉</p>
        @endforelse
    </div>
</div>

<div class="card-table" style="margin-top: 1.5rem;">
    <div class="panel-header">
        <div>
            <h3>Pesanan Terbaru Masuk</h3>
            <p>5 transaksi booking terakhir</p>
        </div>
        <a href="{{ route('admin.orders.index') }}">Lihat Semua</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Kode Booking</th>
                <th>Pemesan</th>
                <th>Tgl Acara</th>
                <th>Total</th>
                <th>Status Bayar</th>
                <th>Timeline Proses</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentOrders as $order)
                <tr>
                    <td><strong style="color: var(--primary-orange);">{{ $order->order_code }}</strong></td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->event_date)->format('d M Y') }}</td>
                    <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td>
                        <span class="pill-badge {{ $order->payment_status === 'pending' ? 'pill-gold' : 'pill-olive' }}">
                            {{ strtoupper($order->payment_status) }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.orders.update_tracking', $order->id) }}" method="POST" class="tracking-inline-form">
                            @csrf
                            @method('PUT')
                            <select name="tracking_status" onchange="this.form.submit()" class="tracking-select tracking-{{ $order->tracking_status }}">
                                <option value="booking_received" {{ $order->tracking_status == 'booking_received' ? 'selected' : '' }}>1. Booking Diterima</option>
                                <option value="payment_verified" {{ $order->tracking_status == 'payment_verified' ? 'selected' : '' }}>2. Pembayaran Diverifikasi</option>
                                <option value="kitchen_prep" {{ $order->tracking_status == 'kitchen_prep' ? 'selected' : '' }}>3. Sedang Diproses Dapur</option>
                                <option value="ready" {{ $order->tracking_status == 'ready' ? 'selected' : '' }}>4. Siap Diambil / Dikirim</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align:center; color: var(--text-muted); padding: 1.5rem 0;">Belum ada pesanan masuk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
<script>
    const salesCtx = document.getElementById('salesChart');
    const salesGradient = salesCtx.getContext('2d').createLinearGradient(0, 0, 0, 240);
    salesGradient.addColorStop(0, 'rgba(181, 80, 46, 0.28)');
    salesGradient.addColorStop(1, 'rgba(181, 80, 46, 0.02)');

    new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($salesChartLabels) !!},
            datasets: [{
                label: 'Omset',
                data: {!! json_encode($salesChartData) !!},
                borderColor: '#B5502E',
                backgroundColor: salesGradient,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#B5502E',
                pointRadius: 4,
                pointHoverRadius: 6,
                borderWidth: 3,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#EFE4D4' },
                    ticks: { callback: v => 'Rp ' + (v / 1000) + 'k', font: { family: 'Inter' } }
                },
                x: { grid: { display: false }, ticks: { font: { family: 'Inter' } } }
            }
        }
    });
</script>
@endsection
