<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Khasanah - Premium Catering & Booking System')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Internal Styling & Custom CSS Theme (Light Mode + Bright Orange Accent, Elegant) -->
    <style>
        :root {
            --bg-main: #FFFCF9;         /* Main body background - warm off-white */
            --bg-card: #FFFFFF;         /* Background for cards, forms, and order summary */
            --bg-input: #FAF6F1;        /* Background for input fields */
            --bg-soft: #FFF3E9;         /* Soft tinted section background (How It Works, etc.) */
            --primary-orange: #FF7A1E; /* Main buttons, active links, and accents - bright orange */
            --primary-orange-hover: #E8650A; /* Button hover state */
            --primary-orange-light: #FFEDE0; /* Light orange tint for badges/backgrounds */
            --charcoal: #2A2118;        /* Elegant deep charcoal-brown for headings */
            --text-primary: #2A2118;    /* Headings, menu names, and prices */
            --text-secondary: #7A7168;  /* Placeholders, descriptions, and small notes */
            --border-color: #F0E4D8;    /* Borders and dividers */
            --success: #1DA35A;         /* Success messages and tracking timeline */
            --error: #E5484D;           /* Error messages like the 20 pax minimum order */

            --primary-glow: rgba(255, 122, 30, 0.25);
            --text-main: var(--text-primary);
            --text-muted: var(--text-secondary);
            --accent-green: var(--success);
            --danger-red: var(--error);
            --radius-lg: 16px;
            --radius-md: 12px;
            --radius-sm: 8px;
            --transition-speed: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --shadow-soft: 0 4px 20px rgba(42, 33, 24, 0.06);
            --shadow-hover: 0 12px 30px rgba(255, 122, 30, 0.18);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        a {
            color: inherit;
            text-decoration: none;
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
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: var(--text-primary);
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
            color: var(--text-primary);
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
            color: var(--text-primary);
            font-weight: 700;
            font-size: 0.9rem;
        }

        /* --- BUTTONS --- */
        .btn-primary {
            background: var(--primary-orange);
            color: var(--text-primary);
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

        /* --- ALERTS & NOTIFICATIONS --- */
        .alert-container {
            max-width: 1200px;
            margin: 1.5rem auto 0;
            padding: 0 1.5rem;
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            margin-bottom: 1rem;
            animation: slideDown 0.4s ease-out;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.12);
            border: 1px solid var(--success);
            color: var(--success);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid var(--error);
            color: var(--error);
        }

        .alert-catering-min {
            background: rgba(239, 68, 68, 0.15);
            border: 2px solid var(--error);
            color: var(--text-primary);
            box-shadow: 0 0 20px rgba(239, 68, 68, 0.2);
        }

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

    <!-- ALERT CONTAINER -->
    <div class="alert-container">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        @if(session('error_min_pax'))
            <div class="alert alert-catering-min">
                <i class="fa-solid fa-triangle-exclamation" style="font-size: 1.5rem; color: var(--primary-orange);"></i>
                <div>
                    <strong>Peringatan Porsi Katering!</strong><br>
                    {{ session('error_min_pax') }}
                </div>
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
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-angle-right" style="color: var(--primary-orange);"></i> Paket Prasmanan </a></li>
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-angle-right" style="color: var(--primary-orange);"></i> Nasi Kotak </a></li>
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-angle-right" style="color: var(--primary-orange);"></i> Snack Box </a></li>
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-angle-right" style="color: var(--primary-orange);"></i> Custom Tumpeng</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Hubungi Dapur Kami</h4>
                <p><i class="fa-solid fa-location-dot" style="color: var(--primary-orange);"></i> Ngesrep, Kec. Banyumanik, Kota Semarang, Jawa Tengah 50261</p>
                <p><i class="fa-solid fa-phone" style="color: var(--primary-orange);"></i> +62 813-2503-2009</p>
                <p><i class="fa-solid fa-envelope" style="color: var(--primary-orange);"></i> di app.blade</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} <strong>Khasanah Catering</strong>. By Najwa Aulia Larasati 12 PPLG 1.</p>
        </div>
    </footer>

    <script>
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
