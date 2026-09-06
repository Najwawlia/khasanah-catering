@extends('layouts.app')

@section('title', 'Checkout Form - Khasanah Catering')

@section('styles')
<style>
    .checkout-hero {
        background: linear-gradient(135deg, var(--charcoal) 0%, #4A3420 100%);
        padding: 2.4rem 1.5rem;
        margin-bottom: -1px;
    }

    .checkout-hero-inner {
        max-width: 1100px;
        margin: 0 auto;
    }

    .checkout-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--secondary-gold);
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 0.4px;
        text-transform: uppercase;
        margin-bottom: 0.6rem;
    }

    .checkout-title {
        font-family: var(--font-heading);
        font-size: 2.4rem;
        font-weight: 700;
        color: #FFFFFF;
        margin-bottom: 0.4rem;
    }

    .checkout-subtitle {
        color: rgba(255,255,255,0.75);
        font-size: 0.98rem;
    }

    .checkout-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        padding: 2.5rem 1.5rem 3rem;
    }

    .checkout-grid {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: 2rem;
        align-items: start;
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
        padding: 1.8rem;
        margin-bottom: 1.6rem;
        box-shadow: var(--shadow-soft);
        transition: box-shadow var(--transition-speed);
    }

    @media (max-width: 640px) {
        .card-section { padding: 1.3rem; border-radius: var(--radius-md); }
    }

    .section-header {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--text-primary);
        padding-bottom: 0.9rem;
        border-bottom: 1px solid var(--border-color);
    }

    .section-icon-badge {
        width: 38px;
        height: 38px;
        min-width: 38px;
        border-radius: 10px;
        background: var(--primary-orange-light);
        color: var(--primary-orange-hover);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
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
        border-color: var(--tertiary-coral-dark);
        background: var(--tertiary-coral-light);
        color: var(--text-primary);
        box-shadow: 0 0 15px rgba(255, 138, 117, 0.35);
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
        border-color: var(--secondary-gold-dark);
        background: var(--secondary-gold-light);
        box-shadow: 0 0 15px rgba(255, 215, 0, 0.35);
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

    /* --- ORDER SUMMARY --- */
    .order-summary-card {
        position: sticky;
        top: 100px;
    }

    @media (max-width: 900px) {
        .order-summary-card {
            position: static;
        }
    }

    .summary-item-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 1rem;
    }

    .summary-item-img {
        width: 52px;
        height: 52px;
        border-radius: var(--radius-sm);
        object-fit: cover;
        flex-shrink: 0;
        border: 1px solid var(--border-color);
    }

    .summary-item-info {
        flex: 1;
        min-width: 0;
    }

    .summary-item-name {
        font-weight: 700;
        font-size: 0.92rem;
        color: var(--text-primary);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .summary-item-qty {
        font-size: 0.8rem;
        color: var(--text-secondary);
    }

    .summary-item-price {
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--text-primary);
        white-space: nowrap;
    }

    .secure-note {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        color: var(--text-secondary);
        font-size: 0.8rem;
        margin-top: 0.9rem;
    }

    .secure-note i { color: var(--success); }
</style>
@section('content')

<div class="checkout-hero">
    <div class="checkout-hero-inner">
        <span class="checkout-eyebrow"><i class="fa-solid fa-shield-halved"></i> Secure Checkout</span>
        <h1 class="checkout-title">Form Booking & Tanggal Acara</h1>
        <p class="checkout-subtitle">Lengkapi detail acara Anda untuk pengalaman kuliner yang sempurna.</p>
    </div>
</div>

<div class="checkout-wrapper">
    @if ($errors->any())
        <div style="background: rgba(178,58,58,0.08); border: 1px solid var(--error); border-radius: var(--radius-md); padding: 1rem 1.2rem; margin-bottom: 1.5rem;">
            <div style="display:flex; align-items:center; gap:8px; font-weight:700; color: var(--error); margin-bottom: 6px;">
                <i class="fa-solid fa-triangle-exclamation"></i> Mohon periksa kembali form Anda:
            </div>
            <ul style="margin: 0; padding-left: 1.4rem; color: var(--text-primary); font-size: 0.9rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        <div class="checkout-grid">
            <!-- LEFT FORM -->
            <div>
                <!-- 1. DATA PEMESAN & TANGGAL ACARA -->
                <div class="card-section">
                    <h3 class="section-header">
                        <span class="section-icon-badge"><i class="fa-solid fa-user-gear"></i></span> Informasi Pemesan & Tanggal Acara
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
                               min="{{ $minEventDate }}" value="{{ old('event_date') }}" required>
                        <small style="color: var(--text-muted); margin-top: 4px; display: block;">
                            <i class="fa-solid fa-circle-info"></i> Pemesanan katering minimal <strong>3 hari sebelum acara</strong> (kami tidak melayani pesanan mendadak/dadakan) agar bahan & persiapan dapur maksimal.
                        </small>
                    </div>
                </div>

                <!-- 2. PENGIRIMAN & CATATAN KHUSUS -->
                <div class="card-section">
                    <h3 class="section-header">
                        <span class="section-icon-badge" style="background: var(--tertiary-coral-light); color: var(--tertiary-coral-dark);"><i class="fa-solid fa-truck-ramp-box"></i></span> Metode Pengiriman & Catatan Khusus
                    </h3>

                    <div class="form-group">
                        <label for="delivery_type">Tipe Layanan</label>
                        <select name="delivery_type" id="delivery_type" class="form-select" onchange="toggleAddress(this.value)">
                            <option value="delivery">Diantar ke Lokasi Acara (Delivery)</option>
                            <option value="pickup">Ambil Mandiri di Dapur Utama (Pickup)</option>
                        </select>
                    </div>

                    <div class="form-group" id="addressWrapperGroup">
                        <div style="background: var(--bg-input); border: 1px dashed var(--primary-orange); border-radius: var(--radius-md); padding: 12px 16px; margin-bottom: 1.2rem; display:flex; align-items:flex-start; gap:10px;">
                            <i class="fa-solid fa-location-dot" style="color: var(--primary-orange); margin-top: 2px;"></i>
                            <div style="font-size: 0.85rem; color: var(--text-secondary);">
                                Layanan <strong style="color: var(--text-primary);">antar (delivery)</strong> saat ini hanya kami sediakan untuk wilayah <strong style="color: var(--text-primary);">Kota Semarang</strong>. Kalau lokasi acara di luar Semarang, silakan pilih <strong style="color: var(--text-primary);">Ambil Mandiri di Dapur Utama (Pickup)</strong>.
                            </div>
                        </div>

                        <label>Kota / Kabupaten Tujuan</label>
                        <input type="text" class="form-input" value="Kota Semarang" disabled
                               style="opacity: 0.7; cursor: not-allowed; margin-bottom: 1.2rem;">

                        <label for="kecamatan">Kecamatan</label>
                        <select name="kecamatan" id="kecamatan" class="form-select" style="margin-bottom: 1.2rem;">
                            <option value="">-- Pilih Kecamatan Lokasi Acara --</option>
                            @foreach($kecamatanList as $k)
                                <option value="{{ $k }}" {{ old('kecamatan') === $k ? 'selected' : '' }}>{{ $k }}</option>
                            @endforeach
                        </select>

                        <label for="shipping_address">Alamat Lengkap (Jalan, No. Rumah/Gedung, Patokan)</label>
                        <textarea name="shipping_address" id="shipping_address" rows="3" class="form-textarea" placeholder="Contoh: Jl. Pandanaran No. 12, dekat Lawang Sewu, patokan sebelah toko oleh-oleh...">{{ old('shipping_address') }}</textarea>
                    </div>

                    <!-- PEMILIH TITIK LOKASI DI PETA -->
                    <div class="form-group" id="mapGroup">
                        <label>
                            <i class="fa-solid fa-map-location-dot" style="color: var(--primary-orange);"></i>
                            Titik Lokasi di Peta <span style="font-weight: 400; color: var(--text-muted);">(opsional, memudahkan kurir menemukan lokasi)</span>
                        </label>

                        @if(config('services.google_maps.key'))
                            <input type="text" id="mapSearchInput" class="form-input" placeholder="Cari nama jalan / gedung di Semarang..." style="margin-bottom: 10px;">
                            <div id="gmap" style="width: 100%; height: 260px; border-radius: var(--radius-md); overflow: hidden; border: 1px solid var(--border-color);"></div>
                            <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                            <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
                            <small style="color: var(--text-muted); margin-top: 6px; display: block;">
                                <i class="fa-solid fa-hand-pointer"></i> Geser pin merah ke lokasi yang tepat, atau ketik nama jalan/gedung di kolom pencarian di atas. Peta dikunci di area Kota Semarang.
                            </small>
                        @else
                            <div style="border: 1px solid var(--border-color); border-radius: var(--radius-md); overflow: hidden;">
                                <iframe src="https://maps.google.com/maps?q=Kota+Semarang&z=12&output=embed" width="100%" height="230" style="border:0; display:block;" loading="lazy" title="Peta Kota Semarang"></iframe>
                            </div>
                            <small style="color: var(--text-muted); margin-top: 6px; display: block;">
                                <i class="fa-solid fa-circle-info"></i> Peta pemilih titik lokasi interaktif belum aktif — mohon tuliskan alamat selengkap dan sedetail mungkin di kolom di atas ya.
                            </small>
                        @endif
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
                        <span class="section-icon-badge" style="background: var(--secondary-gold-light); color: var(--secondary-gold-dark);"><i class="fa-solid fa-coins"></i></span> Opsi Pembayaran (Down Payment 50% / Lunas)
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
                        <span class="section-icon-badge"><i class="fa-solid fa-wallet"></i></span> Metode Pembayaran
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
            <div class="order-summary-card">
                <div class="card-section">
                    <h3 class="section-header">
                        <span class="section-icon-badge"><i class="fa-solid fa-receipt"></i></span> Rincian Pesanan
                    </h3>

                    @foreach($cart as $item)
                        <div class="summary-item-row">
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="summary-item-img" onerror="this.src='https://images.unsplash.com/photo-1555244162-803834f70033?w=200'">
                            <div class="summary-item-info">
                                <div class="summary-item-name">{{ $item['name'] }}</div>
                                <div class="summary-item-qty">Qty: {{ $item['pax_quantity'] }} pack</div>
                            </div>
                            <div class="summary-item-price">Rp {{ number_format($item['price'] * $item['pax_quantity'], 0, ',', '.') }}</div>
                        </div>
                    @endforeach

                    <hr style="border: none; border-top: 1px dashed var(--border-color); margin: 1.2rem 0;">

                    <div style="display: flex; justify-content: space-between; font-size: 1.3rem; font-weight: 800; margin-bottom: 1.2rem; font-family: var(--font-heading);">
                        <span>Total Tagihan</span>
                        <span style="color: var(--primary-orange);">Rp {{ number_format($totalAmount, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" class="btn-primary" style="width: 100%; padding: 14px;">
                        <i class="fa-solid fa-lock"></i> Konfirmasi Booking Sekarang
                    </button>

                    <div class="secure-note">
                        <i class="fa-solid fa-shield-halved"></i> Data Anda terenkripsi & aman
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>
    function toggleAddress(val) {
        const addressWrapperGroup = document.getElementById('addressWrapperGroup');
        const mapGroup = document.getElementById('mapGroup');
        const display = (val === 'pickup') ? 'none' : 'block';
        addressWrapperGroup.style.display = display;
        mapGroup.style.display = display;
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

@if(config('services.google_maps.key'))
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&callback=initSemarangMap" async defer></script>
<script>
    // Peta pemilih lokasi dikunci di area Kota Semarang: bounds dipakai
    // untuk membatasi pencarian & tampilan peta, bukan sekadar dekorasi.
    var SEMARANG_CENTER = { lat: {{ $mapCenter['lat'] }}, lng: {{ $mapCenter['lng'] }} };
    var SEMARANG_BOUNDS = {
        north: -6.90,
        south: -7.15,
        east: 110.52,
        west: 110.28,
    };

    function initSemarangMap() {
        var mapEl = document.getElementById('gmap');
        if (!mapEl) return;

        var bounds = new google.maps.LatLngBounds(
            { lat: SEMARANG_BOUNDS.south, lng: SEMARANG_BOUNDS.west },
            { lat: SEMARANG_BOUNDS.north, lng: SEMARANG_BOUNDS.east }
        );

        var map = new google.maps.Map(mapEl, {
            center: SEMARANG_CENTER,
            zoom: 12,
            restriction: { latLngBounds: bounds, strictBounds: false },
            streetViewControl: false,
            mapTypeControl: false,
        });

        var latField = document.getElementById('latitude');
        var lngField = document.getElementById('longitude');
        var initialLat = parseFloat(latField.value) || SEMARANG_CENTER.lat;
        var initialLng = parseFloat(lngField.value) || SEMARANG_CENTER.lng;

        var marker = new google.maps.Marker({
            map: map,
            position: { lat: initialLat, lng: initialLng },
            draggable: true,
        });

        function syncFields(pos) {
            latField.value = pos.lat();
            lngField.value = pos.lng();
        }
        syncFields(marker.getPosition());

        marker.addListener('dragend', function () {
            syncFields(marker.getPosition());
        });

        map.addListener('click', function (e) {
            marker.setPosition(e.latLng);
            syncFields(e.latLng);
        });

        var searchInput = document.getElementById('mapSearchInput');
        var autocomplete = new google.maps.places.Autocomplete(searchInput, {
            bounds: bounds,
            strictBounds: true,
            componentRestrictions: { country: 'id' },
            fields: ['geometry', 'name'],
        });

        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            if (!place.geometry || !place.geometry.location) return;
            map.panTo(place.geometry.location);
            map.setZoom(16);
            marker.setPosition(place.geometry.location);
            syncFields(place.geometry.location);
        });
    }
</script>
@endif
@endsection
