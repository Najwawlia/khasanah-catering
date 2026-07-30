@extends('layouts.app')

@section('title', 'Login - KhaCate Catering')

@section('styles')
<style>
    .auth-wrapper {
        min-height: 80vh;
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
        max-width: 450px;
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
        color: var(--text-primary);
    }

    .auth-subtitle {
        color: var(--text-secondary);
        font-size: 0.9rem;
        margin-top: 4px;
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

    .form-input {
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

    .form-input::placeholder {
        color: var(--text-secondary);
    }

    .form-input:focus {
        border-color: var(--primary-orange);
        box-shadow: 0 0 12px var(--primary-glow);
    }

    .auth-footer {
        margin-top: 1.5rem;
        text-align: center;
        color: var(--text-secondary);
        font-size: 0.9rem;
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

<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <i class="fa-solid fa-utensils"></i>
            <h2 class="auth-title">Selamat Datang Kembali</h2>
            <p class="auth-subtitle">Login untuk melanjutkan booking katering Anda</p>
        </div>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" name="email" id="email" class="form-input" placeholder="contoh@email.com" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span style="color: var(--danger-red); font-size: 0.85rem; margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-input" placeholder="Masukkan password" required>
                @error('password')
                    <span style="color: var(--danger-red); font-size: 0.85rem; margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; margin-top: 0.5rem;">
                <i class="fa-solid fa-right-to-bracket"></i> Masuk Akun
            </button>
        </form>

        <div class="auth-footer">
            Belum punya akun? <a href="{{ route('register') }}">Daftar Akun Baru</a>
        </div>
    </div>
</div>

@endsection
