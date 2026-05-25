<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Admin Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" referrerpolicy="no-referrer">
    <style>
        /* ═══════════════════════ ROOT VARIABLES ═══════════════════════ */
        :root {
            --pink: #F27575;
            --pink-dark: #d95f5f;
            --pink-light: #FFC6C9;
            --pink-pale: #fff0f5;
            --pink-blush: #fffbfc;
            --sidebar-bg: #1a0a10;
            --sidebar-w: 240px;
            --header-h: 60px;
            --text: #1a0a10;
            --text-mid: #555;
            --text-light: #999;
            --border: #f0e8eb;
            --surface: #f7f4f5;
            --surface-2: #ffffff;
            --radius-sm: 8px;
            --radius: 14px;
            --radius-lg: 20px;
            --shadow: 0 2px 12px rgba(0, 0, 0, .07);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, .10);
            --t: 200ms cubic-bezier(.16, 1, .3, 1);
        }

        /* ═══════════════════════ RESET ═══════════════════════ */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            height: 100%;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--surface);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            -webkit-font-smoothing: antialiased;
            line-height: 1.6;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        img {
            display: block;
            max-width: 100%;
        }

        button {
            cursor: pointer;
            font: inherit;
            border: none;
            background: none;
        }

        input,
        select,
        textarea {
            font: inherit;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        /* ═══════════════════════ SIDEBAR ═══════════════════════ */
        .sidebar {
            width: var(--sidebar-w);
            flex-shrink: 0;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 200;
            transition: transform var(--t);
            overflow: hidden;
        }

        /* Logo */
        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px 18px 18px;
            border-bottom: 1px solid rgba(255, 255, 255, .07);
            flex-shrink: 0;
        }

        .sidebar-logo-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--pink);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(242, 117, 117, .4);
        }

        .sidebar-logo-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: 14px;
            color: #fff;
            line-height: 1.2;
            white-space: nowrap;
        }

        .sidebar-logo-text small {
            font-size: 10px;
            color: rgba(255, 255, 255, .35);
        }

        /* Nav */
        .sidebar-nav {
            flex: 1;
            padding: 10px 0;
            overflow-y: auto;
        }

        .sidebar-nav::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-nav::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, .1);
            border-radius: 4px;
        }

        .nav-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .12em;
            color: rgba(255, 255, 255, .28);
            padding: 14px 18px 5px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 18px;
            font-size: 13.5px;
            font-weight: 500;
            color: rgba(255, 255, 255, .6);
            position: relative;
            transition: background var(--t), color var(--t);
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, .07);
            color: #fff;
        }

        .nav-item.active {
            background: rgba(242, 117, 117, .15);
            color: var(--pink);
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 8px;
            bottom: 8px;
            width: 3px;
            background: var(--pink);
            border-radius: 0 3px 3px 0;
        }

        .nav-icon {
            width: 20px;
            text-align: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .nav-ext {
            margin-left: auto;
            font-size: 10px;
            opacity: .35;
        }

        /* Sidebar footer */
        .sidebar-footer {
            padding: 14px 18px 18px;
            border-top: 1px solid rgba(255, 255, 255, .07);
            flex-shrink: 0;
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--pink);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .user-info strong {
            display: block;
            font-size: 13px;
            color: #fff;
            font-weight: 600;
        }

        .user-info span {
            font-size: 10px;
            color: rgba(255, 255, 255, .38);
            text-transform: capitalize;
        }

        .btn-logout {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(242, 117, 117, .12);
            color: var(--pink);
            border: 1px solid rgba(242, 117, 117, .22);
            border-radius: var(--radius-sm);
            padding: 9px;
            font-size: 13px;
            font-weight: 600;
            transition: background var(--t), color var(--t), border-color var(--t);
        }

        .btn-logout:hover {
            background: var(--pink);
            color: #fff;
            border-color: var(--pink);
        }

        /* ═══════════════════════ MAIN WRAPPER ═══════════════════════ */
        .main-wrap {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: margin-left var(--t);
        }

        /* ═══════════════════════ TOPBAR ═══════════════════════ */
        .topbar {
            height: var(--header-h);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            background: var(--surface-2);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .04);
            flex-shrink: 0;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .hamburger-btn {
            display: none;
            width: 36px;
            height: 36px;
            border-radius: var(--radius-sm);
            align-items: center;
            justify-content: center;
            background: var(--pink-pale);
            color: var(--pink);
            font-size: 15px;
        }

        .page-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar-user {
            font-size: 13px;
            color: var(--text-mid);
            font-weight: 600;
        }

        .topbar-role {
            background: var(--pink-pale);
            color: var(--pink);
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
            text-transform: capitalize;
        }

        .topbar-website {
            display: flex;
            align-items: center;
            gap: 6px;
            background: var(--pink);
            color: #fff;
            padding: 7px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            transition: background var(--t);
        }

        .topbar-website:hover {
            background: var(--pink-dark);
        }

        /* ═══════════════════════ PAGE CONTENT ═══════════════════════ */
        .page-content {
            flex: 1;
            padding: 28px;
        }

        /* ═══════════════════════ FLASH ALERTS ═══════════════════════ */
        .alert {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }

        .alert-success {
            background: #edfdf5;
            color: #1a7a4a;
            border-color: #b3f0d0;
        }

        .alert-error {
            background: #fdf0f0;
            color: #c0392b;
            border-color: #f5b8b8;
        }

        .alert-warning {
            background: #fffbea;
            color: #856404;
            border-color: #fde68a;
        }

        .alert-close {
            margin-left: auto;
            font-size: 16px;
            opacity: .5;
            cursor: pointer;
            transition: opacity var(--t);
            background: none;
            border: none;
            color: inherit;
        }

        .alert-close:hover {
            opacity: 1;
        }

        /* ═══════════════════════ SHARED COMPONENTS ═══════════════════════ */

        /* Card */
        .card {
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: var(--shadow);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text);
        }

        /* Page Header */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .page-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: var(--text);
        }

        .page-header p {
            font-size: 13px;
            color: var(--text-light);
            margin-top: 2px;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 20px;
            border-radius: var(--radius-sm);
            font-size: 13px;
            font-weight: 600;
            border: 1.5px solid transparent;
            transition: background var(--t), color var(--t), border-color var(--t), box-shadow var(--t);
            cursor: pointer;
        }

        .btn-primary {
            background: var(--pink);
            color: #fff;
            border-color: var(--pink);
        }

        .btn-primary:hover {
            background: var(--pink-dark);
            border-color: var(--pink-dark);
            box-shadow: 0 4px 12px rgba(242, 117, 117, .3);
        }

        .btn-outline-pink {
            background: transparent;
            color: var(--pink);
            border-color: var(--pink);
        }

        .btn-outline-pink:hover {
            background: var(--pink-pale);
        }

        .btn-sm {
            padding: 6px 14px;
            font-size: 12px;
        }

        .btn-danger {
            background: #fff0f0;
            color: #e74c3c;
            border-color: #fcc;
        }

        .btn-danger:hover {
            background: #e74c3c;
            color: #fff;
            border-color: #e74c3c;
        }

        .btn-secondary {
            background: var(--surface);
            color: var(--text-mid);
            border-color: var(--border);
        }

        .btn-secondary:hover {
            background: var(--border);
            color: var(--text);
        }

        /* Table */
        .table-wrap {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
        }

        .table th {
            background: var(--surface);
            padding: 11px 14px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--text-light);
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        .table td {
            padding: 12px 14px;
            border-bottom: 1px solid #f5f0f2;
            color: var(--text-mid);
            vertical-align: middle;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table tbody tr:hover td {
            background: #fff9fb;
        }

        /* Badge */
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .badge-success {
            background: #edfdf5;
            color: #1a7a4a;
        }

        .badge-danger {
            background: #fff0f0;
            color: #e74c3c;
        }

        .badge-warning {
            background: #fffbea;
            color: #856404;
        }

        .badge-info {
            background: var(--pink-pale);
            color: var(--pink);
        }

        /* Form */
        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 14px;
            color: var(--text);
            background: var(--surface-2);
            transition: border-color var(--t), box-shadow var(--t);
            outline: none;
        }

        .form-control:focus {
            border-color: var(--pink);
            box-shadow: 0 0 0 3px rgba(242, 117, 117, .15);
        }

        .form-control::placeholder {
            color: var(--text-light);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23999' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 36px;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 90px;
        }

        .form-error {
            font-size: 12px;
            color: #e74c3c;
            margin-top: 4px;
        }

        .form-hint {
            font-size: 12px;
            color: var(--text-light);
            margin-top: 4px;
        }

        .invalid-feedback {
            font-size: 12px;
            color: #e74c3c;
            margin-top: 4px;
            display: block;
        }

        /* Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .45);
            z-index: 500;
            backdrop-filter: blur(2px);
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-overlay.show {
            display: flex;
            animation: fadeIn .2s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        .modal {
            background: var(--surface-2);
            border-radius: var(--radius-lg);
            width: 100%;
            max-width: 520px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .2);
            animation: slideUp .25s cubic-bezier(.16, 1, .3, 1);
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        @keyframes slideUp {
            from {
                transform: translateY(24px);
                opacity: 0
            }

            to {
                transform: translateY(0);
                opacity: 1
            }
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 24px 16px;
            border-bottom: 1px solid var(--border);
            flex-shrink: 0;
        }

        .modal-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text);
        }

        .modal-close {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            transition: background var(--t), color var(--t);
            font-size: 18px;
        }

        .modal-close:hover {
            background: var(--surface);
            color: var(--text);
        }

        .modal-body {
            padding: 24px;
            overflow-y: auto;
            flex: 1;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 16px 24px;
            border-top: 1px solid var(--border);
            flex-shrink: 0;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 48px 20px;
            color: var(--text-light);
        }

        .empty-state .empty-icon {
            font-size: 40px;
            margin-bottom: 12px;
        }

        .empty-state p {
            font-size: 14px;
        }

        /* ═══════════════════════ OVERLAY MOBILE ═══════════════════════ */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .5);
            z-index: 199;
            backdrop-filter: blur(2px);
        }

        .sidebar-overlay.show {
            display: block;
        }

        /* ═══════════════════════ RESPONSIVE ═══════════════════════ */
        @media (max-width: 900px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-wrap {
                margin-left: 0;
            }

            .hamburger-btn {
                display: flex;
            }

            .topbar-user,
            .topbar-role {
                display: none;
            }

            .topbar {
                padding: 0 16px;
            }
        }

        @media (max-width: 600px) {
            .page-content {
                padding: 16px;
            }

            .card {
                padding: 16px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
    @stack('styles')
</head>

<body>

    {{-- OVERLAY mobile --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- ═══════════════════ SIDEBAR ═══════════════════ --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <div class="sidebar-logo-icon">🍩</div>
            <div class="sidebar-logo-text">
                <h1>Maw Maw Donut</h1>
                <small>Admin Panel</small>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-label">Menu Utama</div>
            <a href="{{ route('dashboard') }}"
                class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-gauge-high"></i></span>
                Dashboard
            </a>
            <a href="{{ route('kategori.index') }}"
                class="nav-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-tags"></i></span>
                Kategori
            </a>
            <a href="{{ route('produk.index') }}"
                class="nav-item {{ request()->routeIs('produk.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-box-open"></i></span>
                Produk
            </a>

            @if(Auth::user()->role === 'superadmin')
            <div class="nav-label">Super Admin</div>
            <a href="{{ route('admins.index') }}"
                class="nav-item {{ request()->routeIs('admins.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-users-gear"></i></span>
                Kelola Admin
            </a>
            @endif

            <div class="nav-label">Website</div>
            <a href="{{ route('beranda') }}" target="_blank" rel="noopener" class="nav-item">
                <span class="nav-icon"><i class="fa-solid fa-globe"></i></span>
                Lihat Website
                <span class="nav-ext"><i class="fa-solid fa-arrow-up-right-from-square"></i></span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div class="user-info">
                    <strong>{{ Auth::user()->name }}</strong>
                    <span>{{ Auth::user()->role }}</span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- ═══════════════════ MAIN WRAP ═══════════════════ --}}
    <div class="main-wrap">

        <header class="topbar">
            <div class="topbar-left">
                <button class="hamburger-btn" id="hamburgerBtn" aria-label="Toggle sidebar">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <span class="page-title">@yield('page-title', 'Dashboard')</span>
            </div>
            <div class="topbar-right">
                <span class="topbar-user">{{ Auth::user()->name }}</span>
                <span class="topbar-role">{{ Auth::user()->role }}</span>
                <a href="{{ route('beranda') }}" target="_blank" class="topbar-website">
                    <i class="fa-solid fa-globe"></i> Website
                </a>
            </div>
        </header>

        <main class="page-content">
            @if(session('success'))
            <div class="alert alert-success" id="flash-msg">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
                <button class="alert-close" onclick="this.parentElement.remove()">&times;</button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-error" id="flash-msg">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ session('error') }}
                <button class="alert-close" onclick="this.parentElement.remove()">&times;</button>
            </div>
            @endif
            @if(session('warning'))
            <div class="alert alert-warning">
                <i class="fa-solid fa-triangle-exclamation"></i>
                {{ session('warning') }}
                <button class="alert-close" onclick="this.parentElement.remove()">&times;</button>
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        (function() {
            var sidebar = document.getElementById('sidebar');
            var overlay = document.getElementById('sidebarOverlay');
            var hamburger = document.getElementById('hamburgerBtn');
            var isOpen = false;

            function open() {
                isOpen = true;
                sidebar.classList.add('open');
                overlay.classList.add('show');
                document.body.style.overflow = 'hidden';
            }

            function close() {
                isOpen = false;
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
                document.body.style.overflow = '';
            }

            if (hamburger) hamburger.addEventListener('click', function() {
                isOpen ? close() : open();
            });
            if (overlay) overlay.addEventListener('click', close);
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && isOpen) close();
            });

            // Auto dismiss flash
            var flash = document.getElementById('flash-msg');
            if (flash) setTimeout(function() {
                flash.style.transition = 'opacity .5s';
                flash.style.opacity = '0';
                setTimeout(function() {
                    flash.remove();
                }, 500);
            }, 4000);
        })();
    </script>
    @stack('scripts')
</body>

</html>