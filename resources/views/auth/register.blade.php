@extends('layouts.app')

@section('title', 'Register - KhaCate Catering')

@section('styles')
<style>
    .auth-wrapper {
        min-height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .auth-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        width: 100%;
        max-width: 500px;
        padding: 2.5rem;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(10px);
    }

    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .auth-header i {
        font-size: 2.5rem;
        color: var(--primary-orange);
        margin-bottom: 0.8rem;
    }

    .auth-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text-main);
    }

    .auth-subtitle {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-top: 4px;
    }

    .form-group {
        margin-bottom: 1.2rem;
    }

    .form-group label {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 6px;
        color: var(--text-main);
    }

    .form-input {
        width: 100%;
        background: var(--bg-input);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 12px 16px;
        border-radius: var(--radius-md);
        font-size: 0.95rem;
        outline: none;
        transition: var(--transition-speed);
    }

    .form-input:focus {
        border-color: var(--primary-orange);
        box-shadow: 0 0 12px var(--primary-glow);
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
    }

    .auth-footer a:hover {
        text-decoration: underline;
    }
</style>
@section('content')

<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <i class="fa-solid fa-user-plus"></i>
            <h2 class="auth-title">Daftar Akun Kedai Khasanah</h2>
            <p class="auth-subtitle">Buat akun untuk kemudahan booking katering acara Anda</p>
        </div>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" name="name" id="name" class="form-input" placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span style="color: var(--danger-red); font-size: 0.85rem; margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Nomor Telepon / WhatsApp</label>
                <input type="text" name="phone" id="phone" class="form-input" placeholder="Contoh: 081234567890" value="{{ old('phone') }}" required>
                @error('phone')
                    <span style="color: var(--danger-red); font-size: 0.85rem; margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" name="email" id="email" class="form-input" placeholder="contoh@email.com" value="{{ old('email') }}" required>
                @error('email')
                    <span style="color: var(--danger-red); font-size: 0.85rem; margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-input" placeholder="Minimal 6 karakter" required>
                @error('password')
                    <span style="color: var(--danger-red); font-size: 0.85rem; margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Ulangi password Anda" required>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; margin-top: 0.5rem;">
                <i class="fa-solid fa-user-check"></i> Regristrasi Sekarang
            </button>
        </form>

        <div class="auth-footer">
            Sudah punya akun? <a href="{{ route('login') }}">Login di Sini</a>
        </div>
    </div>
</div>

@endsection
