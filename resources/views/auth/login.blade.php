@extends('layouts.app')

@section('title', 'Login - Khasanah Catering')

@section('styles')
<style>
    .auth-split {
        min-height: calc(100vh - 74px);
        display: grid;
        grid-template-columns: 1.05fr 1fr;
    }

    @media (max-width: 900px) {
        .auth-split {
            grid-template-columns: 1fr;
        }
        .auth-visual { display: none; }
    }

    /* --- LEFT VISUAL PANEL --- */
    .auth-visual {
        position: relative;
        background: linear-gradient(160deg, var(--charcoal) 0%, #4A372A 55%, var(--primary-orange-hover) 130%),
                    url('https://images.unsplash.com/photo-1555244162-803834f70033?w=1200&auto=format&fit=crop&q=80') center/cover;
        background-blend-mode: multiply;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 3rem;
        overflow: hidden;
    }

    .auth-visual::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 20% 20%, rgba(184, 137, 43, 0.35), transparent 55%),
                    radial-gradient(circle at 85% 80%, rgba(201, 123, 109, 0.3), transparent 50%);
        animation: floatGlow 9s ease-in-out infinite alternate;
    }

    @keyframes floatGlow {
        from { transform: translate(0, 0) scale(1); }
        to { transform: translate(15px, -15px) scale(1.05); }
    }

    .auth-visual-content {
        position: relative;
        z-index: 2;
    }

    .auth-visual-quote {
        font-family: var(--font-heading);
        font-style: italic;
        font-size: 1.7rem;
        line-height: 1.5;
        color: #FFFFFF;
        max-width: 420px;
        animation: fadeSlideUp 0.8s cubic-bezier(0.4,0,0.2,1) 0.15s backwards;
    }

    .auth-visual-quote span { color: var(--secondary-gold); }

    .auth-visual-author {
        margin-top: 1.2rem;
        color: rgba(255,255,255,0.65);
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        animation: fadeSlideUp 0.8s cubic-bezier(0.4,0,0.2,1) 0.3s backwards;
    }

    .auth-visual-badges {
        display: flex;
        gap: 0.8rem;
        flex-wrap: wrap;
        position: relative;
        z-index: 2;
        animation: fadeSlideUp 0.8s cubic-bezier(0.4,0,0.2,1) 0.45s backwards;
    }

    .auth-visual-badge {
        background: rgba(255,255,255,0.12);
        backdrop-filter: blur(6px);
        border: 1px solid rgba(255,255,255,0.2);
        color: #FFFFFF;
        padding: 8px 16px;
        border-radius: 30px;
        font-size: 0.82rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .auth-visual-badge i { color: var(--secondary-gold); }

    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(18px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* --- RIGHT FORM PANEL --- */
    .auth-form-panel {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 2rem;
        background: var(--bg-main);
    }

    .auth-card {
        width: 100%;
        max-width: 400px;
        animation: fadeSlideUp 0.6s cubic-bezier(0.4,0,0.2,1);
    }

    .auth-header {
        margin-bottom: 2.2rem;
    }

    .auth-icon-circle {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        background: var(--primary-orange-light);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.2rem;
    }

    .auth-header i {
        font-size: 1.5rem;
        color: var(--primary-orange-hover);
    }

    .auth-title {
        font-family: var(--font-heading);
        font-size: 2.1rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .auth-subtitle {
        color: var(--text-secondary);
        font-size: 0.92rem;
        margin-top: 6px;
    }

    .form-group {
        margin-bottom: 1.3rem;
        animation: fadeSlideUp 0.6s cubic-bezier(0.4,0,0.2,1) backwards;
    }

    .form-group:nth-of-type(1) { animation-delay: 0.08s; }
    .form-group:nth-of-type(2) { animation-delay: 0.14s; }

    .form-group label {
        display: block;
        font-size: 0.88rem;
        font-weight: 600;
        margin-bottom: 7px;
        color: var(--text-primary);
    }

    .input-wrap {
        position: relative;
    }

    .input-wrap i.field-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-secondary);
        font-size: 0.9rem;
        transition: color var(--transition-speed);
    }

    .input-wrap:focus-within i.field-icon {
        color: var(--primary-orange);
    }

    .form-input {
        width: 100%;
        background: var(--bg-input);
        border: 1.5px solid var(--border-color);
        color: var(--text-primary);
        padding: 13px 16px 13px 42px;
        border-radius: var(--radius-md);
        font-size: 0.95rem;
        outline: none;
        transition: all var(--transition-speed);
    }

    .form-input::placeholder {
        color: var(--text-secondary);
    }

    .form-input:focus {
        border-color: var(--primary-orange);
        background: var(--bg-card);
        box-shadow: 0 0 0 4px var(--primary-glow);
    }

    .auth-submit {
        width: 100%;
        margin-top: 0.6rem;
        padding: 14px;
        font-size: 1rem;
        animation: fadeSlideUp 0.6s cubic-bezier(0.4,0,0.2,1) 0.2s backwards;
    }

    .auth-footer {
        margin-top: 1.6rem;
        text-align: center;
        color: var(--text-secondary);
        font-size: 0.9rem;
        animation: fadeSlideUp 0.6s cubic-bezier(0.4,0,0.2,1) 0.26s backwards;
    }

    .auth-footer a {
        color: var(--primary-orange);
        font-weight: 700;
        transition: all var(--transition-speed);
    }

    .auth-footer a:hover {
        color: var(--primary-orange-hover);
        text-decoration: underline;
    }
</style>
@section('content')

<div class="auth-split">
    <!-- LEFT VISUAL PANEL -->
    <div class="auth-visual">
        <div class="auth-visual-content">
            <p class="auth-visual-quote">"Setiap acara istimewa layak dihidangkan dengan <span>cita rasa terbaik</span> dan pelayanan yang tulus."</p>
            <p class="auth-visual-author">— TIM DAPUR KHASANAH CATERING</p>
        </div>
        <div class="auth-visual-badges">
            <div class="auth-visual-badge"><i class="fa-solid fa-star"></i> Rating 4.9/5</div>
            <div class="auth-visual-badge"><i class="fa-solid fa-users"></i> 500+ Acara Terlayani</div>
            <div class="auth-visual-badge"><i class="fa-solid fa-award"></i> Garansi Rasa</div>
        </div>
    </div>

    <!-- RIGHT FORM PANEL -->
    <div class="auth-form-panel">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-icon-circle"><i class="fa-solid fa-utensils"></i></div>
                <h2 class="auth-title">Selamat Datang Kembali</h2>
                <p class="auth-subtitle">Login untuk melanjutkan booking katering Anda</p>
            </div>

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-envelope field-icon"></i>
                        <input type="email" name="email" id="email" class="form-input" placeholder="contoh@email.com" value="{{ old('email') }}" required autofocus>
                    </div>
                    @error('email')
                        <span style="color: var(--danger-red); font-size: 0.85rem; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-lock field-icon"></i>
                        <input type="password" name="password" id="password" class="form-input" placeholder="Masukkan password" required>
                    </div>
                    @error('password')
                        <span style="color: var(--danger-red); font-size: 0.85rem; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-primary auth-submit">
                    <i class="fa-solid fa-right-to-bracket"></i> Masuk Akun
                </button>
            </form>

            <div class="auth-footer">
                Belum punya akun? <a href="{{ route('register') }}">Daftar Akun Baru</a>
            </div>
        </div>
    </div>
</div>

@endsection
