<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Perusahaan — {{ $profile->nama_perusahaan ?? 'Maw Maw Donut' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" referrerpolicy="no-referrer">
    <style>
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Roboto, sans-serif;
            background: #fff;
            color: #1a0a10;
        }

        img {
            display: block;
            max-width: 100%;
            height: auto;
        }

        a {
            color: inherit;
            transition: color .3s;
        }

        button {
            cursor: pointer;
            font: inherit;
        }

        /* ── NAVBAR ───────────────────────────────────────────── */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 8%;
            background: #FFFEFA;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .logo-section img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid #F27575;
            object-fit: cover;
        }

        .logo-fallback {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #F27575;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .logo-text h1 {
            font-size: 18px;
            color: #F27575;
            font-weight: bold;
        }

        .logo-text p {
            font-size: 11px;
            color: #666;
        }

        .nav-links {
            display: flex;
            gap: 25px;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #444;
            font-size: 14px;
            font-weight: 600;
            transition: .3s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #F27575;
        }

        .btn-wa {
            background: #F27575;
            color: #fff !important;
            padding: 10px 22px;
            border-radius: 20px;
            font-size: 13px;
        }

        .btn-wa:hover {
            background: #e06464;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            background: none;
            border: none;
            padding: 6px;
        }

        .hamburger span {
            display: block;
            width: 24px;
            height: 2px;
            background: #F27575;
            border-radius: 2px;
            transition: transform .3s, opacity .3s;
        }

        .hamburger.open span:nth-child(1) {
            transform: translateY(7px) rotate(45deg);
        }

        .hamburger.open span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.open span:nth-child(3) {
            transform: translateY(-7px) rotate(-45deg);
        }

        .mobile-nav {
            display: none;
            flex-direction: column;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #FFFEFA;
            border-top: 1px solid #ffe0e8;
            border-bottom: 2px solid #FFC6C9;
            padding: 8px 8% 16px;
            gap: 0;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
        }

        .mobile-nav.open {
            display: flex;
        }

        .mobile-nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 0;
            font-size: 15px;
            font-weight: 600;
            color: #444;
            text-decoration: none;
            border-bottom: 1px solid #ffe0e8;
        }

        .mobile-nav a:last-child {
            border-bottom: none;
        }

        .mobile-nav a:hover,
        .mobile-nav a.active {
            color: #F27575;
        }

        /* ── HERO ─────────────────────────────────────────────── */
        .profil-hero {
            background: linear-gradient(135deg, #F27575, #FFC6C9);
            padding: 70px 8%;
            color: #fff;
            text-align: center;
        }

        .profil-hero h1 {
            font-size: 42px;
            margin-bottom: 12px;
            font-weight: 800;
        }

        .profil-hero p {
            font-size: 16px;
            opacity: .9;
            max-width: 560px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* ── PROFIL SECTION (logo + deskripsi) ────────────────── */
        .profil-section {
            padding: 80px 10%;
            background: #fff;
            text-align: center;
        }

        .profil-container {
            max-width: 860px;
            margin: 0 auto;
            background: #fff;
            padding: 56px 50px;
            border-radius: 28px;
            box-shadow: 0 16px 50px rgba(0, 0, 0, .1);
        }

        .profil-container .logo-wrap {
            display: flex;
            justify-content: center;
            margin-bottom: 28px;
        }

        .profil-container .logo-wrap img {
            width: 120px;
            height: 120px;
            object-fit: contain;
            border-radius: 16px;
            border: 2px solid #ffe0e8;
            padding: 10px;
            background: #fff;
        }

        .profil-container .logo-placeholder {
            width: 120px;
            height: 120px;
            border-radius: 16px;
            background: #fce4ec;
            border: 2px dashed #F27575;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
        }

        .profil-container h2 {
            font-size: 30px;
            color: #F27575;
            margin-bottom: 24px;
            font-weight: bold;
        }

        .profil-container p {
            font-size: 16px;
            color: #555;
            line-height: 1.9;
            margin-bottom: 16px;
        }

        .btn-pink {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #F27575;
            color: #fff;
            padding: 13px 30px;
            border-radius: 24px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            box-shadow: 0 6px 20px rgba(242, 117, 117, .28);
            transition: background .2s, transform .2s;
            margin-top: 20px;
        }

        .btn-pink:hover {
            background: #d95f5f;
            transform: translateY(-2px);
        }

        /* ── SEJARAH SECTION ──────────────────────────────────── */
        .sejarah-section {
            padding: 60px 10%;
            background: #FFFEFA;
        }

        .sejarah-container {
            max-width: 860px;
            margin: 0 auto;
            background: #fff;
            padding: 56px 50px;
            border-radius: 28px;
            box-shadow: 0 16px 50px rgba(0, 0, 0, .1);
        }

        .sejarah-container h2 {
            font-size: 30px;
            color: #F27575;
            margin-bottom: 28px;
            font-weight: bold;
            text-align: center;
        }

        .sejarah-container p {
            font-size: 16px;
            color: #555;
            line-height: 1.9;
            margin-bottom: 18px;
        }

        /* ── INFO CARDS ───────────────────────────────────────── */
        .info-section {
            background: #fff;
            padding: 60px 8%;
        }

        .info-section>h2 {
            text-align: center;
            font-size: 26px;
            color: #F27575;
            margin-bottom: 36px;
            font-weight: bold;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 24px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .info-card {
            background: #fff;
            border-radius: 16px;
            padding: 30px 24px;
            text-align: center;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .06);
        }

        .info-card i {
            font-size: 32px;
            color: #F27575;
            margin-bottom: 16px;
            display: block;
        }

        .info-card h3 {
            font-size: 16px;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }

        .info-card p,
        .info-card a {
            font-size: 14px;
            color: #777;
            line-height: 1.7;
            text-decoration: none;
        }

        .info-card a:hover {
            color: #F27575;
        }

        .wa-cta-wrap {
            text-align: center;
            margin-top: 40px;
        }

        .btn-wa-big {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #25d366;
            color: #fff;
            padding: 14px 36px;
            border-radius: 28px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 700;
            box-shadow: 0 6px 20px rgba(37, 211, 102, .3);
            transition: background .2s, transform .2s;
        }

        .btn-wa-big:hover {
            background: #1ebe5d;
            transform: translateY(-2px);
        }

        /* ── FOOTER ───────────────────────────────────────────── */
        footer {
            background: #1a1a1a;
            color: #999;
            padding: 60px 8% 40px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 30px;
        }

        .footer-col h4 {
            color: #fff;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .footer-col p,
        .footer-col a {
            color: #bbb;
            font-size: 14px;
            margin-bottom: 10px;
            text-decoration: none;
            display: block;
        }

        .footer-col a:hover {
            color: #F27575;
        }

        .footer-bottom {
            background: #111;
            color: #666;
            text-align: center;
            padding: 15px;
            font-size: 13px;
        }

        /* ── RESPONSIVE ───────────────────────────────────────── */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hamburger {
                display: flex;
            }

            .profil-hero h1 {
                font-size: 28px;
            }

            .profil-container,
            .sejarah-container {
                padding: 36px 20px;
            }

            .info-grid {
                grid-template-columns: 1fr 1fr;
            }

            footer {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    @php
    $namaToko = $profile->nama_perusahaan ?? 'Maw Maw Donut';
    $deskripsi = $profile->deskripsi ?? null;
    $sejarah = $profile->sejarah ?? null;
    $telepon = $profile->telepon ?? '081528844756';
    $email = $profile->email ?? 'mawmawdonut@gmail.com';
    $alamat = $profile->alamat ?? 'Cabang Pusat Maw Maw Donut';
    $logoUrl = ($profile->logo ?? null) ? $profile->logo_url : null;
    $waNumber = $profile->wa_number ?? '081528844756';
    @endphp

    {{-- ═══════════ NAVBAR ═══════════ --}}
    <nav id="navbar">
        <a class="logo-section" href="{{ route('beranda') }}">
            @if($logoUrl)
            <img src="{{ $logoUrl }}" alt="{{ $namaToko }}">
            @else
            <div class="logo-fallback" aria-hidden="true">🍩</div>
            @endif
            <div class="logo-text">
                <h1>{{ $namaToko }}</h1>
                <p>Maw-nya keterusan</p>
            </div>
        </a>

        <div class="nav-links">
            <a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil')  ? 'active' : '' }}">Profil</a>
            <a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang Kami</a>
            <a href="{{ route('katalog') }}" class="{{ request()->routeIs('katalog') ? 'active' : '' }}">Katalog Produk</a>
            <a href="https://wa.me/{{ $waNumber }}" class="btn-wa" target="_blank" rel="noopener noreferrer">
                <i class="fab fa-whatsapp"></i> Chat Via WhatsApp
            </a>
        </div>

        <button class="hamburger" id="hamburgerBtn" aria-label="Buka menu" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
    </nav>

    <div class="mobile-nav" id="mobileNav" role="navigation" aria-label="Menu mobile">
        <a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda') ? 'active' : '' }}">
            <i class="fas fa-house" style="color:#F27575;width:18px"></i> Beranda
        </a>
        <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}">
            <i class="fas fa-building" style="color:#F27575;width:18px"></i> Profil Perusahaan
        </a>
        <a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'active' : '' }}">
            <i class="fas fa-circle-info" style="color:#F27575;width:18px"></i> Tentang Kami
        </a>
        <a href="{{ route('katalog') }}" class="{{ request()->routeIs('katalog') ? 'active' : '' }}">
            <i class="fas fa-shop" style="color:#F27575;width:18px"></i> Katalog Produk
        </a>
        <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener noreferrer" style="color:#F27575;">
            <i class="fab fa-whatsapp" style="width:18px"></i> Pesan via WhatsApp
        </a>
    </div>

    {{-- ═══════════ HERO ═══════════ --}}
    <section class="profil-hero">
        <h1>🏢 Profil Perusahaan</h1>
        <p>{{ $deskripsi ? Str::limit($deskripsi, 160) : 'Brand lokal yang menyajikan kebahagiaan lewat donat lembut dengan beragam topping kekinian.' }}</p>
    </section>

    {{-- ═══════════ PROFIL (Logo + Deskripsi) ═══════════ --}}
    <section class="profil-section">
        <div class="profil-container">

            {{-- Logo --}}
            <div class="logo-wrap">
                @if($logoUrl)
                <img src="{{ $logoUrl }}" alt="Logo {{ $namaToko }}" loading="lazy">
                @else
                <div class="logo-placeholder">🍩</div>
                @endif
            </div>

            <h2>{{ $namaToko }}</h2>

            @if($deskripsi)
            @foreach(array_filter(explode("\n", $deskripsi)) as $par)
            <p>{{ trim($par) }}</p>
            @endforeach
            @else
            <p>Maw Maw Donut adalah brand lokal yang hadir untuk menghadirkan donat lezat dan berkualitas bagi para pecinta camilan manis.</p>
            <p>Kami berkomitmen menjaga konsistensi rasa dan kualitas pada setiap produk yang kami sajikan, dibuat dari bahan pilihan dengan proses yang higienis.</p>
            @endif

            <a href="{{ route('katalog') }}" class="btn-pink">
                🍩 Lihat Katalog Produk
            </a>
        </div>
    </section>

    {{-- ═══════════ SEJARAH ═══════════ --}}
    @if($sejarah)
    <section class="sejarah-section">
        <div class="sejarah-container">
            <h2>Sejarah {{ $namaToko }}</h2>
            @foreach(array_filter(explode("\n", $sejarah)) as $par)
            <p>{{ trim($par) }}</p>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ═══════════ INFO CARDS ═══════════ --}}
    <section class="info-section">
        <h2>Informasi Kontak</h2>
        <div class="info-grid">

            <div class="info-card">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Alamat</h3>
                <p>{{ $alamat }}</p>
            </div>

            <div class="info-card">
                <i class="fab fa-whatsapp"></i>
                <h3>WhatsApp</h3>
                <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener noreferrer">{{ $telepon }}</a>
            </div>

            <div class="info-card">
                <i class="fas fa-envelope"></i>
                <h3>Email</h3>
                <a href="mailto:{{ $email }}">{{ $email }}</a>
            </div>

        </div>

        @if($waNumber)
        <div class="wa-cta-wrap">
            <a href="https://wa.me/{{ $waNumber }}" class="btn-wa-big" target="_blank" rel="noopener noreferrer">
                <i class="fab fa-whatsapp"></i> Pesan Sekarang via WhatsApp
            </a>
        </div>
        @endif
    </section>

    {{-- ═══════════ FOOTER ═══════════ --}}
    <footer>
        <div class="footer-col">
            <h4>Kontak Kami</h4>
            <p><i class="fas fa-map-marker-alt"></i> {{ $alamat }}</p>
            <p><i class="fab fa-whatsapp"></i> {{ $telepon }}</p>
            <p><i class="fas fa-envelope"></i> {{ $email }}</p>
        </div>
        <div class="footer-col">
            <h4>Link Cepat</h4>
            <a href="{{ route('beranda') }}">Beranda</a>
            <a href="{{ route('profil') }}">Profil Perusahaan</a>
            <a href="{{ route('tentang') }}">Tentang Kami</a>
            <a href="{{ route('katalog') }}">Katalog Produk</a>
        </div>
    </footer>
    <div class="footer-bottom">
        &copy; {{ date('Y') }} {{ $namaToko }}. All rights reserved.
        &nbsp;&nbsp;
        <a href="{{ route('login') }}" style="color:#555; text-decoration:none;">Admin</a>
    </div>

    {{-- ═══════════ SCRIPTS ═══════════ --}}
    <script>
        var btn = document.getElementById('hamburgerBtn');
        var nav = document.getElementById('mobileNav');
        var isOpen = false;

        function openMenu() {
            isOpen = true;
            nav.classList.add('open');
            btn.classList.add('open');
            btn.setAttribute('aria-expanded', 'true');
            btn.setAttribute('aria-label', 'Tutup menu');
        }

        function closeMenu() {
            isOpen = false;
            nav.classList.remove('open');
            btn.classList.remove('open');
            btn.setAttribute('aria-expanded', 'false');
            btn.setAttribute('aria-label', 'Buka menu');
        }
        if (btn) btn.addEventListener('click', function(e) {
            e.stopPropagation();
            isOpen ? closeMenu() : openMenu();
        });
        document.addEventListener('click', function(e) {
            if (isOpen && !nav.contains(e.target) && !btn.contains(e.target)) closeMenu();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isOpen) closeMenu();
        });
    </script>

</body>

</html>