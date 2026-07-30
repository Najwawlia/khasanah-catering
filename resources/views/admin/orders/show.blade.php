@extends('layouts.admin')

@section('title', 'Detail Pesanan ' . $order->order_code . ' - Admin')

@section('content')

<div class="admin-header">
    <div>
        <h1 class="admin-title">Detail Booking #{{ $order->order_code }}</h1>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Dibuat pada {{ $order->created_at->format('d M Y, H:i') }} WIB</p>
    </div>

    <a href="{{ route('admin.orders.index') }}" class="btn-sm btn-blue" style="padding: 10px 18px;">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Pesanan
    </a>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
    <div>
        <!-- FORM UPDATE STATUS TRANSAKSI & PROGRESS -->
        <div class="card-table" style="margin-bottom: 2rem;">
            <h3 style="margin-bottom: 1.2rem; color: var(--primary-orange);"><i class="fa-solid fa-sliders"></i> Update Status Pesanan & Pembayaran</h3>

            <form action="{{ route('admin.orders.update_status', $order->id) }}" method="POST" style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 1rem; align-items: end;">
                @csrf
                @method('PUT')

                <div>
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 0.85rem;">Status Pembayaran</label>
                    <select name="payment_status" style="width: 100%; background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-main); padding: 10px; border-radius: var(--radius-sm); outline: none;">
                        <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending (Belum Bayar)</option>
                        <option value="dp_paid" {{ $order->payment_status == 'dp_paid' ? 'selected' : '' }}>DP Paid (DP 50% Lunas)</option>
                        <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid (Lunas 100%)</option>
                        <option value="cancelled" {{ $order->payment_status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 0.85rem;">Status Progress Dapur</label>
                    <select name="tracking_status" style="width: 100%; background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-main); padding: 10px; border-radius: var(--radius-sm); outline: none;">
                        <option value="booking_received" {{ $order->tracking_status == 'booking_received' ? 'selected' : '' }}>1. Booking Diterima</option>
                        <option value="payment_verified" {{ $order->tracking_status == 'payment_verified' ? 'selected' : '' }}>2. Pembayaran Diverifikasi</option>
                        <option value="kitchen_prep" {{ $order->tracking_status == 'kitchen_prep' ? 'selected' : '' }}>3. Persiapan Dapur</option>
                        <option value="ready" {{ $order->tracking_status == 'ready' ? 'selected' : '' }}>4. Pesanan Siap (Dikirim/Pickup)</option>
                    </select>
                </div>

                <button type="submit" class="btn-sm btn-orange" style="padding: 10px 20px; font-size: 0.95rem;">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Status
                </button>
            </form>
        </div>

        <!-- RINCIAN MENU DITESAN -->
        <div class="card-table">
            <h3 style="margin-bottom: 1.2rem;"><i class="fa-solid fa-utensils"></i> Menu Katering Dipesan</h3>
            <table>
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th>Harga / Pax</th>
                        <th>Jumlah Pax</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td><strong>{{ $item->menu_name }}</strong></td>
                            <td>Rp {{ number_format($item->price_per_pax, 0, ',', '.') }}</td>
                            <td><strong>{{ $item->pax_quantity }} Pax</strong></td>
                            <td><strong style="color: var(--primary-orange);">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- DETAIL INFORMASI CUSTOMER -->
    <div>
        <div class="card-table">
            <h3 style="margin-bottom: 1rem; color: var(--primary-orange);"><i class="fa-solid fa-address-card"></i> Data Customer</h3>
            
            <div style="font-size: 0.95rem; line-height: 1.8;">
                <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
                <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                <p>
                    <strong>WhatsApp:</strong> 
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}" target="_blank" style="color: #34d399; font-weight: 700;">
                        {{ $order->customer_phone }} <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </p>
                <p><strong>Tanggal Acara:</strong> <span style="color: var(--primary-orange); font-weight: 700;">{{ \Carbon\Carbon::parse($order->event_date)->format('d F Y') }}</span></p>
                <p><strong>Tipe Layanan:</strong> {{ strtoupper($order->delivery_type) }}</p>
                @if($order->shipping_address)
                    <p><strong>Alamat Pengiriman:</strong><br>{{ $order->shipping_address }}</p>
                @endif
                
                @if($order->special_notes)
                    <div style="margin-top: 1rem; background: var(--bg-input); padding: 12px; border-radius: var(--radius-sm); border-left: 3px solid var(--primary-orange);">
                        <strong>Catatan Khusus / Dietary Notes:</strong><br>
                        <small style="color: var(--text-muted);">{{ $order->special_notes }}</small>
                    </div>
                @endif
            </div>

            <hr style="border: none; border-top: 1px dashed var(--border-color); margin: 1.5rem 0;">

            <div style="font-size: 1.1rem; font-weight: 800; display: flex; justify-content: space-between;">
                <span>Total Tagihan:</span>
                <span style="color: var(--primary-orange);">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </div>
            <div style="font-size: 0.9rem; color: var(--text-muted); display: flex; justify-content: space-between; margin-top: 6px;">
                <span>Telah Dibayar:</span>
                <span style="color: #34d399; font-weight: 700;">Rp {{ number_format($order->paid_amount, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>

@endsection
