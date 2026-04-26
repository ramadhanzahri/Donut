<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard') — Mawmaw Donut Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
  <style>
    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   TOKENS
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    :root {
      --pink: #e91e8c;
      --pink-hover: #c2185b;
      --pink-pale: #fce4ec;
      --pink-blush: #fff0f5;
      --sidebar-bg: #1a0a10;
      --sidebar-w: 248px;
      --topbar-h: 62px;
      --text: #1a0a10;
      --text-muted: #6d3252;
      --text-light: #b07090;
      --border: #f0c0d8;
      --bg: #fdf6f9;
      --white: #ffffff;
      --success-bg: #e8f5e9;
      --success-text: #2e7d32;
      --success-bdr: #a5d6a7;
      --error-bg: #ffebee;
      --error-text: #c62828;
      --error-bdr: #ef9a9a;
      --radius-sm: 8px;
      --radius: 12px;
      --radius-lg: 16px;
      --shadow-sm: 0 1px 4px rgba(0, 0, 0, .06);
      --shadow-md: 0 4px 16px rgba(0, 0, 0, .08);
      --t: 180ms cubic-bezier(.16, 1, .3, 1);
    }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   BASE
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html {
      scroll-padding-top: var(--topbar-h);
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      color: var(--text);
      display: flex;
      min-height: 100vh;
      -webkit-font-smoothing: antialiased;
    }

    img {
      display: block;
      max-width: 100%;
    }

    button {
      cursor: pointer;
      font: inherit;
      color: inherit;
      background: none;
      border: none;
    }

    a,
    button,
    input,
    select,
    textarea {
      transition: color var(--t), background var(--t),
        border-color var(--t), box-shadow var(--t), transform var(--t);
    }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   SIDEBAR
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    .sidebar {
      width: var(--sidebar-w);
      background: var(--sidebar-bg);
      min-height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      display: flex;
      flex-direction: column;
      z-index: 200;
      box-shadow: 2px 0 24px rgba(0, 0, 0, .18);
      transition: transform .3s cubic-bezier(.4, 0, .2, 1);
      overflow-y: auto;
    }

    /* Brand */
    .sidebar-brand {
      padding: 26px 20px 18px;
      border-bottom: 1px solid rgba(255, 255, 255, .07);
      display: flex;
      align-items: center;
      gap: 12px;
      flex-shrink: 0;
    }

    .brand-icon {
      width: 42px;
      height: 42px;
      background: var(--pink);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      flex-shrink: 0;
      box-shadow: 0 4px 14px rgba(233, 30, 140, .38);
    }

    .brand-text h2 {
      font-size: 15px;
      font-weight: 700;
      color: #fff;
      line-height: 1.2;
    }

    .brand-text p {
      font-size: 11px;
      color: rgba(255, 255, 255, .35);
      margin-top: 2px;
    }

    /* Nav */
    .sidebar-nav {
      padding: 14px 10px;
      flex: 1;
    }

    .nav-label {
      font-size: 10px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .12em;
      color: rgba(255, 255, 255, .25);
      padding: 14px 10px 6px;
    }

    .nav-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 11px 12px;
      border-radius: 10px;
      text-decoration: none;
      color: rgba(255, 255, 255, .52);
      font-size: 14px;
      font-weight: 500;
      margin-bottom: 2px;
    }

    .nav-item:hover {
      background: rgba(255, 255, 255, .07);
      color: #fff;
    }

    .nav-item.active {
      background: var(--pink);
      color: #fff;
      box-shadow: 0 4px 14px rgba(233, 30, 140, .32);
    }

    .nav-icon {
      font-size: 16px;
      width: 20px;
      text-align: center;
      flex-shrink: 0;
    }

    .nav-ext {
      margin-left: auto;
      font-size: 11px;
      opacity: .45;
    }

    /* Footer */
    .sidebar-footer {
      padding: 14px 10px 20px;
      border-top: 1px solid rgba(255, 255, 255, .07);
      flex-shrink: 0;
    }

    .user-card {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 12px;
      border-radius: 10px;
      background: rgba(255, 255, 255, .05);
      margin-bottom: 8px;
    }

    .user-avatar {
      width: 36px;
      height: 36px;
      background: var(--pink);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      font-weight: 700;
      color: #fff;
      flex-shrink: 0;
    }

    .user-detail p {
      font-size: 13px;
      font-weight: 600;
      color: #fff;
      line-height: 1.3;
    }

    .user-detail span {
      font-size: 11px;
      color: rgba(255, 255, 255, .35);
      text-transform: capitalize;
    }

    .btn-logout {
      display: flex;
      align-items: center;
      gap: 9px;
      width: 100%;
      padding: 10px 12px;
      border-radius: 10px;
      background: rgba(255, 255, 255, .04);
      color: rgba(255, 255, 255, .42);
      font-size: 13px;
      font-weight: 500;
    }

    .btn-logout:hover {
      background: rgba(220, 50, 50, .18);
      color: #ff8a80;
    }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   MAIN AREA
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    .main {
      margin-left: var(--sidebar-w);
      flex: 1;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* Topbar */
    .topbar {
      background: var(--white);
      border-bottom: 1px solid var(--border);
      padding: 0 28px;
      height: var(--topbar-h);
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 100;
      box-shadow: var(--shadow-sm);
      flex-shrink: 0;
    }

    .topbar-left {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .topbar-right {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .sidebar-toggle {
      display: none;
      padding: 7px;
      border-radius: var(--radius-sm);
      color: var(--text-muted);
      font-size: 18px;
      line-height: 1;
    }

    .sidebar-toggle:hover {
      background: var(--pink-blush);
      color: var(--pink);
    }

    .topbar-title {
      font-size: 15px;
      font-weight: 600;
      color: var(--text);
    }

    .role-badge {
      background: var(--pink-pale);
      color: var(--pink);
      font-size: 11px;
      font-weight: 700;
      padding: 4px 12px;
      border-radius: 20px;
      text-transform: capitalize;
    }

    .topbar-user {
      font-size: 14px;
      color: var(--text-muted);
      font-weight: 500;
    }

    /* Content */
    .content {
      padding: 28px 32px;
      flex: 1;
    }

    /* Overlay (mobile) */
    .overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, .46);
      z-index: 150;
    }

    .overlay.open {
      display: block;
    }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   PAGE HEADER
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    .page-header {
      margin-bottom: 24px;
    }

    .page-header h2 {
      font-size: 21px;
      font-weight: 700;
      margin-bottom: 4px;
    }

    .page-header p {
      font-size: 13px;
      color: var(--text-light);
    }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   ALERTS
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    .alert {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 13px 16px;
      border-radius: var(--radius);
      font-size: 14px;
      margin-bottom: 20px;
    }

    .alert-success {
      background: var(--success-bg);
      border: 1px solid var(--success-bdr);
      color: var(--success-text);
    }

    .alert-error {
      background: var(--error-bg);
      border: 1px solid var(--error-bdr);
      color: var(--error-text);
    }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   CARD
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    .card {
      background: var(--white);
      border-radius: var(--radius-lg);
      border: 1px solid var(--border);
      overflow: hidden;
      box-shadow: var(--shadow-sm);
    }

    .card+.card {
      margin-top: 22px;
    }

    .card-top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 18px 22px;
      border-bottom: 1px solid var(--border);
    }

    .card-title {
      font-size: 15px;
      font-weight: 600;
    }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   BUTTONS
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    .btn-primary {
      background: var(--pink);
      color: #fff;
      padding: 10px 20px;
      border-radius: var(--radius);
      font-size: 13px;
      font-weight: 600;
      box-shadow: 0 4px 12px rgba(233, 30, 140, .22);
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .btn-primary:hover {
      background: var(--pink-hover);
    }

    .btn-primary:active {
      transform: scale(.97);
    }

    .btn-secondary {
      background: var(--pink-pale);
      color: var(--pink);
      border: 1px solid var(--border);
      padding: 10px 18px;
      border-radius: var(--radius);
      font-size: 13px;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .btn-secondary:hover {
      background: #f8d7e5;
    }

    .btn-danger {
      background: var(--error-bg);
      color: var(--error-text);
      border: 1px solid var(--error-bdr);
      padding: 7px 13px;
      border-radius: var(--radius-sm);
      font-size: 12px;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }

    .btn-danger:hover {
      background: #ffcdd2;
    }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   TABLE
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    .table-wrap {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead th {
      background: var(--pink-blush);
      color: var(--text-muted);
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .06em;
      padding: 12px 16px;
      text-align: left;
      border-bottom: 1px solid var(--border);
      white-space: nowrap;
    }

    tbody td {
      padding: 14px 16px;
      font-size: 14px;
      color: var(--text);
      border-bottom: 1px solid #fde8f0;
      vertical-align: middle;
    }

    tbody tr:last-child td {
      border-bottom: none;
    }

    tbody tr:hover td {
      background: var(--pink-blush);
    }

    .empty-row td {
      text-align: center;
      color: var(--text-light);
      padding: 50px;
      font-size: 14px;
    }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   BADGES
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    .badge {
      display: inline-block;
      padding: 4px 11px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
    }

    .badge-aktif {
      background: #e8f5e9;
      color: #2e7d32;
    }

    .badge-nonaktif {
      background: #f5f5f5;
      color: #757575;
    }

    .badge-admin {
      background: var(--pink-pale);
      color: var(--pink);
    }

    .badge-super {
      background: #ede7f6;
      color: #6a1b9a;
    }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   FORM (inline / add form)
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    .add-form-wrap {
      display: none;
      padding: 24px;
      background: var(--pink-blush);
      border-bottom: 1px solid var(--border);
    }

    .add-form-wrap.open {
      display: block;
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    .form-field {
      display: flex;
      flex-direction: column;
      gap: 6px;
      margin-bottom: 16px;
    }

    .form-field label {
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .06em;
      color: var(--text-muted);
    }

    .form-field input,
    .form-field select,
    .form-field textarea {
      padding: 11px 14px;
      border: 1.5px solid var(--border);
      border-radius: var(--radius);
      font-family: 'DM Sans', sans-serif;
      font-size: 14px;
      color: var(--text);
      background: var(--white);
      outline: none;
    }

    .form-field input:focus,
    .form-field select:focus,
    .form-field textarea:focus {
      border-color: var(--pink);
      box-shadow: 0 0 0 3px rgba(233, 30, 140, .08);
    }

    .form-field textarea {
      resize: vertical;
      min-height: 90px;
    }

    .field-error {
      font-size: 12px;
      color: var(--error-text);
    }

    .img-preview {
      border-radius: var(--radius);
      max-height: 120px;
      object-fit: cover;
      margin-top: 8px;
    }

    .mono {
      font-family: 'Courier New', monospace;
      font-size: 13px;
      background: #f8f0f5;
      padding: 2px 7px;
      border-radius: 5px;
    }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   MODAL
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    .modal-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, .46);
      z-index: 300;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .modal-overlay.open {
      display: flex;
    }

    .modal {
      background: var(--white);
      border-radius: 18px;
      padding: 32px;
      width: 480px;
      max-width: 100%;
      max-height: 90vh;
      overflow-y: auto;
      box-shadow: 0 24px 60px rgba(0, 0, 0, .2);
      animation: modalIn .25s cubic-bezier(.22, 1, .36, 1);
    }

    @keyframes modalIn {
      from {
        opacity: 0;
        transform: scale(.93) translateY(22px);
      }

      to {
        opacity: 1;
        transform: scale(1) translateY(0);
      }
    }

    .modal h3 {
      font-size: 18px;
      font-weight: 700;
      margin-bottom: 22px;
    }

    .modal-actions {
      display: flex;
      gap: 10px;
      justify-content: flex-end;
      margin-top: 22px;
    }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   STATS GRID
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(175px, 1fr));
      gap: 18px;
      margin-bottom: 26px;
    }

    .stat-card {
      background: var(--white);
      border-radius: var(--radius-lg);
      padding: 20px;
      border: 1px solid var(--border);
      display: flex;
      align-items: center;
      gap: 14px;
      box-shadow: var(--shadow-sm);
      transition: box-shadow var(--t), transform var(--t);
    }

    .stat-card:hover {
      box-shadow: var(--shadow-md);
      transform: translateY(-2px);
    }

    .stat-icon {
      width: 48px;
      height: 48px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      flex-shrink: 0;
    }

    .stat-body p {
      font-size: 12px;
      color: var(--text-light);
      margin-bottom: 3px;
    }

    .stat-body h3 {
      font-size: 26px;
      font-weight: 700;
      line-height: 1;
    }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   RESPONSIVE
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    @media (max-width: 960px) {
      .sidebar {
        transform: translateX(-100%);
      }

      .sidebar.open {
        transform: translateX(0);
      }

      .main {
        margin-left: 0;
      }

      .sidebar-toggle {
        display: flex;
        align-items: center;
      }

      .content {
        padding: 18px 16px;
      }

      .form-grid {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 560px) {
      .topbar {
        padding: 0 16px;
      }

      .stats-grid {
        grid-template-columns: 1fr 1fr;
      }
    }
  </style>
  @stack('styles')
</head>

<body>

  <!-- Overlay untuk close sidebar di mobile -->
  <div class="overlay" id="sidebarOverlay"></div>

  <!-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
     SIDEBAR
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
  {{--
  PATCH untuk app.blade.php
  ─────────────────────────
  Hapus baris berikut dari bagian sidebar-nav:

      <a href="{{ route('profile-perusahaan.index') }}"
         class="nav-item {{ request()->routeIs('profile-perusahaan.*') ? 'active' : '' }}">
          <span class="nav-icon">🏢</span> Profil Perusahaan
      </a>

  Sidebar nav seharusnya menjadi:
--}}

<nav class="sidebar-nav" aria-label="Navigasi admin">
    <div class="nav-label">Menu Utama</div>

    <a href="{{ route('dashboard') }}"
       class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <span class="nav-icon">📊</span> Dashboard
    </a>

    <a href="{{ route('kategori.index') }}"
       class="nav-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
        <span class="nav-icon">🏷️</span> Kategori
    </a>

    <a href="{{ route('produk.index') }}"
       class="nav-item {{ request()->routeIs('produk.*') ? 'active' : '' }}">
        <span class="nav-icon">🍩</span> Produk
    </a>

    @if(Auth::user()->isSuperAdmin())
    <div class="nav-label">Super Admin</div>
    <a href="{{ route('admins.index') }}"
       class="nav-item {{ request()->routeIs('admins.*') ? 'active' : '' }}">
        <span class="nav-icon">👥</span> Kelola Admin
    </a>
    @endif

    <div class="nav-label">Website</div>
    <a href="{{ route('beranda') }}" target="_blank" rel="noopener" class="nav-item">
        <span class="nav-icon">🌐</span> Lihat Website
        <span class="nav-ext">↗</span>
    </a>
</nav>


  <!-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
     MAIN
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
  <div class="main">

    <header class="topbar">
      <div class="topbar-left">
        <button class="sidebar-toggle" id="sidebarToggle"
          aria-label="Buka/tutup sidebar">☰</button>
        <span class="topbar-title">@yield('title', 'Dashboard')</span>
      </div>
      <div class="topbar-right">
        <span class="role-badge">{{ Auth::user()->role }}</span>
        <span class="topbar-user">{{ Auth::user()->name }}</span>
      </div>
    </header>

    <main class="content">
      @yield('content')
    </main>

  </div>

  <script>
    (function() {
      var toggle = document.getElementById('sidebarToggle');
      var sidebar = document.getElementById('sidebar');
      var overlay = document.getElementById('sidebarOverlay');

      function openSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
      }

      function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('open');
        document.body.style.overflow = '';
      }

      if (toggle) toggle.addEventListener('click', openSidebar);
      if (overlay) overlay.addEventListener('click', closeSidebar);

      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeSidebar();
      });
    })();
  </script>
  @stack('scripts')
</body>

</html>