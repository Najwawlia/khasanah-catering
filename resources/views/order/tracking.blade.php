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
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
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
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
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
                <p><strong>Alamat Pengiriman:</strong> {{ $order->shipping_address }}</p>
            @endif
            @if($order->special_notes)
                <div style="margin-top: 1rem; background: var(--bg-input); padding: 10px; border-radius: 6px; border-left: 3px solid var(--primary-orange);">
                    <strong>Catatan Khusus:</strong><br>
                    <small>{{ $order->special_notes }}</small>
                </div>
            @endif
        </div>

        <!-- GOOGLE MAPS DUMMY DULUR/DAPUR UTAMA -->
        <div class="timeline-card">
            <h4 style="margin-bottom: 0.8rem; color: var(--primary-orange);"><i class="fa-solid fa-map-location-dot"></i> Lokasi Dapur Utama KhaCate</h4>
            <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 10px;">Gunakan rute peta berikut jika Anda memilih metode <strong>Pickup Mandiri</strong>:</p>
            
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.27361877478!2d106.8249641!3d-6.2276067!2m3!1f0!1f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e46e8b7a97%3A0x6b2e008a0d0a7a0!2sJakarta%20South!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</div>

@endsection
