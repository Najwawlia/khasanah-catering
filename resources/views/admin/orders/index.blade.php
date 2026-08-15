@extends('layouts.admin')
@section('title', 'Pesanan - Admin')
@section('admin-title', 'Pesanan')
@section('content')
<div class="ph">
    <div>
        <h1 class="ph-title">Data Pesanan</h1>
        <p class="ph-sub">Kelola booking, verifikasi pembayaran, dan update progress dapur.</p>
    </div>
</div>
<div class="box">
    <div class="box-body" style="padding-bottom:0;">
        <form action="{{ route('admin.orders.index') }}" method="GET"
              style="display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
            <div class="srch" style="flex:1; min-width:200px; max-width:300px;">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" placeholder="Kode order atau nama..." value="{{ request('search') }}">
            </div>
            <select name="status" onchange="this.form.submit()" class="fsel">
                <option value="">Semua Status</option>
                <option value="booking_received"  {{ request('status')=='booking_received'  ? 'selected':'' }}>Booking Diterima</option>
                <option value="payment_verified" {{ request('status')=='payment_verified' ? 'selected':'' }}>Pembayaran Diverifikasi</option>
                <option value="kitchen_prep"     {{ request('status')=='kitchen_prep'     ? 'selected':'' }}>Persiapan Dapur</option>
                <option value="ready"            {{ request('status')=='ready'            ? 'selected':'' }}>Siap Dikirim</option>
            </select>
            @if(request('search')||request('status'))
                <a href="{{ route('admin.orders.index') }}" class="btn btn-g btn-sm"><i class="fa-solid fa-xmark"></i> Reset</a>
            @endif
        </form>
    </div>
    <div class="t-wrap" style="margin-top:12px;">
        <table>
            <thead>
                <tr>
                    <th>Kode</th><th>Customer</th><th>No. WA</th>
                    <th>Tgl Acara</th><th>Total</th><th>Bayar</th><th>Progress</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td class="t-acc">{{ $order->order_code }}</td>
                        <td>
                            <div style="display:flex; align-items:center; gap:8px;">
                                <div class="t-av">{{ strtoupper(substr($order->customer_name,0,1)) }}</div>
                                <span class="t-bold">{{ $order->customer_name }}</span>
                            </div>
                        </td>
                        <td class="t-mono">{{ $order->customer_phone }}</td>
                        <td class="t-mono">{{ \Carbon\Carbon::parse($order->event_date)->format('d M Y') }}</td>
                        <td>
                            <div class="t-bold">Rp {{ number_format($order->total_amount,0,',','.') }}</div>
                            <div class="t-muted">{{ $order->payment_type==='dp_50' ? 'DP 50%':'Full' }}</div>
                        </td>
                        <td>
                            @if($order->payment_status==='pending')
                                <span class="tag t-warn"><span class="tag-dot" style="background:var(--gold);"></span>Pending</span>
                            @elseif($order->payment_status==='paid')
                                <span class="tag t-ok"><span class="tag-dot" style="background:var(--green);"></span>Lunas</span>
                            @elseif($order->payment_status==='dp_paid')
                                <span class="tag t-acc-t"><span class="tag-dot" style="background:var(--accent);"></span>DP Paid</span>
                            @elseif($order->payment_status==='cancelled')
                                <span class="tag t-err"><span class="tag-dot" style="background:var(--red);"></span>Batal</span>
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
                        <td>
                            <div style="display:flex; gap:6px;">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-g btn-sm btn-sq" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus pesanan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-r btn-sm btn-sq" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center; color:var(--ink-3); padding:2.5rem 0; font-size:.8rem;">
                            <i class="fa-solid fa-clipboard-list" style="font-size:1.3rem; display:block; margin-bottom:8px; opacity:.35;"></i>
                            Belum ada data pesanan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
