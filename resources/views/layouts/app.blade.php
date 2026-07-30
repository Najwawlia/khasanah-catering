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

    <!-- Internal Styling & Custom CSS Theme (Dark Mode + Bright Orange Accent) -->
    <style>
        :root {
            --bg-main: #121212; /* Main body background */
            --bg-card: #1E1E1E; /* Background for cards, forms, and order summary */
            --bg-input: #2A2A2A; /* Background for input fields */
            --primary-orange: #FF6600; /* Main buttons, active links, and accents */
            --primary-orange-hover: #E55C00; /* Button hover state */
            --text-primary: #FFFFFF; /* Headings, menu names, and prices */
            --text-secondary: #9CA3AF; /* Placeholders, descriptions, and small notes */
            --border-color: #374151; /* Borders and dividers */
            --success: #22C55E; /* Success messages and tracking timeline */
            --error: #EF4444; /* Error messages like the 20 pax minimum order */

            --primary-glow: rgba(255, 102, 0, 0.35);
            --text-main: var(--text-primary);
            --text-muted: var(--text-secondary);
            --accent-green: var(--success);
            --danger-red: var(--error);
            --radius-lg: 16px;
            --radius-md: 12px;
            --radius-sm: 8px;
            --transition-speed: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
            background: rgba(30, 30, 30, 0.92);
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

        .nav-brand span {
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
            background: var(--bg-card);
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
            box-shadow: 0 0 15px var(--primary-glow);
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
            box-shadow: 0 8px 25px var(--primary-glow);
        }

        .btn-secondary {
            background: var(--bg-input);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
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
            background: var(--bg-card);
            border-color: var(--primary-orange);
            color: var(--primary-orange);
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
            background: #0a0a0a;
            border-top: 1px solid var(--border-color);
            padding: 3rem 2rem 2rem;
            margin-top: auto;
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
    </style>
    @yield('styles')
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="nav-brand">
            <i class="fa-solid fa-utensils"></i>
            Khasanah<span>Catering</span>
        </a>

        <div class="nav-links">
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
    <a href="https://wa.me/6281325032009?text=Halo%20Admin%20KhaCate,%20saya%20ingin%20tanya%20seputar%20booking%20katering..." 
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
                    <i class="fa-solid fa-utensils"></i> Khasanah<span>Catering</span>
                </div>
                <p>Layanan Booking Katering Premium Modern untuk Pernikahan, Acara Kantor, Prasmanan Sultan, dan Syukuran Keluarga. Garansi Rasa & Kualitas Bintang 5.</p>
            </div>
            <div class="footer-col">
                <h4>Menu Utama</h4>
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-angle-right" style="color: var(--primary-orange);"></i> Paket Prasmanan Royal</a></li>
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-angle-right" style="color: var(--primary-orange);"></i> Nasi Kotak Executive</a></li>
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-angle-right" style="color: var(--primary-orange);"></i> Snack Box Premium</a></li>
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-angle-right" style="color: var(--primary-orange);"></i> Live Cooking Station</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Hubungi Dapur Kami</h4>
                <p><i class="fa-solid fa-location-dot" style="color: var(--primary-orange);"></i> app.balde</p>
                <p><i class="fa-solid fa-phone" style="color: var(--primary-orange);"></i> +62 813-2503-2009</p>
                <p><i class="fa-solid fa-envelope" style="color: var(--primary-orange);"></i> di app.blade</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} <strong>Khasanah Catering</strong>. By Najwa Aulia PPLG 1.</p>
        </div>
    </footer>

    <script>
        function toggleDropdown() {
            if (confirm('Apakah Anda ingin keluar (Logout) dari akun Anda?')) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>
    @yield('scripts')
</body>
</html>
