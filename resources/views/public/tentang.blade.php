<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami — {{ $profile->nama_perusahaan ?? 'Maw Maw Donut' }}</title>
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
        .tentang-hero {
            height: 80vh;
            background-color: #d95f5f;
            /* fallback jika foto gagal load */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            text-align: center;
            color: #fff;
        }

        .tentang-hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 180px;
            background: linear-gradient(to bottom, rgba(255, 192, 203, 0), #FFC0CB);
        }

        .tentang-hero h1 {
            font-size: 56px;
            font-weight: bold;
            text-shadow: 2px 2px 15px rgba(0, 0, 0, .5);
            position: relative;
            z-index: 2;
        }

        .tentang-hero p {
            font-size: 17px;
            margin-top: 12px;
            opacity: .9;
            position: relative;
            z-index: 2;
        }

        /* ── VISI MISI ────────────────────────────────────────── */
        .visimisi-section {
            padding: 80px 10%;
            background: #fff;
            text-align: center;
        }

        .visimisi-section>h2 {
            font-size: 32px;
            color: #F27575;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .visimisi-section>p.sub {
            font-size: 15px;
            color: #888;
            margin-bottom: 56px;
        }

        .visimisi-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            max-width: 960px;
            margin: 0 auto;
        }

        .vm-card {
            background: #fff;
            border-radius: 24px;
            padding: 40px 36px;
            text-align: left;
            box-shadow: 0 12px 40px rgba(242, 117, 117, .12);
            border-top: 5px solid #F27575;
        }

        .vm-card.misi {
            border-top-color: #FFC6C9;
        }

        .vm-card .vm-icon {
            font-size: 2.6rem;
            margin-bottom: 20px;
            display: block;
        }

        .vm-card h3 {
            font-size: 22px;
            font-weight: 800;
            color: #F27575;
            margin-bottom: 16px;
        }

        .vm-card.misi h3 {
            color: #d95f5f;
        }

        .vm-card p {
            font-size: 15px;
            color: #555;
            line-height: 1.85;
        }

        .vm-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .vm-card ul li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 14px;
            color: #555;
            line-height: 1.7;
        }

        .vm-card ul li::before {
            content: '✦';
            color: #F27575;
            font-size: 11px;
            flex-shrink: 0;
            margin-top: 4px;
        }

        /* ── ACHIEVEMENT ──────────────────────────────────────── */
        .achiev-section {
            padding: 80px 8%;
            background: #FFFEFA;
        }

        .achiev-section>h2 {
            font-size: 32px;
            color: #F27575;
            font-weight: bold;
            text-align: center;
            margin-bottom: 12px;
        }

        .achiev-section>p.sub {
            font-size: 15px;
            color: #888;
            text-align: center;
            margin-bottom: 56px;
        }

        .achiev-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 24px;
            max-width: 1000px;
            margin: 0 auto 56px;
        }

        .achiev-card {
            background: #fff;
            border-radius: 20px;
            padding: 36px 24px;
            text-align: center;
            box-shadow: 0 6px 24px rgba(0, 0, 0, .07);
            transition: transform .25s, box-shadow .25s;
        }

        .achiev-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 40px rgba(242, 117, 117, .15);
        }

        .achiev-card .achiev-icon {
            font-size: 2.8rem;
            margin-bottom: 16px;
            display: block;
        }

        .achiev-card .achiev-num {
            font-size: 36px;
            font-weight: 900;
            color: #F27575;
            line-height: 1;
            margin-bottom: 8px;
        }

        .achiev-card .achiev-label {
            font-size: 14px;
            color: #777;
            font-weight: 600;
        }

        /* Timeline */
        .timeline-wrap {
            max-width: 760px;
            margin: 0 auto;
        }

        .timeline-wrap h3 {
            font-size: 22px;
            font-weight: 800;
            color: #333;
            text-align: center;
            margin-bottom: 36px;
        }

        .timeline {
            position: relative;
            padding-left: 32px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 8px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(#F27575, #FFC6C9);
            border-radius: 2px;
        }

        .tl-item {
            position: relative;
            margin-bottom: 32px;
        }

        .tl-item:last-child {
            margin-bottom: 0;
        }

        .tl-dot {
            position: absolute;
            left: -28px;
            top: 4px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #F27575;
            border: 3px solid #fff;
            box-shadow: 0 0 0 2px #F27575;
        }

        .tl-year {
            font-size: 12px;
            font-weight: 800;
            color: #F27575;
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: 4px;
        }

        .tl-text {
            font-size: 15px;
            color: #444;
            line-height: 1.7;
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
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
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

            .tentang-hero h1 {
                font-size: 36px;
            }

            .visimisi-grid {
                grid-template-columns: 1fr;
            }

            .vm-card {
                padding: 28px 22px;
            }

            .achiev-grid {
                grid-template-columns: 1fr 1fr;
            }

            footer {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .achiev-grid {
                grid-template-columns: 1fr;
            }

            .tentang-hero {
                height: 45vh;
            }

            .tentang-hero h1 {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

    @php
    $namaToko = $profile->nama_perusahaan ?? 'Maw Maw Donut';
    $telepon = $profile->telepon ?? '081528844756';
    $email = $profile->email ?? 'mawmawdonut@gmail.com';
    $alamat = $profile->alamat ?? 'Cabang Pusat Maw Maw Donut';
    $waNumber = $profile->wa_number ?? '081528844756';
    $logoUrl = ($profile->logo ?? null) ? $profile->logo_url : null;
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
        <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil')  ? 'active' : '' }}">
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
    <section class="tentang-hero"
        style="background-image: linear-gradient(rgba(0,0,0,.25), rgba(0,0,0,.35)), url('{{ asset('images/tentang_bg.jpg') }}')">
        <h1>Tentang Kami</h1>
        <p>Kenalan lebih dekat dengan {{ $namaToko }} 🍩</p>
    </section>

    {{-- ═══════════ VISI & MISI ═══════════ --}}
    <section class="visimisi-section">
        <h2>Visi & Misi</h2>
        <p class="sub">Landasan yang mengarahkan setiap langkah kami dalam menghadirkan yang terbaik.</p>

        <div class="visimisi-grid">

            {{-- VISI --}}
            <div class="vm-card">
                <span class="vm-icon">🎯</span>
                <h3>Visi</h3>
                <p>
                    Menjadi brand donat lokal nomor satu yang dikenal dengan
                    kelezatan, inovasi, dan kehangatan di setiap gigitan —
                    menghadirkan kebahagiaan manis untuk seluruh keluarga Indonesia.
                </p>
            </div>

            {{-- MISI --}}
            <div class="vm-card misi">
                <span class="vm-icon">🚀</span>
                <h3>Misi</h3>
                <ul>
                    <li>Menggunakan bahan-bahan berkualitas tinggi tanpa bahan pengawet berbahaya untuk menjamin kesehatan konsumen.</li>
                    <li>Berinovasi secara berkelanjutan dalam menciptakan varian rasa donat yang unik, kreatif, dan mengikuti tren.</li>
                    <li>Memberikan pelayanan yang ramah, cepat, dan memuaskan kepada setiap pelanggan.</li>
                    <li>Menjaga konsistensi rasa dan standar kebersihan dalam setiap proses produksi.</li>
                    <li>Mendukung pertumbuhan ekonomi lokal melalui kemitraan dan pemberdayaan komunitas sekitar.</li>
                </ul>
            </div>

        </div>
    </section>

    {{-- ═══════════ PENCAPAIAN (ACHIEVEMENT) ═══════════ --}}
    <section class="achiev-section">
        <h2>Pencapaian Kami</h2>
        <p class="sub">Angka-angka yang membuktikan kepercayaan dan cinta kalian untuk {{ $namaToko }}.</p>

        {{-- Stat Cards --}}
        <div class="achiev-grid">
            <div class="achiev-card">
                <span class="achiev-icon">🍩</span>
                <div class="achiev-num">50+</div>
                <div class="achiev-label">Varian Rasa Donat</div>
            </div>
            <div class="achiev-card">
                <span class="achiev-icon">😊</span>
                <div class="achiev-num">10K+</div>
                <div class="achiev-label">Pelanggan Puas</div>
            </div>
            <div class="achiev-card">
                <span class="achiev-icon">⭐</span>
                <div class="achiev-num">4.9</div>
                <div class="achiev-label">Rating Rata-rata</div>
            </div>
            <div class="achiev-card">
                <span class="achiev-icon">🏆</span>
                <div class="achiev-num">8+</div>
                <div class="achiev-label">Penghargaan Lokal</div>
            </div>
        </div>

        {{-- Timeline Perjalanan --}}
        <div class="timeline-wrap">
            <h3>Perjalanan {{ $namaToko }}</h3>
            <div class="timeline">
                <div class="tl-item">
                    <div class="tl-dot"></div>
                    <div class="tl-year">2015 — Awal Berdiri</div>
                    <div class="tl-text">
                        {{ $namaToko }} lahir dari dapur rumahan dengan 5 varian donat dan semangat besar
                        untuk menghadirkan camilan berkualitas bagi warga sekitar.
                    </div>
                </div>
                <div class="tl-item">
                    <div class="tl-dot"></div>
                    <div class="tl-year">2017 — Toko Pertama</div>
                    <div class="tl-text">
                        Membuka gerai fisik pertama dan langsung disambut antusias oleh pelanggan setia.
                        Menu diperluas hingga 20 varian dengan topping kekinian.
                    </div>
                </div>
                <div class="tl-item">
                    <div class="tl-dot"></div>
                    <div class="tl-year">2019 — Penghargaan UMKM</div>
                    <div class="tl-text">
                        Meraih penghargaan sebagai UMKM Kuliner Terbaik tingkat kota atas inovasi produk
                        dan konsistensi kualitas bahan baku.
                    </div>
                </div>
                <div class="tl-item">
                    <div class="tl-dot"></div>
                    <div class="tl-year">2021 — Hadir Online</div>
                    <div class="tl-text">
                        Meluncurkan layanan pemesanan online sehingga donat segar bisa dinikmati
                        kapan saja dan di mana saja oleh lebih banyak pelanggan.
                    </div>
                </div>
                <div class="tl-item">
                    <div class="tl-dot"></div>
                    <div class="tl-year">2024 — 10.000 Pelanggan</div>
                    <div class="tl-text">
                        Mencapai milestone 10.000 pelanggan aktif dan meluncurkan 50+ varian rasa
                        yang terus diperbarui mengikuti selera pelanggan.
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════ INFO KONTAK ═══════════ --}}
    <section class="info-section">
        <h2>Temukan Kami</h2>
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
            <div class="info-card">
                <i class="fas fa-clock"></i>
                <h3>Jam Operasional</h3>
                <p>08.00 – 22.00 WIB<br>Setiap Hari</p>
            </div>
        </div>
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