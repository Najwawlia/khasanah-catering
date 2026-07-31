@extends('layouts.admin')

@section('title', 'Kelola Pesanan Customer - Admin')

@section('content')

<div class="admin-header">
    <div>
        <h1 class="admin-title">SCRUD Data Pesanan Customer</h1>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Kelola pesanan, verifikasi pembayaran, dan update status progress dapur.</p>
    </div>
</div>

<div class="card-table">
    <!-- SEARCH & STATUS FILTER -->
    <form action="{{ route('admin.orders.index') }}" method="GET" style="margin-bottom: 1.5rem; display: flex; gap: 10px; flex-wrap: wrap;">
        <input type="text" name="search" placeholder="Cari Kode Order / Nama Customer..." value="{{ request('search') }}" 
               style="background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-main); padding: 10px 16px; border-radius: var(--radius-md); width: 280px; outline: none;">
        
        <select name="status" style="background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-main); padding: 10px 16px; border-radius: var(--radius-md); outline: none;">
            <option value="">-- Semua Status Progress --</option>
            <option value="booking_received" {{ request('status') == 'booking_received' ? 'selected' : '' }}>Booking Diterima</option>
            <option value="payment_verified" {{ request('status') == 'payment_verified' ? 'selected' : '' }}>Pembayaran Diverifikasi</option>
            <option value="kitchen_prep" {{ request('status') == 'kitchen_prep' ? 'selected' : '' }}>Persiapan Dapur</option>
            <option value="ready" {{ request('status') == 'ready' ? 'selected' : '' }}>Pesanan Siap</option>
        </select>

        <button type="submit" class="btn-sm btn-blue"><i class="fa-solid fa-filter"></i> Filter</button>
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
                <th>Aksi SCRUD</th>
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
                        <span style="color: {{ $order->payment_status === 'pending' ? '#B45309' : 'var(--success)' }}; font-weight: 700;">
                            {{ strtoupper($order->payment_status) }}
                        </span>
                    </td>
                    <td>
                        <span style="background: rgba(255, 107, 0, 0.15); color: var(--primary-orange); padding: 4px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 700;">
                            {{ str_replace('_', ' ', strtoupper($order->tracking_status)) }}
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 6px;">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-sm btn-blue" title="Lihat Detail & Status">
                                <i class="fa-solid fa-eye"></i> Detail
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
                    <td colspan="8" style="text-align: center; color: var(--text-muted);">Belum ada data pesanan katering.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 1.5rem;">
        {{ $orders->links() }}
    </div>
</div>

@endsection
