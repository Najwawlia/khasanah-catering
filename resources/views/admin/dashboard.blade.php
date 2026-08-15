@extends('layouts.admin')

@section('title', 'Dashboard - Admin Khasanah Catering')
@section('admin-title', 'Dashboard')

@section('content')

<div class="admin-header">
    <div>
        <h1 class="admin-title">Ringkasan Operasional</h1>
        <p style="color: var(--text-muted); font-size: 0.9rem;">{{ \Carbon\Carbon::now()->format('l, d F Y') }} — pantau performa dapur & pemesanan katering di sini.</p>
    </div>
</div>

<!-- KPI STRIP: satu bar tunggal dengan pembatas garis tipis, bukan kartu terpisah -->
<div class="kpi-strip" style="margin-bottom: 1.5rem;">
    <div class="kpi-item" style="animation-delay:.03s;">
        <div class="kpi-label"><span class="kpi-dot" style="background: var(--primary-orange);"></span>Pendapatan Bulan Ini</div>
        <div class="kpi-value kpi-value-lg">Rp {{ number_format($revenueThisMonth, 0, ',', '.') }}</div>
    </div>
    <div class="kpi-item" style="animation-delay:.08s;">
        <div class="kpi-label"><span class="kpi-dot" style="background: var(--secondary-gold-dark);"></span>Total Menu</div>
        <div class="kpi-value">{{ $totalMenus }}</div>
    </div>
    <div class="kpi-item" style="animation-delay:.13s;">
        <div class="kpi-label"><span class="kpi-dot" style="background: var(--quaternary-olive-dark);"></span>Total Pelanggan</div>
        <div class="kpi-value">{{ $totalCustomers }}</div>
    </div>
    <div class="kpi-item" style="animation-delay:.18s;">
        <div class="kpi-label"><span class="kpi-dot" style="background: var(--tertiary-coral-dark);"></span>Pesanan Hari Ini</div>
        <div class="kpi-value">{{ $ordersToday }}</div>
    </div>
    <div class="kpi-item" style="animation-delay:.23s;">
        <div class="kpi-label"><span class="kpi-dot" style="background: var(--error);"></span>Menunggu Bayar</div>
        <div class="kpi-value">{{ $pendingOrders->count() }}</div>
    </div>
</div>

<div class="dashboard-grid">
    <!-- SEBARAN KATEGORI: satu bar tersegmentasi, bukan chart / progress bar terpisah -->
    <div class="list-panel">
        <div class="section-label">
            <span class="tick"></span>
            <div>
                <h3>Sebaran Menu per Kategori</h3>
                <span class="sub">Proporsi jumlah menu pada tiap kategori katalog</span>
            </div>
        </div>

        @php
            $catColors = ['#B5502E', '#B8892B', '#C97B6D', '#6B7F5B'];
            $catTotal = $categoryDistribution->sum('total') ?: 1;
        @endphp

        <div class="segment-bar">
            @foreach($categoryDistribution as $i => $cat)
                <div class="segment" style="width: {{ ($cat->total / $catTotal) * 100 }}%; background: {{ $catColors[$i % 4] }};" title="{{ $cat->category }}: {{ $cat->total }} menu"></div>
            @endforeach
        </div>

        <div class="segment-legend">
            @foreach($categoryDistribution as $i => $cat)
                <div class="segment-legend-item">
                    <span class="segment-legend-swatch" style="background: {{ $catColors[$i % 4] }};"></span>
                    <strong>{{ $cat->category }}</strong>
                    <span class="count">({{ round(($cat->total / $catTotal) * 100) }}%, {{ $cat->total }} menu)</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- MENUNGGU VERIFIKASI -->
    <div class="list-panel">
        <div class="section-label" style="justify-content: space-between; width: 100%;">
            <div style="display: flex; align-items: baseline; gap: 10px;">
                <span class="tick" style="background: var(--secondary-gold-dark);"></span>
                <div>
                    <h3>Menunggu Verifikasi</h3>
                    <span class="sub">Pesanan dengan status bayar pending</span>
                </div>
            </div>
        </div>
        @forelse($pendingOrders as $order)
            <a href="{{ route('admin.orders.show', $order->id) }}" class="list-row">
                <div>
                    <strong style="font-size: 0.87rem;">{{ $order->customer_name }}</strong>
                    <div style="font-size: 0.76rem; color: var(--text-muted);">{{ $order->order_code }}</div>
                </div>
                <span style="font-weight: 700; color: var(--primary-orange); font-size: 0.85rem;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </a>
        @empty
            <p style="color: var(--text-muted); text-align: center; padding: 1.5rem 0;">Semua pesanan sudah terverifikasi.</p>
        @endforelse
    </div>
</div>

<div class="list-panel" style="margin-top: 1.5rem;">
    <div class="section-label" style="justify-content: space-between; width: 100%;">
        <div style="display: flex; align-items: baseline; gap: 10px;">
            <span class="tick" style="background: var(--quaternary-olive-dark);"></span>
            <div>
                <h3>Pesanan Terbaru Masuk</h3>
                <span class="sub">5 transaksi booking terakhir — ubah timeline langsung di sini</span>
            </div>
        </div>
        <a href="{{ route('admin.orders.index') }}" style="color: var(--primary-orange); font-weight: 700; font-size: 0.85rem;">Lihat Semua</a>
    </div>

    <div class="table-scroll">
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
</div>

@endsection
