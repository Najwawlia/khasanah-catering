@extends('layouts.admin')
@section('title', 'Dashboard - Admin Khasanah Catering')
@section('admin-title', 'Dashboard')

@section('styles')
<style>
    .welcome-card {
        display: flex;
        align-items: center;
        gap: 20px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--r);
        padding: 18px 24px;
        margin-bottom: 22px;
        position: relative;
        overflow: hidden;
    }

    .welcome-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(100deg, var(--accent-s) 0%, transparent 45%);
        opacity: .5;
        pointer-events: none;
    }

    .welcome-stamp {
        width: 62px;
        height: 62px;
        border-radius: 50%;
        border: 1.5px dashed var(--accent);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: var(--accent);
        background: var(--accent-s);
        position: relative;
        z-index: 1;
    }

    .welcome-stamp .d-num {
        font-family: 'Cinzel', Georgia, serif;
        font-size: 1.35rem;
        font-weight: 700;
        line-height: 1;
    }

    .welcome-stamp .d-mon {
        font-family: 'JetBrains Mono', monospace;
        font-size: .55rem;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin-top: 2px;
    }

    .welcome-text { position: relative; z-index: 1; }

    .welcome-text h1 {
        font-family: 'Cinzel', Georgia, serif;
        font-size: 1.3rem;
        font-weight: 600;
        letter-spacing: .01em;
        color: var(--ink);
        line-height: 1.3;
    }

    .welcome-text h1 i { color: var(--gold); font-size: .85em; margin-right: 8px; }

    .welcome-text p {
        font-size: .82rem;
        color: var(--ink-3);
        margin-top: 3px;
    }
</style>
@endsection

@section('content')

@php
    $hour = \Carbon\Carbon::now()->hour;
    if ($hour < 11) { $greet = 'Selamat Pagi'; $greetIcon = 'fa-mug-hot'; }
    elseif ($hour < 15) { $greet = 'Selamat Siang'; $greetIcon = 'fa-sun'; }
    elseif ($hour < 18) { $greet = 'Selamat Sore'; $greetIcon = 'fa-cloud-sun'; }
    else { $greet = 'Selamat Malam'; $greetIcon = 'fa-moon'; }
    $now = \Carbon\Carbon::now();
@endphp

<div class="welcome-card">
    <div class="welcome-stamp">
        <span class="d-num">{{ $now->format('d') }}</span>
        <span class="d-mon">{{ $now->isoFormat('MMM') }}</span>
    </div>
    <div class="welcome-text">
        <h1><i class="fa-solid {{ $greetIcon }}"></i>{{ $greet }}, Admin</h1>
        <p>{{ $now->isoFormat('dddd, D MMMM Y') }} — begini rangkuman dapur hari ini.</p>
    </div>
</div>

{{-- STAT ROW --}}
<div class="stat-row">
    <div class="stat">
        <div class="stat-label">Pendapatan Bulan Ini</div>
        <div class="stat-val accent" style="font-size:1.2rem;">Rp {{ number_format($revenueThisMonth, 0, ',', '.') }}</div>
        <div class="stat-foot">Omset aktif</div>
    </div>
    <div class="stat">
        <div class="stat-label">Total Menu</div>
        <div class="stat-val">{{ $totalMenus }}</div>
        <div class="stat-foot">Menu aktif di katalog</div>
    </div>
    <div class="stat">
        <div class="stat-label">Pelanggan</div>
        <div class="stat-val">{{ $totalCustomers }}</div>
        <div class="stat-foot">Akun terdaftar</div>
    </div>
    <div class="stat">
        <div class="stat-label">Pesanan Hari Ini</div>
        <div class="stat-val">{{ $ordersToday }}</div>
        <div class="stat-foot">Masuk hari ini</div>
    </div>
    <div class="stat">
        <div class="stat-label">Menunggu Bayar</div>
        <div class="stat-val" style="color:var(--gold);">{{ $pendingOrders->count() }}</div>
        <div class="stat-foot">Perlu verifikasi</div>
    </div>
</div>

<div class="g2">
    {{-- Sebaran Kategori --}}
    <div class="box">
        <div class="box-head">
            <div>
                <div class="box-title">Sebaran Menu per Kategori</div>
                <div class="box-sub">Proporsi jumlah menu tiap kategori</div>
            </div>
        </div>
        <div class="box-body">
            @php
                $catColors = ['#B5502E','#8C6A1F','#A65B4E','#4F5F41'];
                $catTotal  = $categoryDistribution->sum('total') ?: 1;
            @endphp
            <div class="seg" style="margin-bottom:16px;">
                @foreach($categoryDistribution as $i => $cat)
                    <div class="seg-s"
                         style="width:{{ ($cat->total/$catTotal)*100 }}%; background:{{ $catColors[$i%4] }};"
                         title="{{ $cat->category }}: {{ $cat->total }} menu"></div>
                @endforeach
            </div>
            <div class="seg-leg">
                @foreach($categoryDistribution as $i => $cat)
                    <div class="seg-leg-item">
                        <span class="seg-leg-dot" style="background:{{ $catColors[$i%4] }};"></span>
                        <strong>{{ $cat->category }}</strong>
                        <span>{{ round(($cat->total/$catTotal)*100) }}% &middot; {{ $cat->total }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Pending --}}
    <div class="box">
        <div class="box-head">
            <div>
                <div class="box-title">Menunggu Verifikasi</div>
                <div class="box-sub">Pembayaran belum dikonfirmasi</div>
            </div>
            <span class="tag t-warn">{{ $pendingOrders->count() }}</span>
        </div>
        <div class="box-body" style="padding-top:6px;">
            @forelse($pendingOrders as $order)
                <a href="{{ route('admin.orders.show', $order->id) }}" class="pend" style="display:flex; align-items:center;">
                    <div class="pend-av">{{ strtoupper(substr($order->customer_name,0,1)) }}</div>
                    <div style="flex:1; min-width:0; margin-left:10px;">
                        <div class="pend-name">{{ $order->customer_name }}</div>
                        <div class="pend-code">{{ $order->order_code }}</div>
                    </div>
                    <div class="pend-amt">Rp {{ number_format($order->total_amount,0,',','.') }}</div>
                </a>
            @empty
                <div style="text-align:center; padding:2rem 0; color:var(--ink-3); font-size:.8rem;">
                    <i class="fa-solid fa-check-circle" style="font-size:1.2rem; color:var(--green); display:block; margin-bottom:6px;"></i>
                    Semua pesanan sudah terverifikasi
                </div>
            @endforelse
        </div>
    </div>
</div>

{{-- Tabel Pesanan Terbaru --}}
<div class="box">
    <div class="box-head">
        <div>
            <div class="box-title">Pesanan Terbaru</div>
            <div class="box-sub">5 booking terakhir</div>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="box-link">Lihat semua →</a>
    </div>
    <div class="t-wrap">
        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Pemesan</th>
                    <th>Tgl Acara</th>
                    <th>Total</th>
                    <th>Status Bayar</th>
                    <th>Timeline</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                    <tr>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="t-acc">{{ $order->order_code }}</a>
                        </td>
                        <td>
                            <div style="display:flex; align-items:center; gap:8px;">
                                <div class="t-av">{{ strtoupper(substr($order->customer_name,0,1)) }}</div>
                                <span class="t-bold">{{ $order->customer_name }}</span>
                            </div>
                        </td>
                        <td class="t-mono">{{ \Carbon\Carbon::parse($order->event_date)->format('d M Y') }}</td>
                        <td class="t-bold">Rp {{ number_format($order->total_amount,0,',','.') }}</td>
                        <td>
                            @if($order->payment_status==='pending')
                                <span class="tag t-warn"><span class="tag-dot" style="background:var(--gold);"></span>Pending</span>
                            @elseif($order->payment_status==='paid')
                                <span class="tag t-ok"><span class="tag-dot" style="background:var(--green);"></span>Lunas</span>
                            @elseif($order->payment_status==='dp_paid')
                                <span class="tag t-acc-t"><span class="tag-dot" style="background:var(--accent);"></span>DP Paid</span>
                            @else
                                <span class="tag t-neu">{{ strtoupper($order->payment_status) }}</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.orders.update_tracking', $order->id) }}" method="POST">
                                @csrf @method('PUT')
                                <select name="tracking_status" onchange="this.form.submit()"
                                        class="tsel tsel-{{ $order->tracking_status }}">
                                    <option value="booking_received"  {{ $order->tracking_status=='booking_received'  ? 'selected':'' }}>1. Booking</option>
                                    <option value="payment_verified" {{ $order->tracking_status=='payment_verified' ? 'selected':'' }}>2. Terverifikasi</option>
                                    <option value="kitchen_prep"     {{ $order->tracking_status=='kitchen_prep'     ? 'selected':'' }}>3. Dapur</option>
                                    <option value="ready"            {{ $order->tracking_status=='ready'            ? 'selected':'' }}>4. Siap</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; color:var(--ink-3); padding:2.5rem 0; font-size:.8rem;">
                            <i class="fa-solid fa-inbox" style="font-size:1.2rem; display:block; margin-bottom:8px; opacity:.4;"></i>
                            Belum ada pesanan masuk
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
