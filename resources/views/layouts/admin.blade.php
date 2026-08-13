<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Khasanah Catering')</title>

    <!-- Google Fonts, FontAwesome & Chart.js -->
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>

    <style>
        :root {
            --bg-main: #FAF6EF;
            --bg-card: #FFFFFF;
            --bg-input: #F8F1E7;
            --bg-soft: #F5EEE1;
            --primary-orange: #B5502E;
            --primary-orange-hover: #963F22;
            --primary-orange-light: #F3E1D6;
            --secondary-gold: #B8892B;
            --secondary-gold-dark: #8C6A1F;
            --secondary-gold-light: #F7ECD3;
            --tertiary-coral: #C97B6D;
            --tertiary-coral-dark: #A65B4E;
            --tertiary-coral-light: #F5DFDA;
            --quaternary-olive: #6B7F5B;
            --quaternary-olive-dark: #4F5F41;
            --quaternary-olive-light: #E7EDDF;
            --charcoal: #2B2119;
            --sidebar-bg: #241B14;
            --sidebar-bg-soft: #322619;
            --text-primary: #2B2119;
            --text-secondary: #8A7C6D;
            --border-color: #EFE4D4;
            --success: #4F7A52;
            --error: #B23A3A;

            --primary-glow: rgba(181, 80, 46, 0.20);
            --text-main: var(--text-primary);
            --text-muted: var(--text-secondary);
            --accent-green: var(--success);
            --accent-blue: #3B82F6;
            --danger-red: var(--error);
            --font-heading: 'Fraunces', Georgia, serif;
            --font-body: 'Inter', sans-serif;
            --radius-lg: 22px;
            --radius-md: 14px;
            --radius-sm: 10px;
            --transition-speed: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --shadow-soft: 0 6px 28px rgba(43, 33, 25, 0.07);
            --shadow-hover: 0 18px 38px rgba(181, 80, 46, 0.15);
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
            display: flex;
            min-height: 100vh;
        }

        h1, h2, h3, .admin-title, .sidebar-brand {
            font-family: var(--font-heading);
        }

        a { color: inherit; text-decoration: none; }

        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(14px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 268px;
            background: var(--sidebar-bg);
            padding: 1.8rem 1.2rem;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-brand {
            font-size: 1rem;
            font-weight: 600;
            color: #FFFFFF;
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 2.2rem;
            padding: 0 0.4rem;
            min-width: 0;
        }

        .sidebar-brand-icon {
            width: 38px;
            height: 38px;
            border-radius: 11px;
            background: linear-gradient(135deg, var(--primary-orange), var(--tertiary-coral));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
            font-size: 0.95rem;
            flex-shrink: 0;
        }

        .sidebar-brand-text {
            line-height: 1.25;
            min-width: 0;
            overflow: hidden;
        }

        .sidebar-brand-line1 {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-brand .brand-accent {
            font-style: italic;
            font-weight: 500;
            font-size: 0.92rem;
            display: block;
            background: linear-gradient(100deg, #E8A566, var(--secondary-gold));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar-badge {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 0.6px;
            color: #FFFFFF;
            background: var(--primary-orange);
            padding: 2px 8px;
            border-radius: 20px;
            margin-left: 4px;
        }

        .menu-group-label {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 1px;
            color: #8A7C6D;
            text-transform: uppercase;
            margin: 1.4rem 0.8rem 0.6rem;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            color: #C9BEB0;
            border-radius: 30px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all var(--transition-speed);
        }

        .menu-item i { width: 18px; text-align: center; font-size: 0.9rem; }

        .menu-item:hover {
            background: var(--sidebar-bg-soft);
            color: #FFFFFF;
        }

        .menu-item.active {
            background: linear-gradient(100deg, var(--primary-orange), var(--tertiary-coral-dark));
            color: #FFFFFF;
            font-weight: 700;
            box-shadow: 0 8px 18px rgba(181, 80, 46, 0.35);
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 1rem;
        }

        .btn-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 12px;
            border-radius: 30px;
            border: 1.5px solid rgba(178, 58, 58, 0.45);
            color: #E8A0A0;
            font-weight: 600;
            font-size: 0.9rem;
            background: transparent;
            cursor: pointer;
            transition: all var(--transition-speed);
        }

        .btn-logout:hover {
            background: var(--error);
            border-color: var(--error);
            color: #FFFFFF;
        }

        /* --- MAIN CONTENT --- */
        .main-wrap {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.4rem 2.5rem;
            background: var(--bg-main);
        }

        .topbar-title {
            font-family: var(--font-heading);
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .admin-profile-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--bg-card);
            padding: 7px 16px 7px 7px;
            border-radius: 30px;
            box-shadow: var(--shadow-soft);
            font-weight: 600;
            font-size: 0.88rem;
            color: var(--text-primary);
        }

        .admin-profile-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-orange), var(--tertiary-coral));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .admin-content {
            flex: 1;
            padding: 0.5rem 2.5rem 2.5rem;
            overflow-y: auto;
            animation: fadeSlideUp 0.5s cubic-bezier(0.4,0,0.2,1);
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.8rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .admin-title {
            font-size: 1.7rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        /* --- STAT TILES (compact, bento-style, not uniform boxes) --- */
        .stat-tile {
            background: var(--bg-card);
            border-radius: 16px;
            padding: 1rem 1.1rem;
            display: flex;
            align-items: center;
            gap: 0.85rem;
            box-shadow: var(--shadow-soft);
            transition: all var(--transition-speed);
            animation: fadeSlideUp 0.5s cubic-bezier(0.4,0,0.2,1) backwards;
        }

        .stat-tile:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
        }

        .stat-tile-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .stat-orange { background: var(--primary-orange-light); color: var(--primary-orange-hover); }
        .stat-green  { background: var(--quaternary-olive-light); color: var(--quaternary-olive-dark); }
        .stat-blue   { background: var(--secondary-gold-light); color: var(--secondary-gold-dark); }
        .stat-rose   { background: var(--tertiary-coral-light); color: var(--tertiary-coral-dark); }

        .stat-tile-label {
            font-size: 0.7rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 1px;
        }

        .stat-tile-val {
            font-family: var(--font-heading);
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1.2;
        }

        /* --- HERO REVENUE PANEL --- */
        .hero-revenue {
            background: linear-gradient(120deg, var(--charcoal) 0%, #46331F 100%);
            border-radius: 22px;
            padding: 1.6rem 1.8rem;
            color: #FFFFFF;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 6px;
            position: relative;
            overflow: hidden;
            grid-row: span 2;
        }

        .hero-revenue::after {
            content: '';
            position: absolute;
            width: 160px; height: 160px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(184, 137, 43, 0.35), transparent 70%);
            right: -50px; top: -50px;
        }

        .hero-revenue-label {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.65);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 1;
        }

        .hero-revenue-val {
            font-family: var(--font-heading);
            font-size: 1.9rem;
            font-weight: 700;
            position: relative;
            z-index: 1;
        }

        .hero-revenue-sub {
            font-size: 0.78rem;
            color: var(--secondary-gold);
            font-weight: 600;
            position: relative;
            z-index: 1;
        }

        .bento-grid {
            display: grid;
            grid-template-columns: 1.1fr 1fr 1fr;
            grid-template-rows: auto auto;
            gap: 1rem;
        }

        @media (max-width: 900px) {
            .bento-grid { grid-template-columns: 1fr 1fr; }
            .hero-revenue { grid-row: span 1; grid-column: span 2; }
        }

        /* --- DASHBOARD GRID / PANELS (borderless, shadow-only) --- */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1.7fr 1fr;
            gap: 1.5rem;
        }

        @media (max-width: 1100px) {
            .dashboard-grid { grid-template-columns: 1fr; }
        }

        .card-table {
            background: var(--bg-card);
            border: none;
            border-radius: var(--radius-lg);
            padding: 1.7rem;
            box-shadow: var(--shadow-soft);
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.2rem;
        }

        .panel-header h3 { font-size: 1.05rem; font-weight: 600; }
        .panel-header p { font-size: 0.82rem; color: var(--text-muted); margin-top: 2px; }
        .panel-header a { color: var(--primary-orange); font-weight: 700; font-size: 0.85rem; }

        .chart-wrap { position: relative; height: 300px; }

        /* --- TABLES (soft dividers, not boxed) --- */
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 13px 14px;
            border-bottom: 1px solid var(--bg-soft);
            font-size: 0.88rem;
        }

        th {
            color: var(--text-secondary);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.68rem;
            letter-spacing: 0.6px;
            border-bottom: 2px solid var(--bg-soft);
        }

        tr { transition: background var(--transition-speed); }
        tr:hover td { background: var(--bg-soft); }
        tr:last-child td { border-bottom: none; }

        .table-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--primary-orange-light);
            color: var(--primary-orange-hover);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .pill-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 0.76rem;
            font-weight: 700;
        }

        .pill-orange { background: var(--primary-orange-light); color: var(--primary-orange-hover); }
        .pill-gold   { background: var(--secondary-gold-light); color: var(--secondary-gold-dark); }
        .pill-olive  { background: var(--quaternary-olive-light); color: var(--quaternary-olive-dark); }
        .pill-rose   { background: var(--tertiary-coral-light); color: var(--tertiary-coral-dark); }
        .pill-red    { background: #F5DCDC; color: var(--error); }

        /* --- INLINE TRACKING STATUS DROPDOWN (dashboard & daftar pesanan) --- */
        .tracking-select {
            border: none;
            border-radius: 30px;
            padding: 7px 28px 7px 14px;
            font-size: 0.78rem;
            font-weight: 700;
            outline: none;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%238A7C6D'/%3E%3C/svg%3E");
        }

        .tracking-booking_received { background-color: var(--tertiary-coral-light); color: var(--tertiary-coral-dark); }
        .tracking-payment_verified { background-color: var(--secondary-gold-light); color: var(--secondary-gold-dark); }
        .tracking-kitchen_prep     { background-color: var(--primary-orange-light); color: var(--primary-orange-hover); }
        .tracking-ready            { background-color: var(--quaternary-olive-light); color: var(--quaternary-olive-dark); }

        .rank-row {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 0;
            border-bottom: 1px solid var(--bg-soft);
        }

        .rank-row:last-child { border-bottom: none; }

        .rank-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            color: #FFFFFF;
            flex-shrink: 0;
        }

        .rank-0 { background: var(--primary-orange); }
        .rank-1 { background: var(--secondary-gold-dark); }
        .rank-2 { background: var(--tertiary-coral-dark); }
        .rank-3, .rank-4 { background: var(--quaternary-olive-dark); }

        /* --- SEARCH & FILTER (pill-style, not boxy) --- */
        .admin-search {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--bg-input);
            border-radius: 30px;
            padding: 11px 18px;
            max-width: 380px;
            transition: all var(--transition-speed);
        }

        .admin-search:focus-within {
            box-shadow: 0 0 0 4px var(--primary-glow);
        }

        .admin-search i { color: var(--text-secondary); }

        .admin-search input {
            border: none;
            background: transparent;
            outline: none;
            width: 100%;
            font-size: 0.9rem;
            color: var(--text-main);
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 0.8rem;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all var(--transition-speed);
        }

        .btn-orange { background: var(--primary-orange); color: #FFFFFF; }
        .btn-orange:hover { background: var(--primary-orange-hover); transform: translateY(-2px); }
        .btn-blue { background: var(--secondary-gold-light); color: var(--secondary-gold-dark); }
        .btn-blue:hover { background: var(--secondary-gold); color: #fff; }
        .btn-red { background: #F5DCDC; color: var(--error); }
        .btn-red:hover { background: var(--error); color: #fff; }

        /* --- CATEGORY GRID (for Kategori Menu page) --- */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.4rem;
        }

        .category-card {
            display: flex;
            align-items: center;
            gap: 16px;
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 1.6rem;
            box-shadow: var(--shadow-soft);
            transition: all var(--transition-speed);
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .category-icon {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .cat-orange .category-icon { background: var(--primary-orange-light); color: var(--primary-orange-hover); }
        .cat-gold .category-icon   { background: var(--secondary-gold-light); color: var(--secondary-gold-dark); }
        .cat-coral .category-icon  { background: var(--tertiary-coral-light); color: var(--tertiary-coral-dark); }
        .cat-olive .category-icon  { background: var(--quaternary-olive-light); color: var(--quaternary-olive-dark); }

        .category-name { font-weight: 700; font-size: 1.02rem; }
        .category-count { font-size: 0.82rem; color: var(--text-muted); margin-top: 2px; }
        .category-arrow { margin-left: auto; color: var(--text-muted); }

        @media (max-width: 900px) {
            .sidebar { display: none; }
            .admin-content, .topbar { padding-left: 1.2rem; padding-right: 1.2rem; }
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-icon"><i class="fa-solid fa-crown"></i></div>
            <div class="sidebar-brand-text">
                <div class="sidebar-brand-line1">Khasanah</div>
                <span class="brand-accent">Catering — Admin</span>
            </div>
        </div>

        <div class="menu-group-label">Menu Utama</div>
        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high"></i> Dashboard
            </a>
        </div>

        <div class="menu-group-label">Katalog &amp; Menu</div>
        <div class="sidebar-menu">
            <a href="{{ route('admin.menus.index') }}" class="menu-item {{ request()->routeIs('admin.menus.index') || request()->routeIs('admin.menus.create') || request()->routeIs('admin.menus.edit') ? 'active' : '' }}">
                <i class="fa-solid fa-utensils"></i> Kelola Menu
            </a>
            <a href="{{ route('admin.menus.categories') }}" class="menu-item {{ request()->routeIs('admin.menus.categories') ? 'active' : '' }}">
                <i class="fa-solid fa-tags"></i> Kategori Menu
            </a>
        </div>

        <div class="menu-group-label">Transaksi &amp; Pelanggan</div>
        <div class="sidebar-menu">
            <a href="{{ route('admin.orders.index') }}" class="menu-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="fa-solid fa-boxes-packing"></i> Pesanan
            </a>
            <a href="{{ route('admin.customers.index') }}" class="menu-item {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Pelanggan
            </a>
        </div>

        <div class="menu-group-label">Pengaturan</div>
        <div class="sidebar-menu">
            <a href="{{ route('home') }}" class="menu-item">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Website
            </a>
        </div>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN WRAPPER -->
    <div class="main-wrap">
        <div class="topbar">
            <div class="topbar-title">@yield('admin-title', 'Dashboard')</div>
            <div class="admin-profile-chip">
                <div class="admin-profile-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
                {{ auth()->user()->name ?? 'Admin' }}
            </div>
        </div>

        <main class="admin-content">
            @if(session('success'))
                <div style="background: var(--quaternary-olive-light); color: var(--quaternary-olive-dark); padding: 1rem 1.5rem; border-radius: 30px; margin-bottom: 1.5rem; font-weight: 600;">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>
