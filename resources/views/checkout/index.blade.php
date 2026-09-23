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
        box-shadow: 0 0 0 3px var(--primary-orange-light);
    }

    /* --- LOCATION MAP PICKER --- */
    .map-search-wrap {
        position: relative;
        margin-bottom: 10px;
    }
    .map-search-wrap i {
        position: absolute;
        left: 14px; top: 50%; transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 0.85rem;
    }
    .map-search-wrap input { padding-left: 38px; }

    #leafletMap {
        width: 100%;
        height: 260px;
        border-radius: var(--radius-md);
        border: 1px solid var(--border-color);
    }
    .leaflet-pin-hint {
        display: flex;
        align-items: center;
        gap: 6px;
        color: var(--text-muted);
        font-size: 0.8rem;
        margin-top: 6px;
    }
    .leaflet-pin-hint i { color: var(--primary-orange); }

    /* --- PAYMENT METHOD (QRIS only) --- */
    .qris-card {
        display: flex;
        align-items: center;
        gap: 16px;
        background: var(--bg-input);
        border: 2px solid var(--primary-orange);
        border-radius: var(--radius-md);
        padding: 1.2rem 1.4rem;
    }

    .qris-badge {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        background: #FFFFFF;
        border: 1px solid var(--border-color);
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8px;
    }

    .qris-info { flex: 1; min-width: 0; }

    .qris-info-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 800;
        font-size: 1rem;
        color: var(--text-primary);
        margin-bottom: 3px;
    }

    .qris-info-title .qris-check {
        color: var(--success);
        font-size: 0.85rem;
    }

    .qris-info-desc {
        font-size: 0.83rem;
        color: var(--text-secondary);
        line-height: 1.5;
    }

    .qris-apps-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 8px;
        flex-wrap: wrap;
    }

    .qris-apps-row span {
        font-size: 0.68rem;
        font-weight: 700;
        color: var(--text-muted);
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        padding: 2px 9px;
        border-radius: 20px;
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
                            <option value="delivery" {{ old('delivery_type', 'delivery') === 'delivery' ? 'selected' : '' }}>Diantar ke Lokasi Acara (Delivery)</option>
                            <option value="pickup" {{ old('delivery_type') === 'pickup' ? 'selected' : '' }}>Ambil Mandiri di Dapur Utama (Pickup)</option>
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

                        <div class="map-search-wrap">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" id="mapSearchInput" class="form-input" placeholder="Cari nama jalan / gedung di Semarang...">
                        </div>
                        <div id="leafletMap"></div>
                        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
                        <div class="leaflet-pin-hint">
                            <i class="fa-solid fa-hand-pointer"></i> Geser pin merah ke lokasi yang tepat, atau ketik nama jalan/gedung di kolom pencarian. Peta dikunci di area Kota Semarang.
                        </div>
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

                    <div class="qris-card">
                        <div class="qris-badge">
                            <svg viewBox="0 0 40 40" width="40" height="40" xmlns="http://www.w3.org/2000/svg">
                                <rect x="2" y="2" width="14" height="14" rx="2" fill="none" stroke="#E4002B" stroke-width="3"/>
                                <rect x="6" y="6" width="6" height="6" fill="#E4002B"/>
                                <rect x="24" y="2" width="14" height="14" rx="2" fill="none" stroke="#E4002B" stroke-width="3"/>
                                <rect x="28" y="6" width="6" height="6" fill="#E4002B"/>
                                <rect x="2" y="24" width="14" height="14" rx="2" fill="none" stroke="#E4002B" stroke-width="3"/>
                                <rect x="6" y="28" width="6" height="6" fill="#E4002B"/>
                                <rect x="24" y="24" width="6" height="6" fill="#E4002B"/>
                                <rect x="32" y="24" width="6" height="6" fill="#E4002B"/>
                                <rect x="24" y="32" width="6" height="6" fill="#E4002B"/>
                                <rect x="32" y="32" width="6" height="6" fill="#E4002B"/>
                            </svg>
                        </div>
                        <div class="qris-info">
                            <div class="qris-info-title">QRIS <i class="fa-solid fa-circle-check qris-check"></i></div>
                            <div class="qris-info-desc">
                                Satu kode QR untuk semua. Scan pakai aplikasi bank atau e-wallet favorit Anda — pembayaran dikonfirmasi otomatis.
                            </div>
                            <div class="qris-apps-row">
                                <span>GoPay</span><span>OVO</span><span>DANA</span><span>ShopeePay</span><span>m-Banking</span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="payment_method" value="qris">
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>

<script>
    function toggleAddress(val) {
        const addressWrapperGroup = document.getElementById('addressWrapperGroup');
        const mapGroup = document.getElementById('mapGroup');
        const display = (val === 'pickup') ? 'none' : 'block';
        addressWrapperGroup.style.display = display;
        mapGroup.style.display = display;
        if (val !== 'pickup') { setTimeout(function () { if (window.__semarangMap) window.__semarangMap.invalidateSize(); }, 50); }
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
</script>

<script>
    // Peta pemilih lokasi Leaflet + OpenStreetMap — gratis, tanpa API key,
    // jadi selalu aktif. Dikunci di area Kota Semarang lewat maxBounds,
    // dan pencarian alamat pakai Nominatim (geocoder gratis dari OSM)
    // yang dibatasi viewbox Semarang.
    var SEMARANG_CENTER = [{{ $mapCenter['lat'] }}, {{ $mapCenter['lng'] }}];
    var SEMARANG_BOUNDS = L.latLngBounds(
        [-7.15, 110.28], // southwest
        [-6.90, 110.52]  // northeast
    );

    document.addEventListener('DOMContentLoaded', function () {
        var mapEl = document.getElementById('leafletMap');
        if (!mapEl) return;

        var latField = document.getElementById('latitude');
        var lngField = document.getElementById('longitude');
        var initialLat = parseFloat(latField.value) || SEMARANG_CENTER[0];
        var initialLng = parseFloat(lngField.value) || SEMARANG_CENTER[1];

        var map = L.map('leafletMap', {
            center: [initialLat, initialLng],
            zoom: 13,
            maxBounds: SEMARANG_BOUNDS.pad(0.05),
            maxBoundsViscosity: 0.8,
            minZoom: 11,
        });
        window.__semarangMap = map;

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var pinIcon = L.divIcon({
            className: '',
            html: '<div style="width:30px;height:30px;border-radius:50% 50% 50% 0;background:#B5502E;transform:rotate(-45deg);border:2px solid #fff;box-shadow:0 2px 6px rgba(0,0,0,.35);"></div>',
            iconSize: [30, 30],
            iconAnchor: [15, 30],
        });

        var marker = L.marker([initialLat, initialLng], { icon: pinIcon, draggable: true }).addTo(map);

        function syncFields(latlng) {
            latField.value = latlng.lat;
            lngField.value = latlng.lng;
        }
        syncFields(marker.getLatLng());

        marker.on('dragend', function () {
            syncFields(marker.getLatLng());
        });

        map.on('click', function (e) {
            marker.setLatLng(e.latlng);
            syncFields(e.latlng);
        });

        // Pencarian alamat via Nominatim, dibatasi wilayah Semarang.
        var searchInput = document.getElementById('mapSearchInput');
        var searchTimer = null;

        searchInput.addEventListener('input', function () {
            clearTimeout(searchTimer);
            var q = searchInput.value.trim();
            if (q.length < 3) return;

            searchTimer = setTimeout(function () {
                var viewbox = SEMARANG_BOUNDS.toBBoxString();
                var url = 'https://nominatim.openstreetmap.org/search?format=json&limit=1&countrycodes=id'
                    + '&viewbox=' + viewbox + '&bounded=1&q=' + encodeURIComponent(q + ', Semarang');

                fetch(url, { headers: { 'Accept-Language': 'id' } })
                    .then(function (res) { return res.json(); })
                    .then(function (data) {
                        if (!data || !data.length) return;
                        var lat = parseFloat(data[0].lat);
                        var lng = parseFloat(data[0].lon);
                        map.setView([lat, lng], 16);
                        marker.setLatLng([lat, lng]);
                        syncFields({ lat: lat, lng: lng });
                    })
                    .catch(function () { /* silent — user can still drag pin manually */ });
            }, 600);
        });

        if (document.getElementById('delivery_type').value === 'pickup') {
            document.getElementById('mapGroup').style.display = 'none';
        } else {
            setTimeout(function () { map.invalidateSize(); }, 100);
        }
    });
</script>
@endsection
