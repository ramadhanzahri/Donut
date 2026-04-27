<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Perusahaan – {{ $profile->nama_perusahaan ?? 'Maw Maw Donut' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Segoe UI', Roboto, sans-serif; background:#fff; color:#1a0a10; }
        img  { display:block; max-width:100%; height:auto; }
        a    { color:inherit; transition:color .3s; }
        button { cursor:pointer; font:inherit; }

        nav { display:flex; justify-content:space-between; align-items:center;
              padding:15px 8%; background:#FFFEFA;
              box-shadow:0 2px 10px rgba(0,0,0,.05); position:sticky; top:0; z-index:1000; }
        .logo-section { display:flex; align-items:center; gap:12px; text-decoration:none; }
        .logo-section img { width:45px; height:45px; border-radius:50%;
                            border:2px solid #F27575; object-fit:cover; }
        .logo-fallback { width:45px; height:45px; border-radius:50%; background:#F27575;
                         display:flex; align-items:center; justify-content:center;
                         font-size:20px; flex-shrink:0; }
        .logo-text h1 { font-size:18px; color:#F27575; font-weight:bold; }
        .logo-text p  { font-size:11px; color:#666; margin-top:-3px; }
        .nav-links { display:flex; gap:25px; align-items:center; }
        .nav-links a { text-decoration:none; color:#444; font-size:14px;
                       font-weight:600; transition:.3s; }
        .nav-links a:hover, .nav-links a.active { color:#F27575; }
        .btn-wa { background:#F27575; color:#fff !important; padding:10px 22px;
                  border-radius:20px; font-size:13px; transition:.3s; text-decoration:none; }
        .btn-wa:hover { background:#e06464; box-shadow:0 4px 12px rgba(242,117,117,.3); }
        .hamburger { display:none; flex-direction:column; gap:5px;
                     background:none; border:none; padding:6px; cursor:pointer; }
        .hamburger span { display:block; width:24px; height:2px; background:#F27575;
                          border-radius:2px; transition:transform .3s, opacity .3s; }
        .hamburger.open span:nth-child(1) { transform:translateY(7px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity:0; }
        .hamburger.open span:nth-child(3) { transform:translateY(-7px) rotate(-45deg); }
        .mobile-nav { display:none; flex-direction:column; position:absolute;
                      top:100%; left:0; right:0; background:#FFFEFA;
                      border-top:1px solid #ffe0e8; border-bottom:2px solid #FFC6C9;
                      padding:8px 8% 16px; gap:0; box-shadow:0 8px 20px rgba(0,0,0,.08); }
        .mobile-nav.open { display:flex; }
        .mobile-nav a { display:flex; align-items:center; gap:10px; padding:12px 0;
                        font-size:15px; font-weight:600; color:#444; text-decoration:none;
                        border-bottom:1px solid #ffe0e8; }
        .mobile-nav a:last-child { border-bottom:none; }
        .mobile-nav a:hover, .mobile-nav a.active { color:#F27575; }

        .profil-hero { background:linear-gradient(135deg,#F27575,#FFC6C9);
                       padding:70px 8%; color:#fff; text-align:center; }
        .profil-hero h1 { font-size:42px; margin-bottom:12px; font-weight:800; }
        .profil-hero p  { font-size:16px; opacity:.9; max-width:560px;
                          margin:0 auto; line-height:1.7; }

        .profil-section { background:linear-gradient(135deg,#fff0f5 0%,#fff9fb 60%,#fff0f5 100%);
                          padding:80px 6%; }
        .profil-inner { display:grid; grid-template-columns:260px 1fr; gap:56px;
                        align-items:start; max-width:1000px; margin:0 auto; }

        .profil-logo-wrap { display:flex; flex-direction:column; align-items:center; gap:16px; }
        .profil-logo-circle { width:160px; height:160px; border-radius:50%; background:#F27575;
                              display:flex; align-items:center; justify-content:center;
                              font-size:72px; box-shadow:0 16px 48px rgba(242,117,117,.28);
                              overflow:hidden; }
        .profil-logo-circle img { width:100%; height:100%; object-fit:cover; }
        .profil-logo-name { font-size:18px; font-weight:bold; color:#1a0a10; text-align:center; }
        .profil-logo-tag  { font-size:13px; color:#999; font-style:italic; text-align:center; }

        .profil-info h2 { font-size:28px; font-weight:800; color:#1a0a10;
                          margin-bottom:16px; line-height:1.3; }
        .profil-info p  { font-size:15px; color:#555; line-height:1.9; margin-bottom:14px; }
        .profil-nilai   { display:flex; flex-direction:column; gap:12px; margin-top:24px; }
        .nilai-item     { display:flex; align-items:flex-start; gap:12px; }
        .nilai-icon     { width:36px; height:36px; border-radius:10px; background:#fff0f5;
                          display:flex; align-items:center; justify-content:center;
                          font-size:18px; flex-shrink:0; }
        .nilai-text strong { display:block; font-size:14px; font-weight:700;
                             color:#1a0a10; margin-bottom:2px; }
        .nilai-text span   { font-size:13px; color:#555; }

        .sejarah-section    { padding:60px 8%; background:#fff; }
        .sejarah-container  { max-width:760px; margin:0 auto; }
        .sejarah-container h2 { font-size:28px; font-weight:800; color:#F27575; margin-bottom:8px; }
        .sejarah-sub        { font-size:14px; color:#999; margin-bottom:32px; }
        .sejarah-container p { font-size:15px; color:#555; line-height:1.9; margin-bottom:16px; }

        .tl-wrap  { margin-top:32px; }
        .timeline { position:relative; padding-left:32px; }
        .timeline::before { content:''; position:absolute; left:8px; top:0; bottom:0;
                            width:2px; background:linear-gradient(#F27575,#FFC6C9);
                            border-radius:2px; }
        .tl-item  { position:relative; margin-bottom:28px; }
        .tl-item:last-child { margin-bottom:0; }
        .tl-dot   { position:absolute; left:-28px; top:4px; width:16px; height:16px;
                    border-radius:50%; background:#F27575;
                    border:3px solid #fff; box-shadow:0 0 0 2px #F27575; }
        .tl-year  { font-size:12px; font-weight:800; color:#F27575;
                    text-transform:uppercase; letter-spacing:.08em; margin-bottom:4px; }
        .tl-text  { font-size:15px; color:#444; line-height:1.7; }

        .divider-section { height:2px;
            background:linear-gradient(90deg,transparent,#FFC6C9,transparent); margin:0 6%; }

        .info-section { background:#FFFEFA; padding:60px 8%; }
        .info-section h2 { text-align:center; font-size:26px; color:#F27575;
                           margin-bottom:36px; font-weight:bold; }
        .info-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
                     gap:24px; max-width:1000px; margin:0 auto; }
        .info-card { background:#fff; border-radius:16px; padding:30px 24px;
                     text-align:center; box-shadow:0 4px 16px rgba(0,0,0,.06); }
        .info-card i    { font-size:32px; color:#F27575; margin-bottom:16px; display:block; }
        .info-card h3   { font-size:16px; font-weight:700; color:#333; margin-bottom:8px; }
        .info-card p, .info-card a { font-size:14px; color:#777; line-height:1.7; text-decoration:none; }
        .info-card a:hover { color:#F27575; }
        .wa-cta-wrap { text-align:center; margin-top:40px; }
        .btn-wa-big  { display:inline-flex; align-items:center; gap:10px;
                       background:#25d366; color:#fff; padding:14px 36px;
                       border-radius:28px; text-decoration:none; font-size:16px;
                       font-weight:700; box-shadow:0 6px 20px rgba(37,211,102,.3);
                       transition:background .2s, transform .2s; }
        .btn-wa-big:hover { background:#1ebe5d; transform:translateY(-2px); }

        footer { background:#1a1a1a; color:#999; padding:60px 8% 40px;
                 display:flex; justify-content:space-between; flex-wrap:wrap; gap:30px; }
        .footer-col h4  { color:#fff; font-size:18px; margin-bottom:20px; }
        .footer-col p, .footer-col a { color:#bbb; font-size:14px; margin-bottom:10px;
                                        text-decoration:none; display:block; }
        .footer-col a:hover { color:#F27575; }
        .footer-bottom { background:#111; color:#666; text-align:center;
                         padding:15px; font-size:13px; }

        @media(max-width:768px) {
            .nav-links { display:none; } .hamburger { display:flex; }
            .profil-hero h1 { font-size:28px; }
            .profil-inner { grid-template-columns:1fr; gap:32px; }
            .profil-logo-wrap { flex-direction:row; align-items:center;
                                gap:20px; justify-content:flex-start; }
            .profil-logo-circle { width:80px; height:80px; font-size:36px; flex-shrink:0; }
            .profil-logo-name { font-size:16px; text-align:left; }
            .profil-logo-tag  { text-align:left; }
            footer { flex-direction:column; }
        }
    </style>
</head>
<body>
<?php
    $namaToko  = $profile->nama_perusahaan ?? 'Maw Maw Donut';
    $deskripsi = $profile->deskripsi       ?? null;
    $sejarah   = $profile->sejarah         ?? null;
    $telepon   = $profile->telepon         ?? '081528844756';
    $email     = $profile->email           ?? 'mawmawdonut@gmail.com';
    $alamat    = $profile->alamat          ?? 'Cabang Pusat Maw Maw Donut';
    $logoUrl   = isset($profile->logo) && $profile->logo
                    ? Storage::url($profile->logo) : null;
    $waNumber  = preg_replace('/[^0-9]/', '', $profile->wa_number ?? $telepon);
?>
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
        <a href="{{ route('beranda') }}"  class="{{ request()->routeIs('beranda')  ? 'active' : '' }}">Beranda</a>
        <a href="{{ route('profil') }}"   class="{{ request()->routeIs('profil')   ? 'active' : '' }}">Profil</a>
        <a href="{{ route('tentang') }}"  class="{{ request()->routeIs('tentang')  ? 'active' : '' }}">Tentang Kami</a>
        <a href="{{ route('produk') }}"   class="{{ request()->routeIs('produk')   ? 'active' : '' }}">Produk</a>
        <a href="{{ route('katalog') }}"  class="{{ request()->routeIs('katalog')  ? 'active' : '' }}">Katalog</a>
        <a href="https://wa.me/{{ $waNumber }}" class="btn-wa" target="_blank" rel="noopener noreferrer">
            <i class="fa-brands fa-whatsapp"></i> Chat Via WhatsApp
        </a>
    </div>
    <button class="hamburger" id="hamburgerBtn" aria-label="Buka menu" aria-expanded="false">
        <span></span><span></span><span></span>
    </button>
</nav>
<div class="mobile-nav" id="mobileNav" role="navigation" aria-label="Menu mobile">
    <a href="{{ route('beranda') }}"  class="{{ request()->routeIs('beranda')  ? 'active' : '' }}"><i class="fas fa-house"       style="color:#F27575;width:18px"></i> Beranda</a>
    <a href="{{ route('profil') }}"   class="{{ request()->routeIs('profil')   ? 'active' : '' }}"><i class="fas fa-building"    style="color:#F27575;width:18px"></i> Profil Perusahaan</a>
    <a href="{{ route('tentang') }}"  class="{{ request()->routeIs('tentang')  ? 'active' : '' }}"><i class="fas fa-circle-info" style="color:#F27575;width:18px"></i> Tentang Kami</a>
    <a href="{{ route('produk') }}"   class="{{ request()->routeIs('produk')   ? 'active' : '' }}"><i class="fas fa-cookie-bite" style="color:#F27575;width:18px"></i> Produk</a>
    <a href="{{ route('katalog') }}"  class="{{ request()->routeIs('katalog')  ? 'active' : '' }}"><i class="fas fa-shop"        style="color:#F27575;width:18px"></i> Katalog</a>
    <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener noreferrer" style="color:#F27575">
        <i class="fab fa-whatsapp" style="width:18px"></i> Pesan via WhatsApp</a>
</div>

<section class="profil-hero">
    <h1>Profil Perusahaan</h1>
    <p>{{ $deskripsi ? Str::limit($deskripsi, 160) : 'Brand lokal yang menyajikan kebahagiaan lewat donat lembut dengan beragam topping kekinian.' }}</p>
</section>

<section class="profil-section">
    <div class="profil-inner">
        <div class="profil-logo-wrap">
            <div class="profil-logo-circle">
                @if($logoUrl)
                    <img src="{{ $logoUrl }}" alt="Logo {{ $namaToko }}" loading="lazy">
                @else
                    🍩
                @endif
            </div>
            <p class="profil-logo-name">{{ $namaToko }}</p>
            <p class="profil-logo-tag">Brand Donat Lokal Indonesia</p>
        </div>
        <div class="profil-info">
            <h2>Kenalan Lebih Dekat dengan
                <span style="color:#F27575">{{ $namaToko }}</span>
            </h2>
            @if($deskripsi)
                @foreach(array_filter(explode("\n", $deskripsi)) as $par)
                    <p>{{ trim($par) }}</p>
                @endforeach
            @else
                <p>{{ $namaToko }} adalah brand donat lokal yang hadir untuk menghadirkan kelezatan di setiap momen spesial Anda. Kami percaya bahwa makanan yang baik dimulai dari bahan-bahan pilihan.</p>
                <p>Dibuat dengan cinta, disajikan dengan kehangatan — karena setiap gigitan harus berkesan dan selalu membuat ketagihan.</p>
            @endif
            <div class="profil-nilai">
                <div class="nilai-item">
                    <div class="nilai-icon">🌾</div>
                    <div class="nilai-text">
                        <strong>Bahan Pilihan</strong>
                        <span>Menggunakan bahan berkualitas tinggi tanpa bahan pengawet berbahaya</span>
                    </div>
                </div>
                <div class="nilai-item">
                    <div class="nilai-icon">✨</div>
                    <div class="nilai-text">
                        <strong>Inovasi Rasa</strong>
                        <span>Selalu menghadirkan varian topping baru yang kekinian dan unik</span>
                    </div>
                </div>
                <div class="nilai-item">
                    <div class="nilai-icon">❤️</div>
                    <div class="nilai-text">
                        <strong>Dibuat dengan Cinta</strong>
                        <span>Setiap donat diproduksi secara higienis dengan standar kebersihan tinggi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="divider-section"></div>

<section class="sejarah-section">
    <div class="sejarah-container">
        <h2>Sejarah {{ $namaToko }}</h2>
        <p class="sejarah-sub">Perjalanan kami dari dapur kecil hingga brand lokal yang dicintai.</p>
        @if($sejarah)
            @foreach(array_filter(explode("\n", $sejarah)) as $par)
                <p>{{ trim($par) }}</p>
            @endforeach
        @else
            <p>{{ $namaToko }} lahir dari passion seorang ibu rumah tangga yang ingin menghadirkan camilan berkualitas bagi keluarga dan lingkungan sekitarnya. Berawal dari dapur kecil, resep turun-temurun dipadukan dengan kreasi topping kekinian hingga digemari banyak orang.</p>
            <p>Perlahan namun pasti, usaha ini berkembang dari sekadar pesanan tetangga menjadi brand lokal yang dikenal luas. Dengan semangat yang tidak pernah padam, kami terus berinovasi demi memberikan yang terbaik bagi pelanggan setia kami.</p>
            <div class="tl-wrap">
                <div class="timeline">
                    <div class="tl-item">
                        <div class="tl-dot"></div>
                        <div class="tl-year">2015 — Awal Berdiri</div>
                        <div class="tl-text">Lahir dari dapur rumahan dengan 5 varian donat dan semangat besar untuk menghadirkan camilan berkualitas bagi warga sekitar.</div>
                    </div>
                    <div class="tl-item">
                        <div class="tl-dot"></div>
                        <div class="tl-year">2017 — Toko Pertama</div>
                        <div class="tl-text">Membuka gerai fisik pertama dan langsung disambut antusias pelanggan setia. Menu diperluas hingga 20 varian dengan topping kekinian.</div>
                    </div>
                    <div class="tl-item">
                        <div class="tl-dot"></div>
                        <div class="tl-year">2019 — Penghargaan UMKM</div>
                        <div class="tl-text">Meraih penghargaan UMKM Kuliner Terbaik tingkat kota atas inovasi produk dan konsistensi kualitas bahan baku.</div>
                    </div>
                    <div class="tl-item">
                        <div class="tl-dot"></div>
                        <div class="tl-year">2021 — Hadir Online</div>
                        <div class="tl-text">Meluncurkan layanan pemesanan online sehingga donat segar bisa dinikmati kapan saja dan di mana saja.</div>
                    </div>
                    <div class="tl-item">
                        <div class="tl-dot"></div>
                        <div class="tl-year">2024 — 10.000 Pelanggan</div>
                        <div class="tl-text">Mencapai milestone 10.000 pelanggan aktif dan meluncurkan 50+ varian rasa yang terus diperbarui mengikuti selera pelanggan.</div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<div class="divider-section"></div>

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
            <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener">{{ $telepon }}</a>
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
    <div class="wa-cta-wrap">
        <a href="https://wa.me/{{ $waNumber }}" class="btn-wa-big" target="_blank" rel="noopener">
            <i class="fab fa-whatsapp"></i> Pesan Sekarang via WhatsApp
        </a>
    </div>
</section>

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
        <a href="{{ route('produk') }}">Produk</a>
        <a href="{{ route('katalog') }}">Katalog Produk</a>
    </div>
</footer>
<div class="footer-bottom">
    &copy; {{ date('Y') }} {{ $namaToko }}. All rights reserved. &nbsp;&nbsp;
    <a href="{{ route('login') }}" style="color:#555;text-decoration:none">Admin</a>
</div>
<script>
(function(){
    var btn=document.getElementById('hamburgerBtn'),
        nav=document.getElementById('mobileNav'),
        isOpen=false;
    function openMenu(){isOpen=true;nav.classList.add('open');btn.classList.add('open');
        btn.setAttribute('aria-expanded','true');btn.setAttribute('aria-label','Tutup menu');}
    function closeMenu(){isOpen=false;nav.classList.remove('open');btn.classList.remove('open');
        btn.setAttribute('aria-expanded','false');btn.setAttribute('aria-label','Buka menu');}
    if(btn){
        btn.addEventListener('click',function(e){e.stopPropagation();isOpen?closeMenu():openMenu();});
        document.addEventListener('click',function(e){if(isOpen&&!nav.contains(e.target)&&!btn.contains(e.target))closeMenu();});
        document.addEventListener('keydown',function(e){if(e.key==='Escape'&&isOpen)closeMenu();});
    }
})();
</script>
</body>
</html>
