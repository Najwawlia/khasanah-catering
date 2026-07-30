@extends('layouts.app')

@section('title', 'Checkout Form - KhaCate Catering')

@section('styles')
<style>
    .checkout-wrapper {
        max-width: 1100px;
        margin: 3rem auto;
        padding: 0 1.5rem;
    }

    .checkout-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .checkout-title i {
        color: var(--primary-orange);
    }

    .checkout-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    @media (max-width: 900px) {
        .checkout-grid {
            grid-template-columns: 1fr;
        }
    }

    .card-section {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 2rem;
        margin-bottom: 1.8rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }

    .section-header {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--text-primary);
        padding-bottom: 0.8rem;
        border-bottom: 1px solid var(--border-color);
    }

    .section-header i {
        color: var(--primary-orange);
    }

    .form-group {
        margin-bottom: 1.4rem;
    }

    .form-group label {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 6px;
        color: var(--text-primary);
    }

    .form-input, .form-textarea, .form-select {
        width: 100%;
        background: var(--bg-input);
        border: 1px solid var(--border-color);
        color: var(--text-primary);
        padding: 12px 16px;
        border-radius: var(--radius-md);
        font-size: 0.95rem;
        outline: none;
        transition: all var(--transition-speed);
    }

    .form-input::placeholder, .form-textarea::placeholder {
        color: var(--text-secondary);
    }

    .form-input:focus, .form-textarea:focus, .form-select:focus {
        border-color: var(--primary-orange);
        box-shadow: 0 0 12px var(--primary-glow);
    }

    /* --- PAYMENT METHOD SELECTOR CARDS --- */
    .payment-options-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
        gap: 1rem;
    }

    .payment-option-card {
        background: var(--bg-input);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-md);
        padding: 1rem;
        text-align: center;
        cursor: pointer;
        transition: all var(--transition-speed);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: var(--text-secondary);
    }

    .payment-option-card:hover, .payment-option-card.selected {
        border-color: var(--primary-orange);
        background: rgba(255, 102, 0, 0.1);
        color: var(--text-primary);
        box-shadow: 0 0 15px var(--primary-glow);
    }

    .payment-option-card input[type="radio"] {
        display: none;
    }

    .payment-icon {
        font-size: 1.6rem;
        color: var(--primary-orange);
    }

    /* --- DP TYPE TOGGLE CARDS --- */
    .dp-toggle-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .dp-card {
        background: var(--bg-input);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-md);
        padding: 1.2rem;
        cursor: pointer;
        transition: all var(--transition-speed);
    }

    .dp-card:hover, .dp-card.selected {
        border-color: var(--primary-orange);
        background: rgba(255, 102, 0, 0.12);
        box-shadow: 0 0 15px var(--primary-glow);
    }

    .dp-card input[type="radio"] {
        display: none;
    }

    .dp-card-title {
        font-weight: 800;
        font-size: 1.05rem;
        margin-bottom: 4px;
        color: var(--text-primary);
    }

    .dp-card-desc {
        font-size: 0.85rem;
        color: var(--text-secondary);
    }

    .dp-card-amount {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--primary-orange);
        margin-top: 8px;
    }
</style>
@section('content')

<div class="checkout-wrapper">
    <h1 class="checkout-title">
        <i class="fa-solid fa-clipboard-check"></i> Form Booking & Tanggal Acara
    </h1>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        <div class="checkout-grid">
            <!-- LEFT FORM -->
            <div>
                <!-- 1. DATA PEMESAN & TANGGAL ACARA -->
                <div class="card-section">
                    <h3 class="section-header">
                        <i class="fa-solid fa-user-gear"></i> Informasi Pemesan & Tanggal Acara
                    </h3>

                    <div class="form-group">
                        <label for="customer_name">Nama Lengkap Pemesan</label>
                        <input type="text" name="customer_name" id="customer_name" class="form-input" 
                               value="{{ old('customer_name', $user ? $user->name : '') }}" required>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label for="customer_phone">Nomor WhatsApp / HP</label>
                            <input type="text" name="customer_phone" id="customer_phone" class="form-input" 
                                   value="{{ old('customer_phone', $user ? $user->phone : '') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="customer_email">Alamat Email</label>
                            <input type="email" name="customer_email" id="customer_email" class="form-input" 
                                   value="{{ old('customer_email', $user ? $user->email : '') }}" required>
                        </div>
                    </div>

                    <!-- DATE PICKER TANGGAL ACARA -->
                    <div class="form-group">
                        <label for="event_date">
                            <i class="fa-solid fa-calendar-days" style="color: var(--primary-orange);"></i> 
                            Pilih Tanggal Pelaksanaan Acara
                        </label>
                        <input type="date" name="event_date" id="event_date" class="form-input" 
                               min="{{ date('Y-m-d') }}" value="{{ old('event_date') }}" required>
                        <small style="color: var(--text-muted); margin-top: 4px; display: block;">
                            *Tanggal acara Anda akan otomatis kami lock di kalender dapur kami setelah pembayaran terverifikasi.
                        </small>
                    </div>
                </div>

                <!-- 2. PENGIRIMAN & CATATAN KHUSUS -->
                <div class="card-section">
                    <h3 class="section-header">
                        <i class="fa-solid fa-truck-ramp-box"></i> Metode Pengiriman & Catatan Khusus
                    </h3>

                    <div class="form-group">
                        <label for="delivery_type">Tipe Layanan</label>
                        <select name="delivery_type" id="delivery_type" class="form-select" onchange="toggleAddress(this.value)">
                            <option value="delivery">Diantar ke Lokasi Acara (Delivery)</option>
                            <option value="pickup">Ambil Mandiri di Dapur Utama (Pickup)</option>
                        </select>
                    </div>

                    <div class="form-group" id="addressGroup">
                        <label for="shipping_address">Alamat Pengiriman Lengkap (Lokasi Acara)</label>
                        <textarea name="shipping_address" id="shipping_address" rows="3" class="form-textarea" placeholder="Tuliskan alamat gedung / rumah acara lengkap beserta patokan...">{{ old('shipping_address') }}</textarea>
                    </div>

                    <!-- TEXTAREA CATATAN KHUSUS / DIETARY NOTES -->
                    <div class="form-group">
                        <label for="special_notes">
                            <i class="fa-solid fa-note-sticky" style="color: var(--primary-orange);"></i> 
                            Special Requests / Dietary Notes (Catatan Khusus)
                        </label>
                        <textarea name="special_notes" id="special_notes" rows="3" class="form-textarea" 
                                  placeholder="Contoh: 65 porsi tanpa pedas, masakan tidak menggunakan santan, pisahkan sambal, dll.">{{ old('special_notes') }}</textarea>
                    </div>
                </div>

                <!-- 3. PILIHAN JADWAL PEMBAYARAN (DP 50% vs FULL) -->
                <div class="card-section">
                    <h3 class="section-header">
                        <i class="fa-solid fa-coins"></i> Opsi Pembayaran (Down Payment 50% / Lunas)
                    </h3>

                    <div class="dp-toggle-grid">
                        <label class="dp-card selected" id="cardDp50" onclick="selectDp('dp_50')">
                            <input type="radio" name="payment_type" value="dp_50" checked>
                            <div class="dp-card-title"><i class="fa-solid fa-percent"></i> Down Payment (DP 50%)</div>
                            <div class="dp-card-desc">Amankan tanggal acara dengan bayar 50% terlebih dahulu. Sisanya dibayar H-1 acara.</div>
                            <div class="dp-card-amount">Rp {{ number_format($dp50Amount, 0, ',', '.') }}</div>
                        </label>

                        <label class="dp-card" id="cardFull" onclick="selectDp('full')">
                            <input type="radio" name="payment_type" value="full">
                            <div class="dp-card-title"><i class="fa-solid fa-money-bill-wave"></i> Bayar Penuh (100%)</div>
                            <div class="dp-card-desc">Pelunasan langsung saat checkout untuk kemudahan dan kenyamanan transaksi.</div>
                            <div class="dp-card-amount">Rp {{ number_format($totalAmount, 0, ',', '.') }}</div>
                        </label>
                    </div>
                </div>

                <!-- 4. METODE PEMBAYARAN -->
                <div class="card-section">
                    <h3 class="section-header">
                        <i class="fa-solid fa-wallet"></i> Metode Pembayaran
                    </h3>

                    <div class="payment-options-grid">
                        <label class="payment-option-card selected" id="pay_qris" onclick="selectPaymentMethod('qris')">
                            <input type="radio" name="payment_method" value="qris" checked>
                            <i class="fa-solid fa-qrcode payment-icon"></i>
                            <span style="font-weight: 700; font-size: 0.9rem;">QRIS</span>
                        </label>

                        <label class="payment-option-card" id="pay_gopay" onclick="selectPaymentMethod('gopay')">
                            <input type="radio" name="payment_method" value="gopay">
                            <i class="fa-solid fa-mobile-screen-button payment-icon"></i>
                            <span style="font-weight: 700; font-size: 0.9rem;">GoPay</span>
                        </label>

                        <label class="payment-option-card" id="pay_ovo" onclick="selectPaymentMethod('ovo')">
                            <input type="radio" name="payment_method" value="ovo">
                            <i class="fa-solid fa-wallet payment-icon"></i>
                            <span style="font-weight: 700; font-size: 0.9rem;">OVO</span>
                        </label>

                        <label class="payment-option-card" id="pay_bca" onclick="selectPaymentMethod('bca')">
                            <input type="radio" name="payment_method" value="bca">
                            <i class="fa-solid fa-building-columns payment-icon"></i>
                            <span style="font-weight: 700; font-size: 0.9rem;">Bank BCA</span>
                        </label>

                        <label class="payment-option-card" id="pay_mandiri" onclick="selectPaymentMethod('mandiri')">
                            <input type="radio" name="payment_method" value="mandiri">
                            <i class="fa-solid fa-building-columns payment-icon"></i>
                            <span style="font-weight: 700; font-size: 0.9rem;">Mandiri</span>
                        </label>

                        <label class="payment-option-card" id="pay_bri" onclick="selectPaymentMethod('bri')">
                            <input type="radio" name="payment_method" value="bri">
                            <i class="fa-solid fa-building-columns payment-icon"></i>
                            <span style="font-weight: 700; font-size: 0.9rem;">Bank BRI</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- RIGHT SUMMARY -->
            <div>
                <div class="card-section" style="position: sticky; top: 100px;">
                    <h3 class="section-header">
                        <i class="fa-solid fa-receipt"></i> Rincian Pesanan
                    </h3>

                    @foreach($cart as $item)
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.8rem; font-size: 0.9rem;">
                            <div>
                                <strong>{{ $item['name'] }}</strong><br>
                                <small style="color: var(--text-muted);">{{ $item['pax_quantity'] }} pax x Rp {{ number_format($item['price'], 0, ',', '.') }}</small>
                            </div>
                            <div style="font-weight: 700; color: var(--text-main);">
                                Rp {{ number_format($item['price'] * $item['pax_quantity'], 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach

                    <hr style="border: none; border-top: 1px dashed var(--border-color); margin: 1.2rem 0;">

                    <div style="display: flex; justify-content: space-between; font-size: 1.2rem; font-weight: 800; margin-bottom: 1.5rem;">
                        <span>Total Tagihan:</span>
                        <span style="color: var(--primary-orange);">Rp {{ number_format($totalAmount, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" class="btn-primary" style="width: 100%; padding: 14px;">
                        <i class="fa-solid fa-lock"></i> Konfirmasi Booking Now
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>
    function toggleAddress(val) {
        const addressGroup = document.getElementById('addressGroup');
        if (val === 'pickup') {
            addressGroup.style.display = 'none';
        } else {
            addressGroup.style.display = 'block';
        }
    }

    function selectDp(type) {
        document.getElementById('cardDp50').classList.remove('selected');
        document.getElementById('cardFull').classList.remove('selected');

        if (type === 'dp_50') {
            document.getElementById('cardDp50').classList.add('selected');
        } else {
            document.getElementById('cardFull').classList.add('selected');
        }
    }

    function selectPaymentMethod(method) {
        const cards = document.querySelectorAll('.payment-option-card');
        cards.forEach(card => card.classList.remove('selected'));
        document.getElementById('pay_' + method).classList.add('selected');
    }
</script>
@endsection
