@extends('layouts.app')

@section('title', 'Register - Khasanah Catering')

@section('styles')
<style>
    .auth-split {
        min-height: calc(100vh - 74px);
        display: grid;
        grid-template-columns: 1fr 1.05fr;
    }

    @media (max-width: 900px) {
        .auth-split { grid-template-columns: 1fr; }
        .auth-visual { display: none; }
    }

    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(18px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* --- LEFT: FORM PANEL --- */
    .auth-form-panel {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2.6rem 2rem;
        background: var(--bg-main);
    }

    .auth-card {
        width: 100%;
        max-width: 430px;
        animation: fadeSlideUp 0.6s cubic-bezier(0.4,0,0.2,1);
    }

    .auth-header { margin-bottom: 1.8rem; }

    .auth-icon-circle {
        display: block;
        margin-bottom: 1rem;
    }

    .auth-icon-circle img {
        display: block;
        width: 100px;
        height: auto;
        object-fit: contain;
    }

    .auth-title {
        font-family: var(--font-heading);
        font-size: 1.85rem;
        font-weight: 700;
        color: var(--text-main);
    }

    .auth-subtitle {
        color: var(--text-muted);
        font-size: 0.88rem;
        margin-top: 6px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    @media (max-width: 480px) {
        .form-row { grid-template-columns: 1fr; }
    }

    .form-group {
        margin-bottom: 1.05rem;
        animation: fadeSlideUp 0.5s cubic-bezier(0.4,0,0.2,1) backwards;
    }

    .form-group:nth-of-type(1) { animation-delay: 0.05s; }
    .form-group:nth-of-type(2) { animation-delay: 0.10s; }
    .form-group:nth-of-type(3) { animation-delay: 0.15s; }
    .form-group:nth-of-type(4) { animation-delay: 0.20s; }
    .form-group:nth-of-type(5) { animation-delay: 0.25s; }

    .form-group label {
        display: block;
        font-size: 0.84rem;
        font-weight: 600;
        margin-bottom: 6px;
        color: var(--text-main);
    }

    .input-wrap { position: relative; }

    .input-wrap i.field-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-secondary);
        font-size: 0.85rem;
        transition: color var(--transition-speed);
    }

    .input-wrap:focus-within i.field-icon { color: var(--primary-orange); }

    .form-input {
        width: 100%;
        background: var(--bg-input);
        border: 1.5px solid var(--border-color);
        color: var(--text-main);
        padding: 11px 14px 11px 40px;
        border-radius: var(--radius-md);
        font-size: 0.92rem;
        outline: none;
        transition: all var(--transition-speed);
    }

    .form-input:focus {
        border-color: var(--primary-orange);
        background: var(--bg-card);
        box-shadow: 0 0 0 4px var(--primary-glow);
    }

    .input-wrap .pw-toggle {
        position: absolute;
        right: 13px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--text-secondary);
        cursor: pointer;
        font-size: 0.82rem;
        padding: 4px;
        transition: color var(--transition-speed);
    }
    .input-wrap .pw-toggle:hover { color: var(--primary-orange); }
    .input-wrap.has-toggle .form-input { padding-right: 38px; }

    /* --- PASSWORD STRENGTH METER --- */
    .pw-strength {
        display: flex;
        gap: 4px;
        margin-top: 7px;
    }
    .pw-strength-bar {
        height: 4px;
        flex: 1;
        border-radius: 3px;
        background: var(--border-color);
        transition: background var(--transition-speed);
    }
    .pw-strength-label {
        font-size: 0.72rem;
        margin-top: 4px;
        color: var(--text-muted);
        min-height: 1em;
    }

    /* --- PASSWORD MATCH INDICATOR --- */
    .pw-match-hint {
        font-size: 0.72rem;
        margin-top: 4px;
        display: flex;
        align-items: center;
        gap: 5px;
        min-height: 1em;
    }

    /* --- SUBMIT BUTTON LOADING STATE --- */
    .btn-primary.is-loading {
        pointer-events: none;
        opacity: 0.85;
    }
    .btn-primary .btn-spinner {
        display: none;
        width: 15px; height: 15px;
        border: 2px solid rgba(255,255,255,0.4);
        border-top-color: #fff;
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
        margin-right: 8px;
    }
    .btn-primary.is-loading .btn-spinner { display: inline-block; }
    .btn-primary.is-loading .btn-label-icon { display: none; }
    @keyframes spin { to { transform: rotate(360deg); } }

    .auth-footer {
        margin-top: 1.4rem;
        text-align: left;
        color: var(--text-muted);
        font-size: 0.88rem;
    }

    .auth-footer a {
        color: var(--primary-orange);
        font-weight: 700;
        transition: color var(--transition-speed);
    }

    .auth-footer a:hover {
        color: var(--primary-orange-hover);
        text-decoration: underline;
    }

    /* --- RIGHT: MEMBERSHIP INVITATION VISUAL --- */
    .auth-visual {
        position: relative;
        background: linear-gradient(200deg, var(--charcoal) 0%, #4A372A 55%, var(--primary-orange-hover) 130%),
                    url('https://images.unsplash.com/photo-1555244162-803834f70033?w=1200&auto=format&fit=crop&q=80') center/cover;
        background-blend-mode: multiply;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem;
        overflow: hidden;
    }

    .auth-visual::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 80% 20%, rgba(184, 137, 43, 0.35), transparent 55%),
                    radial-gradient(circle at 15% 85%, rgba(201, 123, 109, 0.3), transparent 50%);
        animation: floatGlow 9s ease-in-out infinite alternate;
    }

    @keyframes floatGlow {
        from { transform: translate(0, 0) scale(1); }
        to { transform: translate(-15px, 15px) scale(1.05); }
    }

    /* Membership invitation card - reuses the ticket-stub / dashed-perforation
       language from the landing page CTA for brand consistency */
    .member-card {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 380px;
        background: rgba(255,255,255,0.06);
        backdrop-filter: blur(6px);
        border: 1.5px dashed rgba(255,255,255,0.3);
        border-radius: 18px;
        padding: 2.2rem 2rem;
        animation: fadeSlideUp 0.8s cubic-bezier(0.4,0,0.2,1) 0.1s backwards;
    }

    .member-eyebrow {
        color: var(--secondary-gold);
        font-size: 0.76rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 0.7rem;
        display: block;
    }

    .member-heading {
        font-family: var(--font-heading);
        font-style: italic;
        font-size: 1.5rem;
        line-height: 1.4;
        color: #FFFFFF;
        margin-bottom: 1.6rem;
    }

    .member-heading span { color: var(--secondary-gold); }

    .benefit-list {
        display: flex;
        flex-direction: column;
        gap: 1.1rem;
    }

    .benefit-item {
        display: flex;
        gap: 13px;
        align-items: flex-start;
        animation: fadeSlideUp 0.6s cubic-bezier(0.4,0,0.2,1) backwards;
    }

    .benefit-item:nth-child(1) { animation-delay: 0.2s; }
    .benefit-item:nth-child(2) { animation-delay: 0.3s; }
    .benefit-item:nth-child(3) { animation-delay: 0.4s; }
    .benefit-item:nth-child(4) { animation-delay: 0.5s; }

    .benefit-icon {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 1.5px dashed rgba(255,255,255,0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--secondary-gold);
        font-size: 0.85rem;
        flex-shrink: 0;
    }

    .benefit-text strong {
        display: block;
        color: #FFFFFF;
        font-size: 0.9rem;
        margin-bottom: 2px;
    }

    .benefit-text span {
        color: rgba(255,255,255,0.6);
        font-size: 0.79rem;
        line-height: 1.5;
    }

    .member-divider {
        border-top: 1.5px dashed rgba(255,255,255,0.22);
        margin: 1.6rem 0;
    }

    .member-footnote {
        display: flex;
        align-items: center;
        gap: 8px;
        color: rgba(255,255,255,0.55);
        font-size: 0.75rem;
    }

    .member-footnote i { color: var(--secondary-gold); }
</style>
@section('content')

<div class="auth-split">
    <!-- LEFT: FORM -->
    <div class="auth-form-panel">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-icon-circle"><img src="{{ asset('storage/images/logo__1_-removebg-preview.png') }}" alt="Khasanah Catering"></div>
                <h2 class="auth-title">Buat Akun Baru</h2>
                <p class="auth-subtitle">Isi data di bawah untuk mulai booking katering</p>
            </div>

            <form action="{{ route('register.post') }}" method="POST" id="registerForm" onsubmit="handleAuthSubmit(this)">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-user field-icon"></i>
                        <input type="text" name="name" id="name" class="form-input" placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" required autofocus>
                    </div>
                    @error('name')
                        <span style="color: var(--danger-red); font-size: 0.83rem; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">No. WhatsApp</label>
                        <div class="input-wrap">
                            <i class="fa-brands fa-whatsapp field-icon"></i>
                            <input type="text" name="phone" id="phone" class="form-input" placeholder="0812xxxxxxx" value="{{ old('phone') }}" required>
                        </div>
                        @error('phone')
                            <span style="color: var(--danger-red); font-size: 0.83rem; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-wrap">
                            <i class="fa-solid fa-envelope field-icon"></i>
                            <input type="email" name="email" id="email" class="form-input" placeholder="contoh@email.com" value="{{ old('email') }}" required>
                        </div>
                        @error('email')
                            <span style="color: var(--danger-red); font-size: 0.83rem; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrap has-toggle">
                            <i class="fa-solid fa-lock field-icon"></i>
                            <input type="password" name="password" id="password" class="form-input" placeholder="Minimal 6 karakter" required oninput="checkPwStrength(); checkPwMatch();">
                            <button type="button" class="pw-toggle" onclick="togglePw('password', this)" tabindex="-1">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                        <div class="pw-strength" id="pwStrengthBars">
                            <div class="pw-strength-bar"></div>
                            <div class="pw-strength-bar"></div>
                            <div class="pw-strength-bar"></div>
                        </div>
                        <div class="pw-strength-label" id="pwStrengthLabel"></div>
                        @error('password')
                            <span style="color: var(--danger-red); font-size: 0.83rem; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi</label>
                        <div class="input-wrap has-toggle">
                            <i class="fa-solid fa-lock field-icon"></i>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Ulangi password" required oninput="checkPwMatch();">
                            <button type="button" class="pw-toggle" onclick="togglePw('password_confirmation', this)" tabindex="-1">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                        <div class="pw-match-hint" id="pwMatchHint"></div>
                    </div>
                </div>

                <button type="submit" class="btn-primary" style="width: 100%; margin-top: 0.5rem; padding: 13px;">
                    <span class="btn-spinner"></span>
                    <i class="fa-solid fa-user-check btn-label-icon"></i> Daftar Sekarang
                </button>
            </form>

            <div class="auth-footer">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </div>
        </div>
    </div>

    <!-- RIGHT: MEMBERSHIP INVITATION -->
    <div class="auth-visual">
        <div class="member-card">
            <span class="member-eyebrow">Kartu Keanggotaan Digital</span>
            <p class="member-heading">"Sekali daftar, pesan katering berikutnya jadi <span>jauh lebih cepat.</span>"</p>

            <div class="benefit-list">
                <div class="benefit-item">
                    <div class="benefit-icon"><i class="fa-solid fa-truck-fast"></i></div>
                    <div class="benefit-text">
                        <strong>Lacak Pesanan Real-time</strong>
                        <span>Pantau progress dari booking diterima sampai siap diantar.</span>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                    <div class="benefit-text">
                        <strong>Riwayat Pesanan Tersimpan</strong>
                        <span>Mau pesan menu yang sama lagi? Tinggal lihat riwayat.</span>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon"><i class="fa-solid fa-bolt"></i></div>
                    <div class="benefit-text">
                        <strong>Checkout Lebih Cepat</strong>
                        <span>Data pemesan otomatis terisi, tinggal pilih tanggal acara.</span>
                    </div>
                </div>
            </div>

            <div class="member-divider"></div>
            <div class="member-footnote">
                <i class="fa-solid fa-heart"></i> Gratis, tanpa biaya keanggotaan tersembunyi
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function togglePw(fieldId, btn) {
        var field = document.getElementById(fieldId);
        var icon = btn.querySelector('i');
        var showing = field.type === 'text';
        field.type = showing ? 'password' : 'text';
        icon.classList.toggle('fa-eye', showing);
        icon.classList.toggle('fa-eye-slash', !showing);
    }

    function checkPwStrength() {
        var val = document.getElementById('password').value;
        var bars = document.querySelectorAll('#pwStrengthBars .pw-strength-bar');
        var label = document.getElementById('pwStrengthLabel');

        var score = 0;
        if (val.length >= 6) score++;
        if (val.length >= 10) score++;
        if (/[A-Z]/.test(val) && /[0-9]/.test(val)) score++;

        var colors = ['var(--danger-red)', 'var(--secondary-gold-dark)', 'var(--success)'];
        var texts = ['Lemah — tambah karakter lagi', 'Cukup — bisa lebih kuat', 'Password kuat'];

        bars.forEach(function (bar, i) {
            bar.style.background = (val.length === 0) ? '' : (i < score ? colors[score - 1] : '');
        });
        label.textContent = val.length === 0 ? '' : texts[score - 1] || texts[0];
        label.style.color = val.length === 0 ? '' : colors[score - 1] || colors[0];
    }

    function checkPwMatch() {
        var pw = document.getElementById('password').value;
        var confirm = document.getElementById('password_confirmation').value;
        var hint = document.getElementById('pwMatchHint');

        if (confirm.length === 0) {
            hint.innerHTML = '';
            return;
        }
        if (pw === confirm) {
            hint.innerHTML = '<i class="fa-solid fa-circle-check" style="color: var(--success);"></i> <span style="color: var(--success);">Password cocok</span>';
        } else {
            hint.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color: var(--danger-red);"></i> <span style="color: var(--danger-red);">Belum sama</span>';
        }
    }

    function handleAuthSubmit(form) {
        var btn = form.querySelector('button[type="submit"]');
        if (btn) btn.classList.add('is-loading');
    }
</script>
@endsection
