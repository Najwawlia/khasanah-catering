@extends('layouts.app')

@section('title', 'Register - Khasanah Catering')

@section('styles')
<style>
    .auth-wrapper {
        min-height: calc(100vh - 74px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 2rem;
        background: radial-gradient(circle at 15% 10%, var(--primary-orange-light) 0%, transparent 45%),
                    radial-gradient(circle at 90% 85%, var(--tertiary-coral-light) 0%, transparent 45%);
    }

    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(18px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .auth-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        width: 100%;
        max-width: 520px;
        padding: 2.6rem;
        box-shadow: var(--shadow-soft);
        position: relative;
        overflow: hidden;
        animation: fadeSlideUp 0.6s cubic-bezier(0.4,0,0.2,1);
    }

    .auth-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--primary-orange), var(--secondary-gold), var(--tertiary-coral), var(--quaternary-olive));
    }

    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .auth-icon-circle {
        display: block;
        margin: 0 auto 1.1rem;
    }

    .auth-icon-circle img {
        display: block;
        width: 88px;
        height: auto;
        object-fit: contain;
    }

    .auth-header i {
        font-size: 1.55rem;
        color: var(--primary-orange-hover);
    }

    .auth-title {
        font-family: var(--font-heading);
        font-size: 1.9rem;
        font-weight: 700;
        color: var(--text-main);
    }

    .auth-subtitle {
        color: var(--text-muted);
        font-size: 0.9rem;
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
        margin-bottom: 1.15rem;
        animation: fadeSlideUp 0.5s cubic-bezier(0.4,0,0.2,1) backwards;
    }

    .form-group:nth-of-type(1) { animation-delay: 0.05s; }
    .form-group:nth-of-type(2) { animation-delay: 0.10s; }
    .form-group:nth-of-type(3) { animation-delay: 0.15s; }
    .form-group:nth-of-type(4) { animation-delay: 0.20s; }
    .form-group:nth-of-type(5) { animation-delay: 0.25s; }

    .form-group label {
        display: block;
        font-size: 0.87rem;
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
        font-size: 0.88rem;
        transition: color var(--transition-speed);
    }

    .input-wrap:focus-within i.field-icon { color: var(--primary-orange); }

    .form-input {
        width: 100%;
        background: var(--bg-input);
        border: 1.5px solid var(--border-color);
        color: var(--text-main);
        padding: 12px 16px 12px 42px;
        border-radius: var(--radius-md);
        font-size: 0.95rem;
        outline: none;
        transition: all var(--transition-speed);
    }

    .form-input:focus {
        border-color: var(--primary-orange);
        background: var(--bg-card);
        box-shadow: 0 0 0 4px var(--primary-glow);
    }

    .auth-footer {
        margin-top: 1.5rem;
        text-align: center;
        color: var(--text-muted);
        font-size: 0.9rem;
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
</style>
@section('content')

<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-icon-circle"><img src="{{ asset('storage/images/logo__1_-removebg-preview.png') }}" alt="Khasanah Catering"></div>
            <h2 class="auth-title">Daftar Akun Kedai Khasanah</h2>
            <p class="auth-subtitle">Buat akun untuk kemudahan booking katering acara Anda</p>
        </div>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-user field-icon"></i>
                    <input type="text" name="name" id="name" class="form-input" placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" required autofocus>
                </div>
                @error('name')
                    <span style="color: var(--danger-red); font-size: 0.85rem; margin-top: 4px; display: block;">{{ $message }}</span>
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
                        <span style="color: var(--danger-red); font-size: 0.85rem; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-envelope field-icon"></i>
                        <input type="email" name="email" id="email" class="form-input" placeholder="contoh@email.com" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <span style="color: var(--danger-red); font-size: 0.85rem; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-lock field-icon"></i>
                        <input type="password" name="password" id="password" class="form-input" placeholder="Minimal 6 karakter" required>
                    </div>
                    @error('password')
                        <span style="color: var(--danger-red); font-size: 0.85rem; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-lock field-icon"></i>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Ulangi password Anda" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; margin-top: 0.6rem; padding: 14px;">
                <i class="fa-solid fa-user-check"></i> Registrasi Sekarang
            </button>
        </form>

        <div class="auth-footer">
            Sudah punya akun? <a href="{{ route('login') }}">Login di Sini</a>
        </div>
    </div>
</div>

@endsection
