@extends('layouts.admin')

@section('title', 'Kelola Pesanan Customer - Admin')

@section('admin-title', 'Pesanan')

@section('content')

<div class="admin-header">
    <div>
        <h1 class="admin-title">Data Pesanan Customer</h1>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Kelola pesanan, verifikasi pembayaran, dan update status progress dapur.</p>
    </div>
</div>

<div class="card-table">
    <!-- SEARCH & STATUS FILTER -->
    <form action="{{ route('admin.orders.index') }}" method="GET" style="margin-bottom: 1.5rem; display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">
        <div class="admin-search" style="max-width: 300px;">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="search" placeholder="Cari Kode Order / Nama Customer..." value="{{ request('search') }}">
        </div>

        <select name="status" onchange="this.form.submit()" style="background: var(--bg-input); border: none; color: var(--text-main); padding: 11px 18px; border-radius: 30px; outline: none; font-size: 0.88rem;">
            <option value="">Semua Status Progress</option>
            <option value="booking_received" {{ request('status') == 'booking_received' ? 'selected' : '' }}>Booking Diterima</option>
            <option value="payment_verified" {{ request('status') == 'payment_verified' ? 'selected' : '' }}>Pembayaran Diverifikasi</option>
            <option value="kitchen_prep" {{ request('status') == 'kitchen_prep' ? 'selected' : '' }}>Persiapan Dapur</option>
            <option value="ready" {{ request('status') == 'ready' ? 'selected' : '' }}>Pesanan Siap</option>
        </select>
    </form>

    <table>
        <thead>
            <tr>
                <th>Kode Booking</th>
                <th>Customer</th>
                <th>No. Telepon / WA</th>
                <th>Tgl Acara</th>
                <th>Total / Tagihan</th>
                <th>Status Bayar</th>
                <th>Progress Dapur</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td><strong style="color: var(--primary-orange);">{{ $order->order_code }}</strong></td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_phone }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->event_date)->format('d M Y') }}</td>
                    <td>
                        <strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong><br>
                        <small style="color: var(--text-muted);">
                            @if($order->payment_type === 'dp_50')
                                (DP 50%: Rp {{ number_format($order->dp_amount, 0, ',', '.') }})
                            @else
                                (Full Payment)
                            @endif
                        </small>
                    </td>
                    <td>
                        <span class="pill-badge {{ $order->payment_status === 'pending' ? 'pill-gold' : 'pill-olive' }}">
                            {{ strtoupper($order->payment_status) }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.orders.update_tracking', $order->id) }}" method="POST">
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
                    <td>
                        <div style="display: flex; gap: 6px;">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-sm btn-blue" title="Lihat Detail & Status">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi pesanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm btn-red" title="Hapus Pesanan">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; color: var(--text-muted); padding: 2rem 0;">Belum ada data pesanan katering.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
