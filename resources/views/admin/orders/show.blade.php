@extends('layouts.admin')
@section('title', 'Detail Pesanan - Admin')
@section('admin-title', 'Detail Pesanan')
@section('content')
<div class="ph">
    <div class="ph-row">
        <div class="ph-badge"><i class="fa-solid fa-receipt"></i></div>
        <div>
            <h1 class="ph-title">Booking #{{ $order->order_code }}</h1>
            <p class="ph-sub">
                Dibuat {{ $order->created_at->format('d M Y, H:i') }} WIB &nbsp;&middot;&nbsp;
                @if($order->payment_status==='pending') <span class="tag t-warn">Pending</span>
                @elseif($order->payment_status==='paid') <span class="tag t-ok">Lunas</span>
                @elseif($order->payment_status==='dp_paid') <span class="tag t-acc-t">DP Paid</span>
                @else <span class="tag t-err">{{ strtoupper($order->payment_status) }}</span>
                @endif
            </p>
        </div>
    </div>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-g"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
</div>

<div style="display:grid; grid-template-columns:1.7fr 1fr; gap:14px;">

    <div style="display:flex; flex-direction:column; gap:14px;">

        {{-- Update Status --}}
        <div class="box">
            <div class="box-head">
                <div>
                    <div class="box-title">Update Status</div>
                    <div class="box-sub">Pembayaran &amp; progress dapur</div>
                </div>
            </div>
            <div class="box-body">
                <form action="{{ route('admin.orders.update_status', $order->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="f2" style="margin-bottom:14px;">
                        <div class="fg" style="margin-bottom:0;">
                            <label class="fl">Status Pembayaran</label>
                            <select name="payment_status" id="paymentStatusSelect" class="fi" style="cursor:pointer;">
                                <option value="pending"   {{ $order->payment_status=='pending'   ? 'selected':'' }}>Pending</option>
                                <option value="dp_paid"   {{ $order->payment_status=='dp_paid'   ? 'selected':'' }}>DP Paid</option>
                                <option value="paid"      {{ $order->payment_status=='paid'      ? 'selected':'' }}>Lunas (100%)</option>
                                <option value="cancelled" {{ $order->payment_status=='cancelled' ? 'selected':'' }}>Dibatalkan</option>
                            </select>
                        </div>
                        <div class="fg" style="margin-bottom:0;">
                            <label class="fl">Progress Dapur</label>
                            <select name="tracking_status" id="trackingStatusSelect" class="fi" style="cursor:pointer;">
                                <option value="booking_received"  {{ $order->tracking_status=='booking_received'  ? 'selected':'' }}>1. Booking Diterima</option>
                                <option value="payment_verified" {{ $order->tracking_status=='payment_verified' ? 'selected':'' }}>2. Pembayaran Terverifikasi</option>
                                <option value="kitchen_prep"     {{ $order->tracking_status=='kitchen_prep'     ? 'selected':'' }}>3. Persiapan Dapur</option>
                                <option value="ready" id="readyOption" {{ !$order->canBeMarkedReady() ? 'disabled' : '' }} {{ $order->tracking_status=='ready' ? 'selected':'' }}>
                                    4. Pesanan Siap{{ !$order->canBeMarkedReady() ? ' (menunggu pelunasan)' : '' }}
                                </option>
                            </select>
                        </div>
                    </div>
                    @if(!$order->canBeMarkedReady())
                        <div style="background:var(--accent-s, rgba(234,88,12,.1)); border-left:3px solid var(--accent); border-radius:6px; padding:10px 12px; margin-bottom:14px; font-size:.8rem; color:var(--ink-2);">
                            <i class="fa-solid fa-circle-info" style="color:var(--accent);"></i>
                            Pesanan ini pakai DP dan belum dilunasi customer (sisa Rp {{ number_format($order->remaining_amount,0,',','.') }}). Status "Pesanan Siap" baru bisa dipilih setelah <strong>payment_status</strong> menjadi "Lunas (100%)".
                        </div>
                    @endif
                    <button type="submit" class="btn btn-p"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                </form>
            </div>
        </div>

        {{-- Timeline --}}
        <div class="box">
            <div class="box-head"><div class="box-title">Timeline Progress</div></div>
            <div class="box-body">
                @php
                    $steps = [
                        ['key'=>'booking_received',  'lbl'=>'Booking Diterima',         'sub'=>'Pesanan berhasil masuk'],
                        ['key'=>'payment_verified',  'lbl'=>'Pembayaran Terverifikasi',  'sub'=>'Admin konfirmasi pembayaran'],
                        ['key'=>'kitchen_prep',      'lbl'=>'Persiapan Dapur',           'sub'=>'Tim dapur sedang menyiapkan'],
                        ['key'=>'ready',             'lbl'=>'Pesanan Siap',              'sub'=>'Siap diambil atau dikirim'],
                    ];
                    $stepIdx = array_search($order->tracking_status, array_column($steps,'key'));
                @endphp
                <div class="tl">
                    @foreach($steps as $si => $step)
                        <div class="tl-step">
                            <div class="tl-dot {{ $si<$stepIdx ? 'done' : ($si===$stepIdx ? 'cur':'') }}">
                                @if($si<$stepIdx) <i class="fa-solid fa-check"></i>
                                @elseif($si===$stepIdx) <i class="fa-solid fa-circle-dot"></i>
                                @else {{ $si+1 }} @endif
                            </div>
                            <div class="tl-body">
                                <div class="tl-lbl" style="{{ $si>$stepIdx ? 'opacity:.35;':'' }}">{{ $step['lbl'] }}</div>
                                <div class="tl-sub" style="{{ $si>$stepIdx ? 'opacity:.3;':'' }}">{{ $step['sub'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Menu Dipesan --}}
        <div class="box">
            <div class="box-head"><div class="box-title">Menu Dipesan</div></div>
            <div class="t-wrap">
                <table>
                    <thead><tr><th>Menu</th><th>Harga/Pack</th><th>Pack</th><th>Subtotal</th></tr></thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td class="t-bold">{{ $item->menu_name }}</td>
                                <td class="t-mono">Rp {{ number_format($item->price_per_pax,0,',','.') }}</td>
                                <td><span class="tag t-neu">{{ $item->pax_quantity }} pack</span></td>
                                <td class="t-acc">Rp {{ number_format($item->subtotal,0,',','.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div style="display:flex; flex-direction:column; gap:14px;">

        {{-- Customer --}}
        <div class="box">
            <div class="box-head"><div class="box-title">Data Customer</div></div>
            <div class="box-body">
                <div style="display:flex; align-items:center; gap:10px; margin-bottom:16px;">
                    <div style="width:40px; height:40px; border-radius:10px; background:var(--accent); display:flex; align-items:center; justify-content:center; font-weight:800; font-size:.95rem; color:#fff;">
                        {{ strtoupper(substr($order->customer_name,0,1)) }}
                    </div>
                    <div>
                        <div style="font-weight:700; font-size:.9rem;">{{ $order->customer_name }}</div>
                        <div class="t-muted">Customer</div>
                    </div>
                </div>
                <div style="display:flex; flex-direction:column; gap:9px; font-size:.82rem;">
                    <div style="display:flex; gap:9px; align-items:flex-start;">
                        <i class="fa-solid fa-envelope" style="color:var(--ink-4); width:14px; margin-top:2px; flex-shrink:0;"></i>
                        <span>{{ $order->customer_email }}</span>
                    </div>
                    <div style="display:flex; gap:9px; align-items:center;">
                        <i class="fa-brands fa-whatsapp" style="color:#22C55E; width:14px; flex-shrink:0;"></i>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$order->customer_phone) }}"
                           target="_blank" style="color:var(--green); font-weight:600;">{{ $order->customer_phone }}</a>
                    </div>
                    <div style="display:flex; gap:9px; align-items:center;">
                        <i class="fa-solid fa-calendar-days" style="color:var(--accent); width:14px; flex-shrink:0;"></i>
                        <span style="font-weight:700; color:var(--accent);">{{ \Carbon\Carbon::parse($order->event_date)->format('d F Y') }}</span>
                    </div>
                    <div style="display:flex; gap:9px; align-items:center;">
                        <i class="fa-solid fa-truck" style="color:var(--ink-4); width:14px; flex-shrink:0;"></i>
                        <span>{{ strtoupper($order->delivery_type) }}</span>
                    </div>
                    @if($order->shipping_address)
                        <div style="display:flex; gap:9px; align-items:flex-start;">
                            <i class="fa-solid fa-location-dot" style="color:var(--ink-4); width:14px; flex-shrink:0; margin-top:2px;"></i>
                            <span style="color:var(--ink-2);">
                                {{ $order->shipping_address }}
                                @if($order->kecamatan)
                                    <br><span style="font-size:.72rem; color:var(--ink-4);">Kec. {{ $order->kecamatan }}, Kota Semarang</span>
                                @endif
                            </span>
                        </div>
                    @endif
                    @if($order->latitude && $order->longitude)
                        <div style="display:flex; gap:9px; align-items:center;">
                            <i class="fa-solid fa-map-location-dot" style="color:var(--ink-4); width:14px; flex-shrink:0;"></i>
                            <a href="https://www.google.com/maps?q={{ $order->latitude }},{{ $order->longitude }}" target="_blank" style="color:var(--accent); font-weight:600;">
                                Lihat Titik Lokasi di Google Maps <i class="fa-solid fa-up-right-from-square" style="font-size:.65rem;"></i>
                            </a>
                        </div>
                    @endif
                </div>
                @if($order->latitude && $order->longitude)
                    <div style="margin-top:12px; border:1px solid var(--border); border-radius:8px; overflow:hidden;">
                        <iframe src="https://maps.google.com/maps?q={{ $order->latitude }},{{ $order->longitude }}&z=16&output=embed"
                                width="100%" height="180" style="border:0; display:block;" loading="lazy" title="Lokasi Pesanan"></iframe>
                    </div>
                @endif
                @if($order->special_notes)
                    <div style="margin-top:14px; padding:10px 12px; background:var(--accent-s); border-radius:6px; border-left:3px solid var(--accent);">
                        <div style="font-size:.72rem; font-weight:700; color:var(--accent); margin-bottom:3px;"><i class="fa-solid fa-note-sticky"></i> Catatan</div>
                        <div style="font-size:.8rem; color:var(--ink-2);">{{ $order->special_notes }}</div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Tagihan --}}
        <div class="box">
            <div class="box-head"><div class="box-title">Ringkasan Tagihan</div></div>
            <div class="box-body">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                    <span style="color:var(--ink-3); font-size:.82rem;">Total Tagihan</span>
                    <span style="font-weight:800; font-size:1.1rem; color:var(--accent);">Rp {{ number_format($order->total_amount,0,',','.') }}</span>
                </div>
                <div style="height:1px; background:var(--border-2); margin-bottom:10px;"></div>
                <div style="display:flex; justify-content:space-between; font-size:.82rem; margin-bottom:7px;">
                    <span style="color:var(--ink-3);">Telah Dibayar</span>
                    <span style="font-weight:700; color:var(--green);">Rp {{ number_format($order->paid_amount,0,',','.') }}</span>
                </div>
                @php $sisa = $order->total_amount - $order->paid_amount; @endphp
                @if($sisa > 0)
                    <div style="display:flex; justify-content:space-between; font-size:.82rem;">
                        <span style="color:var(--ink-3);">Sisa</span>
                        <span style="font-weight:700; color:var(--red);">Rp {{ number_format($sisa,0,',','.') }}</span>
                    </div>
                @else
                    <div style="text-align:center; padding:7px; background:var(--green-s); border-radius:6px; font-size:.76rem; font-weight:700; color:var(--green);">
                        <i class="fa-solid fa-check-circle"></i> Pembayaran Lunas
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Kalau admin baru saja memilih "Lunas (100%)" di dropdown Status Pembayaran
    // (belum di-submit), opsi "Pesanan Siap" ikut ter-enable supaya bisa dipilih
    // dalam submit yang sama. Validasi final tetap dijaga di server (controller).
    (function () {
        var paymentSelect = document.getElementById('paymentStatusSelect');
        var readyOption = document.getElementById('readyOption');
        if (!paymentSelect || !readyOption) return;

        var originallyLocked = readyOption.disabled;

        paymentSelect.addEventListener('change', function () {
            if (paymentSelect.value === 'paid') {
                readyOption.disabled = false;
            } else if (originallyLocked) {
                readyOption.disabled = true;
                if (readyOption.selected) {
                    document.getElementById('trackingStatusSelect').value = '{{ $order->tracking_status }}';
                }
            }
        });
    })();
</script>
@endsection
