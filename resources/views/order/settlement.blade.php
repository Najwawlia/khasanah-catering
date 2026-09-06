@extends('layouts.app')

@section('title', 'Pelunasan Pembayaran - ' . $order->order_code)

@section('styles')
<style>
    .payment-wrapper {
        max-width: 800px;
        margin: 3rem auto;
        padding: 0 1.5rem;
    }

    .payment-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 2.5rem;
        box-shadow: var(--shadow-soft);
        text-align: center;
    }

    .order-badge {
        display: inline-block;
        background: rgba(255, 107, 0, 0.15);
        color: var(--primary-orange);
        border: 1px solid var(--primary-orange);
        padding: 6px 16px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .payment-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .payment-amount-box {
        background: var(--bg-input);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        padding: 1.5rem;
        margin: 1.5rem 0 2rem;
    }

    .amount-label {
        font-size: 0.9rem;
        color: var(--text-secondary);
        margin-bottom: 4px;
    }

    .amount-val {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--primary-orange);
    }

    .breakdown-box {
        background: var(--bg-input);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        padding: 1.2rem 1.5rem;
        margin: 1.5rem 0;
        text-align: left;
    }

    .breakdown-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.9rem;
        padding: 6px 0;
    }

    .breakdown-row.total {
        border-top: 1px dashed var(--border-color);
        margin-top: 6px;
        padding-top: 12px;
        font-weight: 800;
        color: var(--primary-orange);
    }

    .qris-box {
        background: #FFFFFF;
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        padding: 1.5rem;
        display: inline-block;
        margin: 1.5rem 0;
        box-shadow: var(--shadow-soft);
    }

    .qris-img {
        width: 220px;
        height: 220px;
        object-fit: contain;
    }

    .bank-account-box {
        background: var(--bg-input);
        border: 1px dashed var(--primary-orange);
        border-radius: var(--radius-md);
        padding: 1.2rem;
        margin: 1.5rem 0;
        text-align: left;
        color: var(--text-primary);
    }
</style>
@section('content')

<div class="payment-wrapper">
    <div class="payment-card">
        <div class="order-badge">
            <i class="fa-solid fa-ticket"></i> Kode Pesanan: {{ $order->order_code }}
        </div>

        <h2 class="payment-title"><i class="fa-solid fa-hand-holding-dollar" style="color: var(--primary-orange);"></i> Pelunasan Sisa Pembayaran</h2>
        <p style="color: var(--text-muted);">
            DP Anda sudah kami terima. Untuk melanjutkan pesanan ke tahap pengiriman/pengambilan, mohon lunasi sisa tagihan berikut sebelum tanggal acara <strong>{{ \Carbon\Carbon::parse($order->event_date)->format('d F Y') }}</strong>.
        </p>

        <div class="breakdown-box">
            <div class="breakdown-row">
                <span>Total Tagihan Pesanan</span>
                <strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
            </div>
            <div class="breakdown-row">
                <span>Sudah Dibayar (DP)</span>
                <strong style="color: var(--success, #22C55E);">Rp {{ number_format($order->paid_amount, 0, ',', '.') }}</strong>
            </div>
            <div class="breakdown-row total">
                <span>Sisa yang Wajib Dilunasi</span>
                <span>Rp {{ number_format($order->remaining_amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- OPSI TAMPILAN BERDASARKAN METODE PEMBAYARAN AWAL -->
        @if($order->payment_method === 'qris')
            <h4 style="margin-bottom: 0.5rem;"><i class="fa-solid fa-qrcode" style="color: var(--primary-orange);"></i> Scan Barcode QRIS di Bawah Ini:</h4>
            <p style="font-size: 0.85rem; color: var(--text-muted);">Buka aplikasi GoPay, OVO, Dana, ShopeePay, atau Mobile Banking pilihan Anda.</p>

            <div class="qris-box">
                <img src="{{ asset('images/qris-khasanah-catering.jpeg') }}" alt="QRIS Khasanah Snack N Nasi Box" class="qris-img" style="width: 260px; height: auto; object-fit: contain;">
                <div style="color: #111; font-weight: 800; font-size: 0.85rem; margin-top: 8px;">NMID: ID1026487951174 — KHASANAH SNACK N NASI BOX, BNYMNK</div>
            </div>
        @elseif(in_array($order->payment_method, ['bca', 'mandiri', 'bri']))
            <div class="bank-account-box">
                <div style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 6px;">Transfer Sisa Tagihan ke Rekening Bank Official:</div>
                <div style="font-size: 1.3rem; font-weight: 800; color: var(--primary-orange);">
                    BANK {{ strtoupper($order->payment_method) }}: 8830-1234-9988
                </div>
                <div style="font-weight: 600; color: var(--text-main); margin-top: 4px;">a.n. PT Katering Khasanah Indonesia</div>
            </div>
        @else
            <div class="bank-account-box">
                <div style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 6px;">Nomor E-Wallet Official:</div>
                <div style="font-size: 1.3rem; font-weight: 800; color: var(--primary-orange);">
                    {{ strtoupper($order->payment_method) }}: 0812-3456-7890
                </div>
                <div style="font-weight: 600; color: var(--text-main); margin-top: 4px;">a.n. Khasanah Catering Official Store</div>
            </div>
        @endif

        <form action="{{ route('order.settlement.confirm', $order->order_code) }}" method="POST" style="margin-top: 2rem;">
            @csrf
            <button type="submit" class="btn-primary" style="width: 100%; padding: 14px; font-size: 1.1rem;">
                <i class="fa-solid fa-circle-check"></i> Konfirmasi Pelunasan
            </button>
        </form>

        <a href="{{ route('order.tracking', $order->order_code) }}" style="display:block; margin-top: 1rem; color: var(--text-muted); font-size: 0.85rem;">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Status Booking
        </a>
    </div>
</div>

@endsection
