<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Khasanah Catering')</title>

    <!-- Google Fonts & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700&family=Inter:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --bg-main: #F6F3EC;
            --bg-card: #FFFFFF;
            --bg-input: #FFFFFF;
            --bg-soft: #EFEAE0;
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
            --charcoal: #211913;
            --sidebar-bg: #1C1611;
            --sidebar-bg-soft: #2A2119;
            --text-primary: #211913;
            --text-secondary: #82725F;
            --border-color: #DDD2BE;
            --success: #4F7A52;
            --error: #A73A3A;

            --primary-glow: rgba(181, 80, 46, 0.16);
            --text-main: var(--text-primary);
            --text-muted: var(--text-secondary);
            --accent-green: var(--success);
            --accent-blue: #3B82F6;
            --danger-red: var(--error);
            --font-heading: 'Fraunces', Georgia, serif;
            --font-body: 'Inter', sans-serif;
            --font-mono: 'IBM Plex Mono', monospace;
            --radius-lg: 10px;
            --radius-md: 7px;
            --radius-sm: 5px;
            --transition-speed: 0.2s ease;
            --shadow-subtle: 0 1px 2px rgba(33, 25, 19, 0.04), 0 1px 8px rgba(33, 25, 19, 0.03);
            --shadow-hover: 0 6px 20px rgba(33, 25, 19, 0.08);
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
            font-size: 14px;
        }

        h1, h2, h3, .admin-title, .sidebar-brand {
            font-family: var(--font-heading);
        }

        a { color: inherit; text-decoration: none; }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* ============ SIDEBAR ============ */
        .sidebar {
            width: 250px;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            border-right: 1px solid #000;
        }

        .sidebar-brand {
            font-size: 0.95rem;
            font-weight: 600;
            color: #FFFFFF;
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 1.4rem 1.3rem;
            border-bottom: 1px solid var(--sidebar-bg-soft);
            min-width: 0;
        }

        .sidebar-brand-icon {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-sm);
            background: var(--primary-orange);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .sidebar-brand-text { line-height: 1.3; min-width: 0; overflow: hidden; }
        .sidebar-brand-line1 { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

        .sidebar-brand .brand-accent {
            font-style: italic;
            font-weight: 500;
            font-size: 0.82rem;
            display: block;
            color: var(--secondary-gold);
        }

        .menu-group-label {
            font-family: var(--font-mono);
            font-size: 0.63rem;
            font-weight: 500;
            letter-spacing: 1.2px;
            color: #6B5E4F;
            text-transform: uppercase;
            margin: 1.3rem 1.3rem 0.5rem;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            padding: 0 0.6rem;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 9px 12px;
            color: #ADA08D;
            border-radius: var(--radius-sm);
            border-left: 3px solid transparent;
            font-weight: 500;
            font-size: 0.86rem;
            transition: all var(--transition-speed);
        }

        .menu-item i { width: 16px; text-align: center; font-size: 0.82rem; }

        .menu-item:hover {
            background: var(--sidebar-bg-soft);
            color: #FFFFFF;
        }

        .menu-item.active {
            background: var(--sidebar-bg-soft);
            color: #FFFFFF;
            font-weight: 600;
            border-left: 3px solid var(--primary-orange);
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 1rem 1.3rem 1.4rem;
        }

        .btn-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            width: 100%;
            padding: 10px;
            border-radius: var(--radius-sm);
            border: 1px solid #4A2E2E;
            color: #C98A8A;
            font-weight: 600;
            font-size: 0.84rem;
            background: transparent;
            cursor: pointer;
            transition: all var(--transition-speed);
        }

        .btn-logout:hover {
            background: var(--error);
            border-color: var(--error);
            color: #FFFFFF;
        }

        /* ============ MAIN ============ */
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
            padding: 1.1rem 2.2rem;
            background: var(--bg-card);
            border-bottom: 1px solid var(--border-color);
        }

        .topbar-title {
            font-family: var(--font-heading);
            font-size: 1.15rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .admin-profile-chip {
            display: flex;
            align-items: center;
            gap: 9px;
            border: 1px solid var(--border-color);
            padding: 5px 14px 5px 5px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.82rem;
            color: var(--text-primary);
        }

        .admin-profile-avatar {
            width: 26px;
            height: 26px;
            border-radius: var(--radius-sm);
            background: var(--primary-orange);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.75rem;
        }

        .admin-content {
            flex: 1;
            padding: 1.8rem 2.2rem 2.5rem;
            overflow-y: auto;
            animation: fadeIn 0.3s ease;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.6rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .admin-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        /* ============ KPI STRIP ============ */
        .kpi-strip {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-subtle);
            display: flex;
            flex-wrap: wrap;
            overflow: hidden;
        }

        .kpi-item {
            flex: 1;
            min-width: 160px;
            padding: 1.1rem 1.4rem;
            border-right: 1px solid var(--border-color);
        }

        .kpi-item:last-child { border-right: none; }

        @media (max-width: 900px) {
            .kpi-item { border-right: none; border-bottom: 1px solid var(--border-color); flex-basis: 50%; }
        }

        .kpi-dot {
            width: 6px;
            height: 6px;
            display: inline-block;
            margin-right: 6px;
        }

        .kpi-label {
            font-family: var(--font-mono);
            font-size: 0.65rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 8px;
        }

        .kpi-value {
            font-family: var(--font-mono);
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--text-main);
            line-height: 1.15;
        }

        .kpi-value.kpi-value-lg { font-size: 1.65rem; color: var(--primary-orange); }

        /* ============ SECTION LABEL ============ */
        .section-label {
            display: flex;
            align-items: baseline;
            gap: 10px;
            margin-bottom: 1.2rem;
            padding-bottom: 0.9rem;
            border-bottom: 1px solid var(--border-color);
        }

        .section-label .tick {
            width: 4px;
            height: 16px;
            background: var(--primary-orange);
            display: inline-block;
        }

        .section-label h3 { font-size: 0.98rem; font-weight: 600; }
        .section-label span.sub { font-family: var(--font-mono); font-size: 0.72rem; color: var(--text-muted); }

        /* ============ SEGMENTED BAR ============ */
        .segment-bar {
            display: flex;
            width: 100%;
            height: 10px;
            overflow: hidden;
            margin-bottom: 1.1rem;
            border: 1px solid var(--border-color);
        }

        .segment-bar .segment { height: 100%; transition: opacity var(--transition-speed); }
        .segment-bar .segment:hover { opacity: 0.7; }

        .segment-legend { display: flex; flex-wrap: wrap; gap: 0.9rem 1.6rem; }
        .segment-legend-item { display: flex; align-items: center; gap: 8px; font-size: 0.82rem; }
        .segment-legend-swatch { width: 9px; height: 9px; flex-shrink: 0; }
        .segment-legend-item strong { color: var(--text-main); }
        .segment-legend-item span.count { font-family: var(--font-mono); color: var(--text-muted); font-size: 0.74rem; }

        /* ============ LIST PANEL ============ */
        .list-panel {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-subtle);
            padding: 1.4rem;
        }

        .list-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .list-row:last-child { border-bottom: none; }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1.7fr 1fr;
            gap: 1.4rem;
        }

        @media (max-width: 1100px) {
            .dashboard-grid { grid-template-columns: 1fr; }
        }

        .card-table {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-subtle);
            padding: 1.5rem;
        }

        .table-scroll { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .table-scroll table { min-width: 760px; }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.1rem;
            padding-bottom: 0.9rem;
            border-bottom: 1px solid var(--border-color);
        }

        .panel-header h3 { font-size: 0.98rem; font-weight: 600; }
        .panel-header p { font-family: var(--font-mono); font-size: 0.72rem; color: var(--text-muted); margin-top: 2px; }
        .panel-header a { color: var(--primary-orange); font-weight: 700; font-size: 0.8rem; }

        .chart-wrap { position: relative; height: 300px; }

        /* ============ TABLES (ledger / grid-lined) ============ */
        table { width: 100%; border-collapse: collapse; text-align: left; }

        th, td {
            padding: 11px 13px;
            border-bottom: 1px solid var(--border-color);
            border-right: 1px solid var(--border-color);
            font-size: 0.85rem;
        }

        th:last-child, td:last-child { border-right: none; }

        th {
            background: var(--bg-soft);
            color: var(--text-secondary);
            font-family: var(--font-mono);
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.65rem;
            letter-spacing: 0.6px;
            border-bottom: 1px solid var(--border-color);
        }

        tr:hover td { background: var(--bg-soft); }
        tr:last-child td { border-bottom: none; }

        .table-avatar {
            width: 30px;
            height: 30px;
            border-radius: var(--radius-sm);
            background: var(--primary-orange-light);
            color: var(--primary-orange-hover);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.78rem;
            flex-shrink: 0;
        }

        .pill-badge {
            display: inline-block;
            padding: 3px 9px;
            border-radius: var(--radius-sm);
            font-family: var(--font-mono);
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            border: 1px solid transparent;
        }

        .pill-orange { background: var(--primary-orange-light); color: var(--primary-orange-hover); border-color: rgba(181,80,46,0.25); }
        .pill-gold   { background: var(--secondary-gold-light); color: var(--secondary-gold-dark); border-color: rgba(140,106,31,0.25); }
        .pill-olive  { background: var(--quaternary-olive-light); color: var(--quaternary-olive-dark); border-color: rgba(79,95,65,0.25); }
        .pill-rose   { background: var(--tertiary-coral-light); color: var(--tertiary-coral-dark); border-color: rgba(166,91,78,0.25); }
        .pill-red    { background: #F5DCDC; color: var(--error); border-color: rgba(167,58,58,0.25); }

        /* ============ TRACKING SELECT ============ */
        .tracking-select {
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            padding: 6px 26px 6px 10px;
            font-family: var(--font-mono);
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            outline: none;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            background-repeat: no-repeat;
            background-position: right 8px center;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%2382725F'/%3E%3C/svg%3E");
        }

        .tracking-booking_received { background-color: var(--tertiary-coral-light); color: var(--tertiary-coral-dark); }
        .tracking-payment_verified { background-color: var(--secondary-gold-light); color: var(--secondary-gold-dark); }
        .tracking-kitchen_prep     { background-color: var(--primary-orange-light); color: var(--primary-orange-hover); }
        .tracking-ready            { background-color: var(--quaternary-olive-light); color: var(--quaternary-olive-dark); }

        .rank-row {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 11px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .rank-row:last-child { border-bottom: none; }

        .rank-number {
            width: 26px;
            height: 26px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-mono);
            font-weight: 700;
            font-size: 0.78rem;
            color: #FFFFFF;
            flex-shrink: 0;
        }

        .rank-0 { background: var(--primary-orange); }
        .rank-1 { background: var(--secondary-gold-dark); }
        .rank-2 { background: var(--tertiary-coral-dark); }
        .rank-3, .rank-4 { background: var(--quaternary-olive-dark); }

        /* ============ SEARCH ============ */
        .admin-search {
            display: flex;
            align-items: center;
            gap: 9px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            padding: 9px 14px;
            max-width: 380px;
        }

        .admin-search:focus-within { border-color: var(--primary-orange); }
        .admin-search i { color: var(--text-secondary); font-size: 0.82rem; }

        .admin-search input {
            border: none;
            background: transparent;
            outline: none;
            width: 100%;
            font-size: 0.86rem;
            color: var(--text-main);
        }

        .btn-sm {
            padding: 7px 14px;
            font-size: 0.78rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            cursor: pointer;
            border: 1px solid transparent;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all var(--transition-speed);
        }

        .btn-orange { background: var(--primary-orange); color: #FFFFFF; }
        .btn-orange:hover { background: var(--primary-orange-hover); }
        .btn-blue { background: var(--bg-card); color: var(--secondary-gold-dark); border-color: var(--border-color); }
        .btn-blue:hover { background: var(--secondary-gold-light); border-color: var(--secondary-gold-dark); }
        .btn-red { background: var(--bg-card); color: var(--error); border-color: var(--border-color); }
        .btn-red:hover { background: #F5DCDC; border-color: var(--error); }

        /* ============ CATEGORY GRID ============ */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1px;
            background: var(--border-color);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-subtle);
        }

        .category-card {
            display: flex;
            align-items: center;
            gap: 15px;
            background: var(--bg-card);
            padding: 1.5rem;
            transition: all var(--transition-speed);
        }

        .category-card:hover { background: var(--bg-soft); transform: translateY(-1px); }

        .category-icon {
            width: 44px;
            height: 44px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .cat-orange .category-icon { background: var(--primary-orange-light); color: var(--primary-orange-hover); }
        .cat-gold .category-icon   { background: var(--secondary-gold-light); color: var(--secondary-gold-dark); }
        .cat-coral .category-icon  { background: var(--tertiary-coral-light); color: var(--tertiary-coral-dark); }
        .cat-olive .category-icon  { background: var(--quaternary-olive-light); color: var(--quaternary-olive-dark); }

        .category-name { font-weight: 700; font-size: 0.98rem; }
        .category-count { font-family: var(--font-mono); font-size: 0.76rem; color: var(--text-muted); margin-top: 3px; }
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
                <div class="admin-profile-avatar">A</div>
                Admin
            </div>
        </div>

        <main class="admin-content">
            @if(session('success'))
                <div style="background: var(--quaternary-olive-light); color: var(--quaternary-olive-dark); border: 1px solid var(--quaternary-olive-dark); padding: 0.9rem 1.3rem; margin-bottom: 1.4rem; font-weight: 600; font-size: 0.86rem;">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>
