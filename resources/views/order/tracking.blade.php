@extends('layouts.app')

@section('title', 'Status Booking - ' . $order->order_code)

@section('styles')
<style>
    .tracking-wrapper {
        max-width: 900px;
        margin: 2.5rem auto;
        padding: 0 1.5rem;
    }

    /* --- SUCCESS HERO --- */
    .success-hero {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 2.2rem 2rem;
        text-align: center;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-soft);
    }

    .success-icon {
        width: 60px;
        height: 60px;
        background: var(--success);
        color: #FFFFFF;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin: 0 auto 1rem;
    }

    .creative-title {
        font-family: var(--font-heading);
        font-size: 1.55rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.6rem;
    }

    .creative-subtitle {
        color: var(--text-secondary);
        font-size: 0.92rem;
        line-height: 1.6;
        max-width: 520px;
        margin: 0 auto;
    }

    .creative-subtitle strong { color: var(--text-primary); }

    /* --- TRACKING TIMELINE --- */
    .timeline-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 1.8rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-soft);
    }

    .timeline-header {
        font-family: var(--font-heading);
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .timeline-header i { color: var(--primary-orange); font-size: 0.95rem; }

    .timeline-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin: 0.5rem 0 0.3rem;
    }

    .timeline-steps::before {
        content: '';
        position: absolute;
        top: 22px;
        left: 40px;
        right: 40px;
        height: 3px;
        background: var(--bg-input);
        z-index: 1;
        border-radius: 2px;
    }

    .timeline-steps::after {
        content: '';
        position: absolute;
        top: 22px;
        left: 40px;
        height: 3px;
        width: var(--progress, 0%);
        background: var(--success);
        z-index: 1;
        border-radius: 2px;
        transition: width 0.4s ease;
    }

    .timeline-step {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        text-align: center;
    }

    .step-circle {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: var(--bg-card);
        border: 3px solid var(--border-color);
        color: var(--text-muted);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        margin-bottom: 0.7rem;
        transition: all var(--transition-speed);
    }

    .timeline-step.completed .step-circle {
        background: var(--success);
        border-color: var(--success);
        color: #FFFFFF;
    }

    .step-label {
        font-size: 0.76rem;
        font-weight: 600;
        color: var(--text-muted);
        max-width: 90px;
        line-height: 1.3;
        transition: all var(--transition-speed);
    }

    .timeline-step.completed .step-label {
        color: var(--text-primary);
        font-weight: 700;
    }

    /* --- DETAIL LIST (rincian pengiriman) --- */
    .detail-card-title {
        font-family: var(--font-heading);
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1.1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .detail-card-title i { color: var(--primary-orange); font-size: 0.9rem; }

    .detail-list { display: flex; flex-direction: column; gap: 0.85rem; }

    .detail-row {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 0.85rem;
    }

    .detail-row i {
        width: 18px;
        text-align: center;
        color: var(--text-muted);
        font-size: 0.8rem;
        margin-top: 2px;
        flex-shrink: 0;
    }

    .detail-row-label {
        color: var(--text-muted);
        display: block;
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.02em;
        margin-bottom: 1px;
    }

    .detail-row-value {
        color: var(--text-primary);
        font-weight: 600;
        line-height: 1.4;
    }

    .detail-note {
        margin-top: 0.3rem;
        background: var(--bg-input);
        padding: 10px 12px;
        border-radius: var(--radius-sm);
        border-left: 3px solid var(--primary-orange);
        font-size: 0.82rem;
        color: var(--text-secondary);
    }
    .detail-note strong { color: var(--text-primary); }

    /* --- MAP & LOCATION SECTION --- */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.3rem;
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
        .timeline-steps {
            flex-direction: column;
            gap: 1.3rem;
        }
        .timeline-steps::before,
        .timeline-steps::after {
            display: none;
        }
        .step-label { max-width: none; }
    }

    .map-container {
        border-radius: var(--radius-md);
        overflow: hidden;
        border: 1px solid var(--border-color);
        height: 220px;
    }

    .map-hint {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-bottom: 10px;
    }

    /* --- BANNER PELUNASAN DP --- */
    .settlement-banner {
        background: var(--primary-orange-light);
        border: 1px solid var(--primary-orange);
        border-radius: var(--radius-lg);
        padding: 1.2rem 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .settlement-banner-ic {
        width: 40px; height: 40px; border-radius: 50%; flex-shrink: 0;
        background: var(--bg-card);
        color: var(--primary-orange);
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem;
    }

    .settlement-banner-text { flex: 1; min-width: 200px; }

    .settlement-banner-text h4 {
        font-family: var(--font-heading);
        color: var(--text-primary);
        font-size: 0.98rem;
        font-weight: 700;
        margin-bottom: 3px;
    }

    .settlement-banner-text p {
        color: var(--text-secondary);
        font-size: 0.85rem;
        margin: 0;
        line-height: 1.5;
    }

    .settlement-banner-text strong {
        color: var(--primary-orange);
    }
</style>
@section('content')

<div class="tracking-wrapper">
    <!-- SUCCESS CREATIVE HERO -->
    <div class="success-hero">
        <div class="success-icon">
            <i class="fa-solid fa-calendar-check"></i>
        </div>
        <h1 class="creative-title">Tanggal Acara Berhasil Diamankan!</h1>
        <p class="creative-subtitle">
            Terima kasih! Pesanan katering Anda dengan Kode Booking <strong>{{ $order->order_code }}</strong> untuk tanggal <strong>{{ \Carbon\Carbon::parse($order->event_date)->format('d F Y') }}</strong> sudah tercatat resmi di jadwal dapur kami.
        </p>
    </div>

    <!-- BANNER PELUNASAN (hanya tampil kalau order pakai DP dan belum lunas) -->
    @if($order->needsSettlement())
        <div class="settlement-banner">
            <div class="settlement-banner-ic"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div class="settlement-banner-text">
                <h4>Sisa Pembayaran Belum Dilunasi</h4>
                <p>
                    Pesanan Anda pakai skema DP 50%. Sisa tagihan <strong>Rp {{ number_format($order->remaining_amount, 0, ',', '.') }}</strong> wajib dilunasi
                    sebelum pesanan bisa diproses ke tahap {{ $order->delivery_type === 'delivery' ? 'diantar ke lokasi' : 'siap diambil' }}.
                </p>
            </div>
            <a href="{{ route('order.settlement', $order->order_code) }}" class="btn-primary" style="padding: 11px 20px; white-space: nowrap;">
                <i class="fa-solid fa-hand-holding-dollar"></i> Lunasi Sekarang
            </a>
        </div>
    @endif

    <!-- TRACKING TIMELINE -->
    <div class="timeline-card">
        <h3 class="timeline-header"><i class="fa-solid fa-truck-fast"></i> Timeline Status Katering Anda</h3>

        @php
            $statuses = ['booking_received', 'payment_verified', 'kitchen_prep', 'ready'];
            $currentIndex = array_search($order->tracking_status, $statuses);
            $progressPct = $currentIndex > 0 ? ($currentIndex / (count($statuses) - 1)) * 100 : 0;
        @endphp

        <div class="timeline-steps" style="--progress: {{ $progressPct }}%;">
            <div class="timeline-step {{ $currentIndex >= 0 ? 'completed' : '' }}">
                <div class="step-circle"><i class="fa-solid fa-file-invoice"></i></div>
                <div class="step-label">Booking Diterima</div>
            </div>

            <div class="timeline-step {{ $currentIndex >= 1 ? 'completed' : '' }}">
                <div class="step-circle"><i class="fa-solid fa-circle-check"></i></div>
                <div class="step-label">Pembayaran Diverifikasi</div>
            </div>

            <div class="timeline-step {{ $currentIndex >= 2 ? 'completed' : '' }}">
                <div class="step-circle"><i class="fa-solid fa-kitchen-set"></i></div>
                <div class="step-label">Persiapan Dapur</div>
            </div>

            <div class="timeline-step {{ $currentIndex >= 3 ? 'completed' : '' }}">
                <div class="step-circle"><i class="fa-solid fa-box-open"></i></div>
                <div class="step-label">Pesanan Siap</div>
            </div>
        </div>
    </div>

    <!-- DETAIL INFORMASI & GOOGLE MAPS IFRAME -->
    <div class="info-grid">
        <div class="timeline-card">
            <h4 class="detail-card-title"><i class="fa-solid fa-circle-info"></i> Rincian Pengiriman</h4>
            <div class="detail-list">
                <div class="detail-row">
                    <i class="fa-solid fa-user"></i>
                    <div>
                        <span class="detail-row-label">Nama Pemesan</span>
                        <span class="detail-row-value">{{ $order->customer_name }}</span>
                    </div>
                </div>
                <div class="detail-row">
                    <i class="fa-brands fa-whatsapp"></i>
                    <div>
                        <span class="detail-row-label">No. WhatsApp</span>
                        <span class="detail-row-value">{{ $order->customer_phone }}</span>
                    </div>
                </div>
                <div class="detail-row">
                    <i class="fa-solid fa-truck"></i>
                    <div>
                        <span class="detail-row-label">Tipe Layanan</span>
                        <span class="detail-row-value">{{ strtoupper($order->delivery_type) }}</span>
                    </div>
                </div>
                @if($order->delivery_type === 'delivery')
                    <div class="detail-row">
                        <i class="fa-solid fa-location-dot"></i>
                        <div>
                            <span class="detail-row-label">Alamat Pengiriman</span>
                            <span class="detail-row-value">{{ $order->shipping_address }}@if($order->kecamatan), Kec. {{ $order->kecamatan }}, Kota Semarang @endif</span>
                        </div>
                    </div>
                    @if($order->latitude && $order->longitude)
                        <div class="map-container" style="margin-top: 4px;">
                            <iframe
                                src="https://maps.google.com/maps?q={{ $order->latitude }},{{ $order->longitude }}&z=16&output=embed"
                                width="100%" height="100%" style="border:0;" loading="lazy"
                                title="Titik Lokasi Pengiriman Anda">
                            </iframe>
                        </div>
                    @endif
                @endif
                @if($order->special_notes)
                    <div class="detail-note">
                        <strong>Catatan Khusus:</strong> {{ $order->special_notes }}
                    </div>
                @endif
            </div>
        </div>

        <!-- GOOGLE MAPS LOKASI ASLI DAPUR UTAMA KHASANAH CATERING -->
        <div class="timeline-card">
            <h4 class="detail-card-title"><i class="fa-solid fa-map-location-dot"></i> Lokasi Dapur Utama</h4>
            <p class="map-hint">Gunakan rute peta berikut jika Anda memilih metode <strong>Pickup Mandiri</strong>:</p>

            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.772166812846!2d110.41786577356733!3d-7.036042168933794!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b002d88a383%3A0x3c9885040241826a!2skhasana%20catering!5e0!3m2!1sid!2sid!4v1786243891259!5m2!1sid!2sid"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="strict-origin-when-cross-origin">
                </iframe>
            </div>
        </div>
    </div>
</div>

@endsection
