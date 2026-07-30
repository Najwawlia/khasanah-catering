<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Khasanah Catering')</title>

    <!-- Google Fonts & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
            display: flex;
            min-height: 100vh;
        }

        a { color: inherit; text-decoration: none; }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 260px;
            background: #181818;
            border-right: 1px solid var(--border-color);
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 2.5rem;
        }

        .sidebar-brand span { color: var(--primary-orange); }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--text-secondary);
            border-radius: var(--radius-md);
            font-weight: 600;
            transition: all var(--transition-speed);
        }

        .menu-item:hover, .menu-item.active {
            background: rgba(255, 102, 0, 0.15);
            color: var(--primary-orange);
            border-left: 3px solid var(--primary-orange);
        }

        .admin-content {
            flex: 1;
            padding: 2.5rem;
            overflow-y: auto;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .admin-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--text-primary);
        }

        /* --- TABLES & CARDS --- */
        .card-table {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
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
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

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

        .btn-orange { background: var(--primary-orange); color: var(--text-primary); }
        .btn-orange:hover { background: var(--primary-orange-hover); }
        .btn-blue { background: #3b82f6; color: var(--text-primary); }
        .btn-blue:hover { background: #2563eb; }
        .btn-red { background: var(--error); color: var(--text-primary); }
        .btn-red:hover { background: #dc2626; }
    </style>
    @yield('styles')
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <i class="fa-solid fa-crown" style="color: var(--primary-orange);"></i>
            Kha<span>Admin</span>
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
            <div style="background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; color: #34d399; padding: 1rem 1.5rem; border-radius: var(--radius-md); margin-bottom: 1.5rem; font-weight: 600;">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
