<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk — {{ $profile->nama_perusahaan ?? 'Maw Maw Donut' }}</title>
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

        /* HERO */
        .page-hero {
            background: linear-gradient(135deg, #F27575, #FFC6C9);
            padding: 70px 8%;
            color: #fff;
            text-align: center;
        }

        .page-hero h1 {
            font-size: 42px;
            margin-bottom: 12px;
        }

        .page-hero p {
            font-size: 16px;
            opacity: .9;
        }

        /* FILTER */
        .filter-wrap {
            background: #FFFEFA;
            padding: 24px 8%;
            border-bottom: 1px solid #ffe0e8;
        }

        .filter-wrap h3 {
            font-size: 12px;
            color: #999;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .filter-pills {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .pill {
            padding: 8px 20px;
            border-radius: 20px;
            border: 1.5px solid #F27575;
            color: #F27575;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: .2s;
        }

        .pill:hover,
        .pill.active {
            background: #F27575;
            color: #fff;
        }

        /* GRID */
        .produk-wrap {
            padding: 50px 8%;
        }

        .produk-wrap h2 {
            font-size: 22px;
            color: #333;
            margin-bottom: 28px;
        }

        .produk-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 24px;
        }

        .card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .08);
            transition: transform .3s, box-shadow .3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, .12);
        }

        .card a {
            text-decoration: none;
            display: block;
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }

        .card-body {
            padding: 16px;
        }

        .card-kat {
            font-size: 11px;
            color: #F27575;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: 4px;
        }

        .card-nama {
            font-size: 15px;
            font-weight: 700;
            color: #333;
            margin-bottom: 6px;
        }

        .card-harga {
            font-size: 16px;
            color: #F27575;
            font-weight: 700;
        }

        .badge-off {
            background: #eee;
            color: #999;
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 10px;
            margin-left: 6px;
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #bbb;
        }

        .empty-state i {
            font-size: 60px;
            margin-bottom: 20px;
            display: block;
        }

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
            .nav-links {
                display: none;
            }

            .produk-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>

<body>

    <nav>
        <div class="logo-section">
            @if(isset($profile->logo) && $profile->logo)
            <img src="{{ Storage::url($profile->logo) }}" alt="Logo">
            @else
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo">
            @endif
            <div class="logo-text">
                <h1>{{ $profile->nama_perusahaan ?? 'Maw Maw Donut' }}</h1>
                <p>Maw-nya keterusan</p>
            </div>
        </div>
        <div class="nav-links">
            <a href="{{ route('beranda') }}">Beranda</a>
            <a href="{{ route('profil') }}">Profil</a>
            <a href="{{ route('tentang') }}">Tentang Kami</a>
            <a href="{{ route('katalog') }}" class="active">Katalog Produk</a>
            <a href="https://wa.me/{{ $profile->wa_number ?? '081528844756' }}"
                class="btn-wa" target="_blank">Chat Via WhatsApp</a>
        </div>
    </nav>

    <div class="page-hero">
        <h1>🍩 Katalog Produk</h1>
        <p>Temukan semua varian donat lezat kami</p>
    </div>

    <div class="filter-wrap">
        <h3>Filter Kategori</h3>
        <div class="filter-pills">
            <a href="{{ route('katalog') }}"
                class="pill {{ !request('kategori') ? 'active' : '' }}">Semua</a>
            @foreach($kategoris as $kat)
            <a href="{{ route('katalog', ['kategori' => $kat->id_kategori]) }}"
                class="pill {{ request('kategori') == $kat->id_kategori ? 'active' : '' }}">
                {{ $kat->nama_kategori }}
                <span style="opacity:.7;">({{ $kat->produk_count }})</span>
            </a>
            @endforeach
        </div>
    </div>

    <div class="produk-wrap">
        <h2>
            {{ request('kategori')
            ? ($kategoris->firstWhere('id_kategori', request('kategori'))->nama_kategori ?? 'Produk')
            : 'Semua Produk' }}
            <span style="font-size:14px; color:#999; font-weight:400;">
                ({{ $produks->count() }} item)
            </span>
        </h2>

        @if($produks->isEmpty())
        <div class="empty-state">
            <i class="fas fa-box-open"></i>
            <p>Belum ada produk di kategori ini.</p>
        </div>
        @else
        <div class="produk-grid">
            @foreach($produks as $produk)
            <div class="card">
                <a href="{{ route('katalog.detail', $produk->id_produk) }}">
                    @if($produk->gambar)
                    <img src="{{ Storage::url($produk->gambar) }}" alt="{{ $produk->nama_produk }}">
                    @else
                    <div style="height:200px; background:#fce4ec; display:flex;
                                align-items:center; justify-content:center; font-size:60px;">🍩</div
                        @endif
                        <div class="card-body">
                    <div class="card-kat">{{ $produk->kategori->nama_kategori ?? '' }}</div>
                    <div class="card-nama">
                        {{ $produk->nama_produk }}
                        @if($produk->status == 'nonaktif')
                        <span class="badge-off">Habis</span>
                        @endif
                    </div>
                    <div class="card-harga">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
            </div>
            </a>
        </div>
        @endforeach
    </div>
    @endif
    </div>

    <footer>
        <div class="footer-col">
            <h4>Kontak Kami</h4>
            <p><i class="fas fa-map-marker-alt"></i> {{ $profile->alamat ?? 'Cabang Pusat' }}</p>
            <p><i class="fab fa-whatsapp"></i> {{ $profile->telepon ?? '081528844756' }}</p>
            <p><i class="fas fa-envelope"></i> {{ $profile->email ?? 'Mawmawdonut.Btg@Gmail.Com' }}</p>
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