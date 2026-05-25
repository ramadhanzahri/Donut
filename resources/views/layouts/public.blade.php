<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Maw Maw Donut') – {{ $profile->nama_perusahaan ?? 'Maw Maw Donut' }}</title>
    <meta name="description" content="@yield('metadesc', 'Maw Maw Donut — Donat lezat dengan beragam topping kekinian.')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" referrerpolicy="no-referrer">

    <style>
        /* ── TOKENS ── */
        :root {
            --pink: #F27575;
            --pink-dark: #d95f5f;
            --pink-light: #FFC6C9;
            --pink-pale: #fff0f5;
            --pink-blush: #FFFEFA;
            --text: #1a0a10;
            --text-mid: #555;
            --text-light: #999;
            --border: #ffe0e8;
            --white: #ffffff;
            --radius-sm: 8px;
            --radius: 16px;
            --radius-lg: 24px;
            --shadow: 0 4px 20px rgba(242, 117, 117, .12);
            --t: 220ms cubic-bezier(.16, 1, .3, 1);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        html {
            scroll-behavior: smooth
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #fff;
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            line-height: 1.6;
            background-image: url('/images/pattern_donat.jpg');
            background-repeat: repeat;
            background-size: 420px;
            background-attachment: fixed;
            background-blend-mode: overlay;
            background-color: rgba(255, 255, 255, .93)
        }

        /* ── PAGE BG IMAGE HERO ── */
        .page-hero-bg {
            position: relative;
            overflow: hidden
        }

        .page-hero-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            z-index: 0
        }

        .page-hero-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 1
        }

        .page-hero-bg>* {
            position: relative;
            z-index: 2
        }

        /* ── SECTION PATTERN DIVIDER ── */
        .section-bg-pattern {
            position: relative;
            overflow: hidden
        }

        .section-bg-pattern::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('/images/pattern_donat.jpg');
            background-size: 300px;
            background-repeat: repeat;
            opacity: .04;
            pointer-events: none;
            z-index: 0
        }

        .section-bg-pattern>* {
            position: relative;
            z-index: 1
        }

        /* ── FROSTING DIVIDER ── */
        .frosting-divider {
            width: 100%;
            height: 120px;
            background: url('/images/bg2.jpg') top center/cover no-repeat;
            margin: 0;
            display: block;
            opacity: .85;
            pointer-events: none
        }

        img {
            display: block;
            max-width: 100%;
            height: auto
        }

        a {
            color: inherit;
            transition: color var(--t)
        }

        button {
            cursor: pointer;
            font: inherit
        }

        /* ── NAVBAR ── */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 6%;
            background: var(--pink-blush);
            box-shadow: 0 2px 14px rgba(0, 0, 0, .06);
            position: sticky;
            top: 0;
            z-index: 1000
        }

        /* Logo */
        .logo-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            flex-shrink: 0
        }

        .logo-img {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            border: 2.5px solid var(--pink);
            object-fit: cover
        }

        .logo-fallback {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: var(--pink);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px
        }

        .logo-text h1 {
            font-size: 17px;
            color: var(--pink);
            font-weight: 700;
            line-height: 1.2
        }

        .logo-text small {
            font-size: 11px;
            color: var(--text-light)
        }

        /* Desktop nav */
        .nav-links {
            display: flex;
            gap: 24px;
            align-items: center
        }

        .nav-links a {
            text-decoration: none;
            color: #444;
            font-size: 14px;
            font-weight: 600;
            padding: 6px 2px;
            position: relative
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--pink);
            border-radius: 2px;
            transform: scaleX(0);
            transition: transform var(--t);
            transform-origin: left
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--pink)
        }

        .nav-links a:hover::after,
        .nav-links a.active::after {
            transform: scaleX(1)
        }

        /* WA Button */
        .nav-wa {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--pink);
            color: #fff !important;
            padding: 10px 22px;
            border-radius: 22px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(242, 117, 117, .28);
            transition: background var(--t), transform var(--t)
        }

        .nav-wa::after {
            display: none !important
        }

        .nav-wa:hover {
            background: var(--pink-dark) !important;
            transform: translateY(-1px)
        }

        /* Hamburger */
        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            background: none;
            border: none;
            padding: 6px;
            cursor: pointer
        }

        .hamburger span {
            display: block;
            width: 24px;
            height: 2px;
            background: var(--pink);
            border-radius: 2px;
            transition: transform .3s, opacity .3s
        }

        .hamburger.open span:nth-child(1) {
            transform: translateY(7px) rotate(45deg)
        }

        .hamburger.open span:nth-child(2) {
            opacity: 0
        }

        .hamburger.open span:nth-child(3) {
            transform: translateY(-7px) rotate(-45deg)
        }

        /* Mobile nav */
        .mobile-nav {
            display: none;
            flex-direction: column;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: var(--pink-blush);
            border-top: 1px solid var(--border);
            border-bottom: 2px solid var(--pink-light);
            padding: 8px 6% 16px;
            gap: 0;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .08)
        }

        .mobile-nav.open {
            display: flex;
            animation: slideDown .2s ease
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-8px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
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
            border-bottom: 1px solid var(--border)
        }

        .mobile-nav a:last-child {
            border-bottom: none
        }

        .mobile-nav a:hover,
        .mobile-nav a.active {
            color: var(--pink)
        }

        /* ── FOOTER ── */
        footer {
            background: #1a1a1a;
            color: #999;
            padding: 64px 6% 0
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr;
            gap: 48px;
            padding-bottom: 48px
        }

        .footer-col h4 {
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 20px;
            font-family: 'Playfair Display', serif
        }

        .footer-col .fc-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            color: #bbb;
            font-size: 14px;
            margin-bottom: 11px;
            line-height: 1.5;
            text-decoration: none
        }

        .footer-col .fc-item:hover {
            color: var(--pink)
        }

        .footer-col .fc-item i {
            color: var(--pink);
            width: 16px;
            flex-shrink: 0;
            margin-top: 2px
        }

        .footer-desc {
            color: #bbb;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 16px
        }

        .social-row {
            display: flex;
            gap: 10px;
            margin-top: 18px
        }

        .social-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #2d2d2d;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #bbb;
            font-size: 15px;
            text-decoration: none;
            transition: background var(--t), color var(--t), transform var(--t)
        }

        .social-btn:hover {
            background: var(--pink);
            color: #fff;
            transform: translateY(-2px)
        }

        .footer-bottom {
            border-top: 1px solid #2d2d2d;
            padding: 22px 0;
            text-align: center;
            font-size: 13px;
            color: #555
        }

        /* ── UTILITIES ── */
        .btn-pink {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--pink);
            color: #fff;
            padding: 13px 30px;
            border-radius: 24px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            box-shadow: 0 6px 20px rgba(242, 117, 117, .28);
            transition: background var(--t), transform var(--t)
        }

        .btn-pink:hover {
            background: var(--pink-dark);
            transform: translateY(-2px)
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: var(--pink);
            padding: 12px 28px;
            border-radius: 24px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            border: 2px solid var(--pink);
            transition: background var(--t), color var(--t)
        }

        .btn-outline:hover {
            background: var(--pink);
            color: #fff
        }

        .badge-kateg {
            display: inline-block;
            background: var(--pink-pale);
            color: var(--pink);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            padding: 3px 11px;
            border-radius: 20px
        }

        /* ── RESPONSIVE ── */
        @media(max-width:900px) {
            .footer-grid {
                grid-template-columns: 1fr 1fr
            }
        }

        @media(max-width:640px) {
            .nav-links {
                display: none
            }

            .hamburger {
                display: flex
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 32px
            }

            .navbar {
                padding: 12px 5%
            }
        }

        @stack('styles')
    </style>
    @stack('styles')
</head>

<body>
    <?php
    $profile  = $profile ?? (object)[];
    $waNumber = preg_replace('/[^0-9]/', '', $profile->telepon ?? '081528844756');
    ?>

    {{-- NAVBAR --}}
    <nav class="navbar" id="navbar">
        {{-- Logo --}}
        <a class="logo-wrap" href="{{ route('beranda') }}">
            <img class="logo-img" src="{{ asset('images/logo.jpg') }}"
                alt="Maw Maw Donut" width="46" height="46" loading="eager">
            <div class="logo-text">
                <h1>Maw Maw Donut</h1>
                <small>Maw-nya keterusan</small>
            </div>
        </a>

        {{-- Desktop Links --}}
        <div class="nav-links">
            <a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda')  ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil')  ? 'active' : '' }}">Profil</a>
            <a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang')  ? 'active' : '' }}">Tentang</a>
            <a href="{{ route('produk') }}" class="{{ request()->routeIs('produk')   ? 'active' : '' }}">Produk</a>
            <a href="{{ route('katalog') }}" class="{{ request()->routeIs('katalog')  ? 'active' : '' }}">Katalog</a>
            <a href="https://wa.me/{{ $waNumber }}" class="nav-wa" target="_blank" rel="noopener">
                <i class="fa-brands fa-whatsapp"></i> Pesan Sekarang
            </a>
        </div>

        {{-- Hamburger --}}
        <button class="hamburger" id="hamburgerBtn" aria-label="Buka menu" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
    </nav>

    {{-- Mobile Dropdown --}}
    <div class="mobile-nav" id="mobileNav" role="navigation" aria-label="Menu mobile">
        <a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda')  ? 'active' : '' }}">
            <i class="fa-solid fa-house" style="color:var(--pink);width:18px"></i> Beranda</a>
        <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil')  ? 'active' : '' }}">
            <i class="fa-solid fa-user" style="color:var(--pink);width:18px"></i> Profil</a>
        <a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang')  ? 'active' : '' }}">
            <i class="fa-solid fa-info-circle" style="color:var(--pink);width:18px"></i> Tentang</a>
        <a href="{{ route('produk') }}" class="{{ request()->routeIs('produk')   ? 'active' : '' }}">
            <i class="fa-solid fa-cookie-bite" style="color:var(--pink);width:18px"></i> Produk</a>
        <a href="{{ route('katalog') }}" class="{{ request()->routeIs('katalog')  ? 'active' : '' }}">
            <i class="fa-solid fa-shop" style="color:var(--pink);width:18px"></i> Katalog</a>
        <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener" style="color:var(--pink)">
            <i class="fa-brands fa-whatsapp" style="width:18px"></i> Pesan via WhatsApp</a>
    </div>

    {{-- CONTENT --}}
    @yield('content')

    {{-- FOOTER --}}
    <footer>
        <div class="footer-grid">
            <div class="footer-col">
                <h4>{{ $profile->nama_perusahaan ?? 'Maw Maw Donut' }}</h4>
                <p class="footer-desc">{{ Str::limit($profile->deskripsi ?? 'Brand lokal yang menyajikan kebahagiaan lewat donat lembut dengan beragam topping kekinian.', 120) }}</p>
                <a class="fc-item" href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener">
                    <i class="fa-brands fa-whatsapp"></i>
                    <span>{{ $profile->telepon ?? '081528844756' }}</span>
                </a>
                <span class="fc-item">
                    <i class="fa-solid fa-envelope"></i>
                    <span>{{ $profile->email ?? 'mawmawdonut@gmail.com' }}</span>
                </span>
                <span class="fc-item">
                    <i class="fa-solid fa-clock"></i>
                    <span>Senin – Minggu, 08.00 – 22.00 WIB</span>
                </span>
                <div class="social-row">
                    <a class="social-btn" href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a class="social-btn" href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a class="social-btn" href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                    <a class="social-btn" href="#" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h4>Navigasi</h4>
                <a class="fc-item" href="{{ route('beranda') }}"><i class="fa-solid fa-chevron-right"></i><span>Beranda</span></a>
                <a class="fc-item" href="{{ route('profil') }}"><i class="fa-solid fa-chevron-right"></i><span>Profil</span></a>
                <a class="fc-item" href="{{ route('tentang') }}"><i class="fa-solid fa-chevron-right"></i><span>Tentang</span></a>
                <a class="fc-item" href="{{ route('produk') }}"><i class="fa-solid fa-chevron-right"></i><span>Produk</span></a>
                <a class="fc-item" href="{{ route('katalog') }}"><i class="fa-solid fa-chevron-right"></i><span>Katalog</span></a>
            </div>
            <div class="footer-col">
                <h4>Lokasi Kami</h4>
                <span class="fc-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>{{ $profile->alamat ?? 'Cabang Pusat Maw Maw Donut' }}</span>
                </span>
                @if($profile->maps_embed ?? null)
                <div style="margin-top:12px;border-radius:12px;overflow:hidden">
                    <iframe src="{{ $profile->maps_embed }}" width="100%" height="160"
                        style="border:0;display:block" allowfullscreen loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                @endif
            </div>
        </div>
        <div class="footer-bottom">
            &copy; {{ date('Y') }} {{ $profile->nama_perusahaan ?? 'Maw Maw Donut' }}. All rights reserved. &nbsp;&nbsp;
        </div>
    </footer>

    <script>
        (function() {
            var btn = document.getElementById('hamburgerBtn'),
                nav = document.getElementById('mobileNav'),
                isOpen = false;

            function open() {
                isOpen = true;
                nav.classList.add('open');
                btn.classList.add('open');
                btn.setAttribute('aria-expanded', 'true');
                btn.setAttribute('aria-label', 'Tutup menu')
            }

            function close() {
                isOpen = false;
                nav.classList.remove('open');
                btn.classList.remove('open');
                btn.setAttribute('aria-expanded', 'false');
                btn.setAttribute('aria-label', 'Buka menu')
            }
            if (btn && nav) {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    isOpen ? close() : open()
                });
                document.addEventListener('click', function(e) {
                    if (isOpen && !nav.contains(e.target) && !btn.contains(e.target)) close()
                });
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && isOpen) close()
                });
            }
        })();
    </script>
    @stack('scripts')
</body>

</html>