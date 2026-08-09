<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Khasanah Catering')</title>

    <!-- Google Fonts & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
            width: 264px;
            background: #FFFFFF;
            border-right: 1px solid var(--border-color);
            padding: 2rem 1.4rem;
            display: flex;
            flex-direction: column;
            box-shadow: var(--shadow-soft);
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 2.6rem;
            padding-bottom: 1.6rem;
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary-orange), var(--tertiary-coral));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
            font-size: 1.2rem;
            box-shadow: 0 6px 16px rgba(181, 80, 46, 0.28);
        }

        .sidebar-brand .brand-accent { color: var(--primary-orange); }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--text-secondary);
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 0.94rem;
            transition: all var(--transition-speed);
            border-left: 3px solid transparent;
        }

        .menu-item i { width: 18px; text-align: center; }

        .menu-item:hover {
            background: var(--bg-soft);
            color: var(--text-primary);
            transform: translateX(3px);
        }

        .menu-item.active {
            background: var(--primary-orange-light);
            color: var(--primary-orange-hover);
            border-left: 3px solid var(--primary-orange);
            font-weight: 700;
        }

        .admin-content {
            flex: 1;
            padding: 2.5rem;
            overflow-y: auto;
            animation: fadeSlideUp 0.5s cubic-bezier(0.4,0,0.2,1);
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .admin-title {
            font-size: 1.9rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        /* --- TABLES & CARDS --- */
        .card-table {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            box-shadow: var(--shadow-soft);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.9rem;
        }

        th {
            color: var(--text-secondary);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.72rem;
            letter-spacing: 0.6px;
        }

        tr { transition: background var(--transition-speed); }
        tr:hover td { background: var(--bg-soft); }
        tr:last-child td { border-bottom: none; }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.8rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all var(--transition-speed);
        }

        .btn-orange { background: var(--primary-orange); color: #FFFFFF; }
        .btn-orange:hover { background: var(--primary-orange-hover); }
        .btn-blue { background: #3b82f6; color: #FFFFFF; }
        .btn-blue:hover { background: #2563eb; }
        .btn-red { background: var(--error); color: #FFFFFF; }
        .btn-red:hover { background: #8f2c2c; }
    </style>
    @yield('styles')
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-icon"><i class="fa-solid fa-crown"></i></div>
            <div style="line-height: 1.1;">
                <div><span class="brand-text">Kha<span class="brand-accent">Catering</span></span></div>
                <small style="font-size: 0.65rem; font-weight: 600; color: var(--text-muted); letter-spacing: 1px;">ADMIN PANEL</small>
            </div>
        </div>

        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line"></i> Dashboard
            </a>

            <a href="{{ route('admin.menus.index') }}" class="menu-item {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
                <i class="fa-solid fa-utensils"></i> Kelola Menu (SCRUD)
            </a>

            <a href="{{ route('admin.orders.index') }}" class="menu-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="fa-solid fa-boxes-packing"></i> Kelola Pesanan (SCRUD)
            </a>

            <a href="{{ route('home') }}" class="menu-item" style="margin-top: auto;">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Web Utama
            </a>
        </div>
    </aside>

    <!-- CONTENT AREA -->
    <main class="admin-content">
        @if(session('success'))
            <div style="background: rgba(29, 163, 90, 0.1); border: 1px solid var(--success); color: #146C3C; padding: 1rem 1.5rem; border-radius: var(--radius-md); margin-bottom: 1.5rem; font-weight: 600;">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
