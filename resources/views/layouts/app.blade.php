<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Khasanah - Premium Catering & Booking System')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Internal Styling & Custom CSS Theme (Light Mode + Bright Orange Accent, Elegant) -->
    <style>
        :root {
            /* --- ELEGANT MULTI-HUE PALETTE --- */
            --bg-main: #FAF6EF;         /* Main body background - warm ivory */
            --bg-card: #FFFFFF;         /* Background for cards, forms, and order summary */
            --bg-input: #F8F1E7;        /* Background for input fields */
            --bg-soft: #F5EEE1;         /* Soft tinted section background (How It Works, etc.) */

            --primary-orange: #B5502E;       /* Deep terracotta - main buttons, active links */
            --primary-orange-hover: #963F22; /* Button hover state */
            --primary-orange-light: #F3E1D6; /* Light terracotta tint for badges/backgrounds */

            --secondary-gold: #B8892B;       /* Antique ochre gold */
            --secondary-gold-dark: #8C6A1F;
            --secondary-gold-light: #F7ECD3;

            --tertiary-coral: #C97B6D;       /* Dusty rose */
            --tertiary-coral-dark: #A65B4E;
            --tertiary-coral-light: #F5DFDA;

            --quaternary-olive: #6B7F5B;     /* Sage olive - extra accent for variety */
            --quaternary-olive-dark: #4F5F41;
            --quaternary-olive-light: #E7EDDF;

            --charcoal: #2B2119;        /* Deep espresso for headings */
            --text-primary: #2B2119;
            --text-secondary: #8A7C6D;  /* Warm taupe */
            --border-color: #EFE4D4;
            --success: #4F7A52;
            --error: #B23A3A;
            --warning: #96701D;

            --primary-glow: rgba(181, 80, 46, 0.20);
            --text-main: var(--text-primary);
            --text-muted: var(--text-secondary);
            --accent-green: var(--success);
            --danger-red: var(--error);

            --font-heading: 'Fraunces', Georgia, 'Times New Roman', serif;
            --font-body: 'Inter', sans-serif;

            --radius-lg: 18px;
            --radius-md: 12px;
            --radius-sm: 8px;
            --transition-speed: 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            --shadow-soft: 0 4px 22px rgba(43, 33, 25, 0.07);
            --shadow-hover: 0 16px 34px rgba(181, 80, 46, 0.16);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: var(--font-body);
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        h1, h2, h3, .checkout-title, .cart-title, .auth-title, .summary-title,
        .nav-brand, .modal-title, .section-header h3, .footer-col .nav-brand {
            font-family: var(--font-heading);
            letter-spacing: 0.1px;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        /* --- GLOBAL BUTTON SHINE ANIMATION --- */
        .btn-primary {
            position: relative;
            overflow: hidden;
        }

        .btn-primary::after {
            content: '';
            position: absolute;
            top: 0;
            left: -75%;
            width: 50%;
            height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255,255,255,0.35), transparent);
            transform: skewX(-20deg);
            transition: left 0.6s ease;
        }

        .btn-primary:hover::after {
            left: 130%;
        }

        /* --- NAVBAR --- */
        .navbar {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-soft);
        }

        .hamburger-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.4rem;
            color: var(--text-primary);
            cursor: pointer;
        }

        @media (max-width: 900px) {
            .hamburger-btn {
                display: block;
            }

            .nav-links {
                position: fixed;
                top: 68px;
                left: 0;
                right: 0;
                background: #FFFFFF;
                flex-direction: column;
                align-items: flex-start;
                gap: 0;
                padding: 0.5rem 1.5rem;
                border-bottom: 1px solid var(--border-color);
                box-shadow: var(--shadow-soft);
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.35s ease;
            }

            .nav-links.open {
                max-height: 500px;
                padding: 1rem 1.5rem 1.5rem;
            }

            .nav-links .nav-link,
            .nav-links .profile-btn {
                width: 100%;
                padding: 12px 0;
                border-bottom: 1px solid var(--border-color);
            }

            .nav-links .nav-link.active::after {
                display: none;
            }
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.55rem;
            font-weight: 500;
            letter-spacing: 0.2px;
            color: var(--text-primary);
        }

        .nav-brand .brand-text {
            font-family: var(--font-heading);
        }

        .nav-brand .brand-accent {
            font-style: italic;
            font-weight: 600;
            background: linear-gradient(100deg, var(--primary-orange), var(--secondary-gold-dark));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-brand i {
            color: var(--primary-orange);
            font-size: 1.8rem;
        }

        .nav-brand .brand-accent {
            color: var(--primary-orange);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.8rem;
        }

        .nav-link {
            color: var(--text-secondary);
            font-weight: 500;
            transition: all var(--transition-speed);
            display: flex;
            align-items: center;
            gap: 6px;
            position: relative;
            padding: 6px 0;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-orange);
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--primary-orange);
            border-radius: 2px;
            box-shadow: 0 0 8px var(--primary-glow);
        }

        .cart-badge {
            background: var(--primary-orange);
            color: #FFFFFF;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
            margin-left: 4px;
        }

        /* --- USER PROFILE BUTTON --- */
        .profile-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--bg-input);
            border: 1px solid var(--border-color);
            padding: 8px 16px;
            border-radius: 30px;
            color: var(--text-primary);
            font-weight: 600;
            cursor: pointer;
            transition: all var(--transition-speed);
        }

        .profile-btn:hover {
            border-color: var(--primary-orange);
            box-shadow: var(--shadow-hover);
            transform: translateY(-2px);
        }

        .avatar-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
            font-weight: 700;
            font-size: 0.9rem;
        }

        /* --- BUTTONS --- */
        .btn-primary {
            background: var(--primary-orange);
            color: #FFFFFF;
            font-weight: 700;
            padding: 12px 24px;
            border-radius: var(--radius-md);
            border: none;
            cursor: pointer;
            transition: all var(--transition-speed);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 15px var(--primary-glow);
        }

        .btn-primary:hover {
            background: var(--primary-orange-hover);
            transform: translateY(-3px) scale(1.02);
            box-shadow: var(--shadow-hover);
        }

        .btn-secondary {
            background: var(--bg-card);
            color: var(--text-primary);
            border: 1.5px solid var(--border-color);
            padding: 12px 24px;
            border-radius: var(--radius-md);
            font-weight: 600;
            cursor: pointer;
            transition: all var(--transition-speed);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-secondary:hover {
            background: var(--primary-orange-light);
            border-color: var(--primary-orange);
            color: var(--primary-orange-hover);
            transform: translateY(-2px);
        }

        /* --- ALERTS & NOTIFICATIONS (toast style) --- */
        .alert-container {
            position: fixed;
            top: 90px;
            right: 1.5rem;
            z-index: 3000;
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
            pointer-events: none;
        }

        @media (max-width: 640px) {
            .alert-container {
                top: 78px;
                right: 0;
                left: 0;
                max-width: none;
                padding: 0 1rem;
            }
        }

        .alert {
            pointer-events: auto;
            background: var(--bg-card);
            padding: 1rem 1.2rem;
            border-radius: var(--radius-md);
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-weight: 600;
            font-size: 0.92rem;
            line-height: 1.45;
            box-shadow: var(--shadow-soft), 0 8px 24px rgba(42, 31, 22, 0.12);
            animation: slideIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            border-left: 4px solid transparent;
            position: relative;
        }

        .alert i.alert-icon { font-size: 1.15rem; margin-top: 2px; }

        .alert-close {
            position: absolute;
            top: 8px;
            right: 10px;
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 0.85rem;
            opacity: 0.6;
        }

        .alert-close:hover { opacity: 1; }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(40px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .alert.is-leaving {
            animation: fadeOut 0.35s ease forwards;
        }

        @keyframes fadeOut {
            to { opacity: 0; transform: translateX(40px); }
        }

        .alert-success {
            border-left-color: var(--success);
            color: #14532D;
        }
        .alert-success i.alert-icon { color: var(--success); }

        .alert-danger {
            border-left-color: var(--error);
            color: #7A1E22;
        }
        .alert-danger i.alert-icon { color: var(--error); }

        .alert-warning {
            border-left-color: var(--secondary-gold);
            color: var(--warning);
        }
        .alert-warning i.alert-icon { color: var(--secondary-gold-dark); }

        .alert-catering-min {
            border-left-color: var(--tertiary-coral);
            color: var(--text-primary);
        }
        .alert-catering-min i.alert-icon { color: var(--tertiary-coral-dark); }

        /* --- FLOATING WHATSAPP BUTTON --- */
        .floating-wa {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #25d366;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.4);
            z-index: 999;
            transition: all var(--transition-speed);
        }

        .floating-wa:hover {
            transform: scale(1.15) rotate(10deg);
            box-shadow: 0 15px 35px rgba(37, 211, 102, 0.6);
        }

        /* --- FOOTER --- */
        footer {
            background: var(--charcoal);
            border-top: 1px solid var(--border-color);
            padding: 3rem 2rem 2rem;
            margin-top: auto;
        }

        footer, footer .nav-brand, footer .footer-col h4 {
            color: #FFFFFF;
        }

        footer .footer-col p,
        footer .footer-col li,
        footer .footer-bottom {
            color: rgba(255, 255, 255, 0.65);
        }

        footer .nav-brand i {
            color: var(--primary-orange);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2.5rem;
            margin-bottom: 2rem;
        }

        .footer-col h4 {
            color: var(--text-primary);
            font-size: 1.1rem;
            margin-bottom: 1.2rem;
            position: relative;
        }

        .footer-col h4::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 30px;
            height: 2px;
            background: var(--primary-orange);
        }

        .footer-col p, .footer-col li {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.6;
            list-style: none;
            margin-bottom: 0.6rem;
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
            text-align: center;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* --- MAIN CONTAINER --- */
        main {
            flex: 1;
        }

        /* --- SCROLL REVEAL ANIMATION (global utility) --- */
        .reveal-up {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.7s cubic-bezier(0.4, 0, 0.2, 1), transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal-up.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="nav-brand">
            <i class="fa-solid fa-utensils"></i>
            <span class="brand-text">Khasanah<span class="brand-accent">Catering</span></span>
        </a>

        <button class="hamburger-btn" onclick="toggleMobileNav()" aria-label="Menu">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="nav-links" id="navLinks">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i> Beranda
            </a>
            
            <a href="{{ route('cart.index') }}" class="nav-link {{ request()->routeIs('cart.index') ? 'active' : '' }}">
                <i class="fa-solid fa-cart-shopping"></i> Keranjang
                @php
                    $cartCount = count(session('cart', []));
                @endphp
                @if($cartCount > 0)
                    <span class="cart-badge">{{ $cartCount }}</span>
                @endif
            </a>

            @auth
                <a href="{{ route('order.my_orders') }}" class="nav-link {{ request()->routeIs('order.my_orders') ? 'active' : '' }}">
                    <i class="fa-solid fa-receipt"></i> Pesanan Saya
                </a>

                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="fa-solid fa-gauge-high"></i> Panel Admin
                    </a>
                @endif

                <div class="profile-btn" onclick="toggleDropdown()">
                    <div class="avatar-circle">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span>{{ Auth::user()->name }}</span>
                    <i class="fa-solid fa-chevron-down" style="font-size: 0.8rem; color: var(--text-muted);"></i>
                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}" class="profile-btn">
                    <i class="fa-solid fa-user"></i>
                    <span>Login / Register</span>
                </a>
            @endauth
        </div>
    </nav>

    <!-- ALERT CONTAINER (toast notifications) -->
    <div class="alert-container" id="alertContainer">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check alert-icon"></i>
                <div>{{ session('success') }}</div>
                <button class="alert-close" onclick="dismissAlert(this)"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fa-solid fa-circle-exclamation alert-icon"></i>
                <div>{{ session('error') }}</div>
                <button class="alert-close" onclick="dismissAlert(this)"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @endif

        @if(session('error_login_required'))
            <div class="alert alert-warning">
                <i class="fa-solid fa-lock alert-icon"></i>
                <div>
                    <strong>Upps, Anda belum login!</strong><br>
                    {{ session('error_login_required') }}
                </div>
                <button class="alert-close" onclick="dismissAlert(this)"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @endif

        @if(session('error_min_pax'))
            <div class="alert alert-catering-min">
                <i class="fa-solid fa-triangle-exclamation alert-icon"></i>
                <div>
                    <strong>Peringatan Porsi Katering!</strong><br>
                    {{ session('error_min_pax') }}
                </div>
                <button class="alert-close" onclick="dismissAlert(this)"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @endif
    </div>

    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FLOATING WHATSAPP BUTTON -->
    <a href="https://wa.me/6281325032009?text=Halo%20Admin%20Khasanah Catering,%20saya%20ingin%20tanya%20seputar%20booking%20katering..." 
       target="_blank" 
       class="floating-wa" 
       title="Chat Customer Service via WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <!-- FOOTER -->
    <footer>
        <div class="footer-content">
            <div class="footer-col">
                <div class="nav-brand" style="margin-bottom: 1rem;">
                    <i class="fa-solid fa-utensils"></i> <span class="brand-text">Khasanah<span class="brand-accent">Catering</span></span>
                </div>
                <p>Layanan Booking Katering Modern untuk Pernikahan, Acara Kantor, Prasmanan, dan Syukuran Keluarga. Garansi Rasa & Kualitas Bintang 5.</p>
            </div>
            <div class="footer-col">
                <h4>Menu Utama</h4>
                <ul>
                    <li><a href="{{ route('home', ['category' => 'Prasmanan']) }}#katalog"><i class="fa-solid fa-angle-right" style="color: var(--primary-orange);"></i> Paket Prasmanan</a></li>
                    <li><a href="{{ route('home', ['category' => 'Nasi Kotak']) }}#katalog"><i class="fa-solid fa-angle-right" style="color: var(--primary-orange);"></i> Nasi Kotak</a></li>
                    <li><a href="{{ route('home', ['category' => 'Snack Box']) }}#katalog"><i class="fa-solid fa-angle-right" style="color: var(--primary-orange);"></i> Snack Box</a></li>
                    <li><a href="{{ route('home', ['category' => 'Custom / Tumpeng']) }}#katalog"><i class="fa-solid fa-angle-right" style="color: var(--primary-orange);"></i> Custom Tumpeng</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Hubungi Dapur Kami</h4>
                <p><i class="fa-solid fa-location-dot" style="color: var(--primary-orange);"></i> Ngesrep, Kec. Banyumanik, Kota Semarang, Jawa Tengah 50261</p>
                <p><i class="fa-solid fa-phone" style="color: var(--primary-orange);"></i> +62 813-2503-2009</p>
                <p><i class="fa-solid fa-envelope" style="color: var(--primary-orange);"></i> deanthamrin72@gmail.com</p>
                <p>
                    <a href="https://maps.app.goo.gl/Dhg1FxakT4vSRb4E8" target="_blank" style="color: var(--primary-orange); font-weight: 700;">
                        <i class="fa-solid fa-map-location-dot"></i> Buka di Google Maps
                    </a>
                </p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} <strong>Khasanah Catering</strong>. By Najwa Aulia Larasati 12 PPLG 1.</p>
        </div>
    </footer>

    <script>
        // Toast notification: manual close + auto-dismiss after 5s
        function dismissAlert(btn) {
            const el = btn.closest('.alert');
            if (!el) return;
            el.classList.add('is-leaving');
            setTimeout(() => el.remove(), 350);
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('#alertContainer .alert').forEach(function (el, i) {
                setTimeout(function () {
                    el.classList.add('is-leaving');
                    setTimeout(() => el.remove(), 350);
                }, 5500 + (i * 300));
            });
        });

        function toggleDropdown() {
            if (confirm('Apakah Anda ingin keluar (Logout) dari akun Anda?')) {
                document.getElementById('logout-form').submit();
            }
        }

        // Mobile hamburger menu toggle
        function toggleMobileNav() {
            document.getElementById('navLinks').classList.toggle('open');
        }

        // Global scroll-reveal animation using IntersectionObserver
        document.addEventListener('DOMContentLoaded', function () {
            const revealEls = document.querySelectorAll('.reveal-up');
            if (!revealEls.length) return;

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15 });

            revealEls.forEach(el => observer.observe(el));
        });
    </script>
    @yield('scripts')
</body>
</html>
