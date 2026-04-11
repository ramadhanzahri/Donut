<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda — {{ $profile->nama_perusahaan ?? 'Maw Maw Donut' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        }

        /* NAV */
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
        }

        .logo-section img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid #F27575;
            object-fit: cover;
        }

        .logo-text h1 {
            font-size: 18px;
            color: #F27575;
            font-weight: bold;
        }

        .logo-text p {
            font-size: 11px;
            color: #666;
            margin-top: -3px;
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
            transition: .3s;
        }

        .btn-wa:hover {
            background: #e06464;
            box-shadow: 0 4px 12px rgba(242, 117, 117, .3);
        }

        /* HERO */
        .hero {
            display: flex;
            min-height: calc(100vh - 75px);
        }

        .hero-left {
            flex: 1;
            background: linear-gradient(135deg, #F27575, #FFC6C9);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 8%;
            color: #fff;
        }

        .hero-left h2 {
            font-size: 52px;
            line-height: 1.1;
            margin-bottom: 20px;
        }

        .hero-left h2 span {
            color: #FFFEFA;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, .1);
        }

        .hero-left p {
            font-size: 18px;
            margin-bottom: 35px;
            opacity: .9;
            max-width: 450px;
            line-height: 1.6;
        }

        .hero-right {
            flex: 1;
            background:url('{{ asset("images/poto1beranda.jpg") }}') no-repeat center/cover;
        }

        /* PRODUK */
        .produk-section {
            position: relative;
            padding: 80px 0;
            background-image:url('{{ asset("images/pattern_donat.jpg") }}');
            background-repeat: repeat;
            background-size: 300px;
        }

        .produk-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, .70);
        }

        .produk-section h2 {
            text-align: center;
            position: relative;
            z-index: 2;
            color: #333;
            font-size: 32px;
            margin-bottom: 10px;
        }

        .produk-grid {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 40px 5%;
            flex-wrap: wrap;
        }

        .card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .1);
            width: 300px;
            flex-shrink: 0;
            transition: transform .3s;
        }

        .card:hover {
            transform: translateY(-6px);
        }

        .card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
        }

        .card-label {
            background: #F27575;
            color: #fff;
            padding: 15px 0;
            font-weight: bold;
            text-align: center;
            font-size: 15px;
        }

        .card-harga {
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #555;
        }

        /* FOOTER */
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

        @media(max-width:768px) {
            .hero {
                flex-direction: column;
            }

            .hero-left {
                padding: 60px 8%;
            }

            .hero-right {
                height: 280px;
            }

            .nav-links {
                display: none;
            }

            .produk-grid {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>

    <nav>
        <div class="logo-section">
            @if($profile && $profile->logo && file_exists(storage_path('app/public/' . $profile->logo)))
            <img src="{{ Storage::url($profile->logo) }}" alt="Logo">
            @elseif(file_exists(public_path('images/logo.jpg')))
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo">
            @else
            <div class="logo-text">
                <h1>{{ $profile->nama_perusahaan ?? 'Maw Maw Donut' }}</h1>
                <p>Maw-nya keterusan</p>
            </div>
            @endif
            @if($profile && !$profile->logo && !file_exists(public_path('images/logo.jpg')))
            <div class="logo-text">
                <h1>{{ $profile->nama_perusahaan ?? 'Maw Maw Donut' }}</h1>
                <p>Maw-nya keterusan</p>
            </div>
            @endif
        </div>
        <div class="nav-links">
            <a href="{{ route('beranda') }}" class="active">Beranda</a>
            <a href="{{ route('profil') }}">Profile</a>
            <a href="{{ route('tentang') }}">Tentang Kami</a>
            <a href="{{ route('katalog') }}">Katalog Produk</a>
            <a href="https://wa.me/{{ $profile->wa_number ?? '081528844756' }}"
                class="btn-wa" target="_blank">Chat Via WhatsApp</a>
        </div>
    </nav>

    <div class="hero">
        <div class="hero-left">
            <h2>Selamat Datang Di<br>
                <span>{{ $profile->nama_perusahaan ?? 'Maw Maw Donut' }}</span>
            </h2>
            <p>{{ $profile->deskripsi ?? 'Brand lokal yang menyajikan kebahagiaan lewat donat lembut dengan beragam topping kekinian.' }}</p>
            <a href="https://wa.me/{{ $profile->wa_number ?? '081528844756' }}"
                class="btn-wa"
                style="width:fit-content; padding:18px 40px; font-size:16px; text-decoration:none;"
                target="_blank">Chat Via WhatsApp</a>
        </div>
        <div class="hero-right" style="background:url('{{ asset('images/poto1beranda.jpg') }}') no-repeat center/cover;"></div>
    </div>

    <section class="produk-section">
        <h2>Produk Favorit</h2>
        <div class="produk-grid">
            @forelse($produkFavorit as $produk)
            <a href="{{ route('katalog.detail', $produk->id_produk) }}" style="text-decoration:none;">
                <div class="card">
                    @if($produk->gambar)
                    <img src="{{ Storage::url($produk->gambar) }}" alt="{{ $produk->nama_produk }}">
                    @else
                    <div style="height:250px; background:#fce4ec; display:flex;
                                align-items:center; justify-content:center; font-size:60px;">🍩</div
                        @endif
                        <div class="card-label">{{ $produk->nama_produk }}
                </div>
                <div class="card-harga">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
        </div>
        </a>
        @empty
        <p style="color:#999; position:relative; z-index:2;">Belum ada produk tersedia.</p>
        @endforelse
        </div>
        <div style="text-align:center; position:relative; z-index:2; margin-top:10px;">
            <a href="{{ route('katalog') }}" class="btn-wa"
                style="display:inline-block; text-decoration:none;">Lihat Semua Produk →</a>
        </div>
    </section>

    <footer>
        <div class="footer-col">
            <h4>Kontak Kami</h4>
            <p><i class="fas fa-map-marker-alt"></i> {{ $profile->alamat ?? 'Cabang Pusat' }}</p>
            <p><i class="fab fa-whatsapp"></i> {{ $profile->telepon ?? '081528844756' }}</p>
            <p><i class="fas fa-envelope"></i> {{ $profile->email ?? 'Mawmawdonut.Btg@Gmail.Com' }}</p>
            <p>Jam Operasional: 08.00 – 22.00 WIB</p>
        </div>
        <div class="footer-col">
            <h4>Link Cepat</h4>
            <a href="{{ route('beranda') }}">Beranda</a>
            <a href="{{ route('tentang') }}">Tentang Kami</a>
            <a href="{{ route('katalog') }}">Katalog Produk</a>
        </div>
    </footer>
    <div class="footer-bottom">
        &copy; {{ date('Y') }} {{ $profile->nama_perusahaan ?? 'Maw Maw Donut' }}. All rights reserved.
    </div>

</body>

</html>