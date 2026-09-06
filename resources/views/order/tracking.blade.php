@extends('layouts.app')

@section('title', 'Status Booking - ' . $order->order_code)

@section('styles')
<style>
    .tracking-wrapper {
        max-width: 950px;
        margin: 3rem auto;
        padding: 0 1.5rem;
    }

    .success-hero {
        background: rgba(34, 197, 94, 0.12);
        border: 1px solid var(--success);
        border-radius: var(--radius-lg);
        padding: 2.5rem;
        text-align: center;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-soft);
    }

    .success-icon {
        width: 80px;
        height: 80px;
        background: var(--success);
        color: var(--text-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        margin: 0 auto 1.2rem;
        box-shadow: 0 0 25px rgba(34, 197, 94, 0.4);
    }

    .creative-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--success);
        margin-bottom: 0.5rem;
    }

    .creative-subtitle {
        color: var(--text-secondary);
        font-size: 1rem;
    }

    /* --- TRACKING TIMELINE --- */
    .timeline-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-soft);
    }

    .timeline-header {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 2rem;
        text-align: center;
    }

    .timeline-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin: 2rem 0;
    }

    .timeline-steps::before {
        content: '';
        position: absolute;
        top: 25px;
        left: 40px;
        right: 40px;
        height: 4px;
        background: var(--bg-input);
        z-index: 1;
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
        width: 54px;
        height: 54px;
        border-radius: 50%;
        background: var(--bg-input);
        border: 3px solid var(--border-color);
        color: var(--text-secondary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin-bottom: 0.8rem;
        transition: all var(--transition-speed);
    }

    .timeline-step.completed .step-circle {
        background: var(--success);
        border-color: var(--success);
        color: var(--text-primary);
        box-shadow: 0 0 20px rgba(34, 197, 94, 0.4);
    }

    .step-label {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--text-secondary);
        transition: all var(--transition-speed);
    }

    .timeline-step.completed .step-label {
        color: var(--text-primary);
    }

    /* --- MAP & LOCATION SECTION --- */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
        .timeline-steps {
            flex-direction: column;
            gap: 1.5rem;
        }
        .timeline-steps::before {
            display: none;
        }
    }

    .map-container {
        border-radius: var(--radius-md);
        overflow: hidden;
        border: 1px solid var(--border-color);
        height: 250px;
    }

    /* --- BANNER PELUNASAN DP --- */
    .settlement-banner {
        background: rgba(234, 88, 12, 0.10);
        border: 1px solid var(--primary-orange);
        border-radius: var(--radius-lg);
        padding: 1.5rem 2rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
        box-shadow: var(--shadow-soft);
    }

    .settlement-banner-text h4 {
        color: var(--primary-orange);
        font-size: 1.1rem;
        margin-bottom: 4px;
    }

    .settlement-banner-text p {
        color: var(--text-secondary);
        font-size: 0.9rem;
        margin: 0;
    }

    .settlement-banner-text strong {
        color: var(--text-primary);
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
            <div class="settlement-banner-text">
                <h4><i class="fa-solid fa-triangle-exclamation"></i> Sisa Pembayaran Belum Dilunasi</h4>
                <p>
                    Pesanan Anda pakai skema DP 50%. Sisa tagihan <strong>Rp {{ number_format($order->remaining_amount, 0, ',', '.') }}</strong> wajib dilunasi
                    sebelum pesanan bisa diproses ke tahap {{ $order->delivery_type === 'delivery' ? 'diantar ke lokasi' : 'siap diambil' }}.
                </p>
            </div>
            <a href="{{ route('order.settlement', $order->order_code) }}" class="btn-primary" style="padding: 12px 22px; white-space: nowrap;">
                <i class="fa-solid fa-hand-holding-dollar"></i> Lunasi Sekarang
            </a>
        </div>
    @endif

    <!-- TRACKING TIMELINE -->
    <div class="timeline-card">
        <h3 class="timeline-header"><i class="fa-solid fa-truck-fast" style="color: var(--primary-orange);"></i> Timeline Status Katering Anda</h3>

        @php
            $statuses = ['booking_received', 'payment_verified', 'kitchen_prep', 'ready'];
            $currentIndex = array_search($order->tracking_status, $statuses);
        @endphp

        <div class="timeline-steps">
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
                <div class="step-label">Pesanan Siap (Dikirim/Pickup)</div>
            </div>
        </div>
    </div>

    <!-- DETAIL INFORMASI & GOOGLE MAPS IFRAME -->
    <div class="info-grid">
        <div class="timeline-card">
            <h4 style="margin-bottom: 1rem; color: var(--primary-orange);"><i class="fa-solid fa-info-circle"></i> Rincian Pengiriman</h4>
            <p><strong>Nama Pemesan:</strong> {{ $order->customer_name }}</p>
            <p><strong>No. WhatsApp:</strong> {{ $order->customer_phone }}</p>
            <p><strong>Tipe Layanan:</strong> {{ strtoupper($order->delivery_type) }}</p>
            @if($order->delivery_type === 'delivery')
                <p><strong>Alamat Pengiriman:</strong> {{ $order->shipping_address }}@if($order->kecamatan), Kec. {{ $order->kecamatan }}, Kota Semarang @endif</p>
                @if($order->latitude && $order->longitude)
                    <div class="map-container" style="margin-top: 10px;">
                        <iframe
                            src="https://maps.google.com/maps?q={{ $order->latitude }},{{ $order->longitude }}&z=16&output=embed"
                            width="100%" height="100%" style="border:0;" loading="lazy"
                            title="Titik Lokasi Pengiriman Anda">
                        </iframe>
                    </div>
                @endif
            @endif
            @if($order->special_notes)
                <div style="margin-top: 1rem; background: var(--bg-input); padding: 10px; border-radius: 6px; border-left: 3px solid var(--primary-orange);">
                    <strong>Catatan Khusus:</strong><br>
                    <small>{{ $order->special_notes }}</small>
                </div>
            @endif
        </div>

        <!-- GOOGLE MAPS LOKASI ASLI DAPUR UTAMA KHASANAH CATERING -->
        <div class="timeline-card">
            <h4 style="margin-bottom: 0.8rem; color: var(--primary-orange);"><i class="fa-solid fa-map-location-dot"></i> Lokasi Dapur Utama Khasanah Catering</h4>
            <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 10px;">Gunakan rute peta berikut jika Anda memilih metode <strong>Pickup Mandiri</strong>:</p>
            
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
