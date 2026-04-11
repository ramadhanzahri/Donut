<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produk->nama_produk }} - {{ $profile->nama_perusahaan ?? 'Maw Maw Donut' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #FFC0CB; overflow-x: hidden; }

        /* NAVBAR */
        nav {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 8%; background-color: #FFFEFA;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky; top: 0; z-index: 1000;
        }
        .logo-section { display: flex; align-items: center; gap: 12px; }
        .logo-section img { width: 45px; height: 45px; border-radius: 50%; border: 2px solid #F27575; }
        .logo-text h3 { font-size: 18px; color: #F27575; font-weight: bold; margin: 0; }
        .logo-text small { font-size: 11px; color: #666; display: block; margin-top: -3px; }
        .nav-links { display: flex; gap: 25px; align-items: center; }
        .nav-links a { text-decoration: none; color: #444; font-size: 14px; font-weight: 600; transition: 0.3s; }
        .nav-links a:hover { color: #F27575; }
        .btn-wa { background-color: #F27575; color: white !important; padding: 10px 22px; border-radius: 20px; font-size: 13px; font-weight: bold; }

        /* BREADCRUMB */
        .breadcrumb { background: #fff0f3; padding: 12px 8%; font-size: 13px; color: #888; }
        .breadcrumb a { color: #F27575; text-decoration: none; }
        .breadcrumb a:hover { text-decoration: underline; }
        .breadcrumb span { margin: 0 6px; }

        /* DETAIL WRAPPER */
        .detail-wrapper { max-width: 960px; margin: 40px auto; padding: 0 20px 60px; }

        .detail-card {
            background: white; border-radius: 30px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
            overflow: hidden; display: flex;
        }

        /* GAMBAR KIRI */
        .detail-img-wrap { width: 45%; flex-shrink: 0; }
        .detail-img-wrap img { width: 100%; height: 100%; object-fit: cover; display: block; min-height: 420px; }
        .no-image {
            width: 100%; min-height: 420px;
            background: linear-gradient(135deg, #FFC0CB, #F27575);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            color: white; font-size: 60px;
        }
        .no-image p { font-size: 14px; margin-top: 10px; opacity: 0.8; }

        /* INFO KANAN */
        .detail-info { flex: 1; padding: 40px 35px; display: flex; flex-direction: column; justify-content: center; }
        .badge-kategori {
            display: inline-block; background: #fff0f3; color: #F27575;
            border: 1.5px solid #F27575; padding: 4px 14px; border-radius: 20px;
            font-size: 12px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.5px; margin-bottom: 16px;
        }
        .detail-info h1 { font-size: 28px; color: #333; font-weight: 800; line-height: 1.3; margin-bottom: 12px; }
        .detail-harga { font-size: 26px; font-weight: bold; color: #F27575; margin-bottom: 20px; }
        .divider { height: 2px; background: #FFC0CB; border-radius: 4px; margin-bottom: 20px; }
        .detail-deskripsi { font-size: 15px; color: #666; line-height: 1.8; margin-bottom: 30px; }
        .detail-deskripsi.empty { color: #aaa; font-style: italic; }

        /* TOMBOL */
        .btn-group { display: flex; gap: 12px; flex-wrap: wrap; }
        .btn-wa-detail {
            display: inline-flex; align-items: center; gap: 8px;
            background: #F27575; color: white;
            padding: 13px 28px; border-radius: 30px;
            font-size: 15px; font-weight: bold; text-decoration: none;
            transition: 0.3s; box-shadow: 0 4px 15px rgba(242,117,117,0.35);
        }
        .btn-wa-detail:hover { background: #e06464; transform: translateY(-2px); }
        .btn-kembali-detail {
            display: inline-flex; align-items: center; gap: 8px;
            background: white; color: #F27575; border: 2px solid #F27575;
            padding: 13px 28px; border-radius: 30px;
            font-size: 15px; font-weight: bold; text-decoration: none; transition: 0.3s;
        }
        .btn-kembali-detail:hover { background: #fff0f3; }

        /* PRODUK LAINNYA */
        .produk-lain-section { margin-top: 50px; }
        .produk-lain-section h2 { text-align: center; color: #333; font-size: 22px; font-weight: bold; margin-bottom: 25px; }
        .produk-lain-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; }
        .produk-lain-card {
            background: white; border-radius: 20px; overflow: hidden;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
            text-decoration: none; color: inherit; transition: 0.3s; display: block;
        }
        .produk-lain-card:hover { transform: translateY(-6px); box-shadow: 0 12px 28px rgba(0,0,0,0.12); }
        .produk-lain-card img { width: 100%; height: 160px; object-fit: cover; display: block; }
        .produk-lain-img-placeholder {
            width: 100%; height: 160px;
            background: linear-gradient(135deg, #FFC0CB, #F27575);
            display: flex; align-items: center; justify-content: center;
            font-size: 36px; color: white;
        }
        .produk-lain-info { padding: 14px; }
        .produk-lain-info p { font-weight: bold; color: #F27575; font-size: 14px; }
        .produk-lain-info span { font-size: 13px; color: #444; font-weight: 600; }

        /* FOOTER */
        footer { background-color: #1a1a1a; color: white; padding: 50px 8%; }
        .footer-container { display: flex; justify-content: space-between; flex-wrap: wrap; gap: 40px; }
        .footer-column h3 { margin-bottom: 15px; }
        .footer-column ul { list-style: none; }
        .footer-column ul li { margin-bottom: 8px; color: #ccc; font-size: 14px; }
        .social-icons img { width: 28px; margin-right: 12px; filter: invert(1); }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .detail-card { flex-direction: column; }
            .detail-img-wrap { width: 100%; }
            .detail-img-wrap img, .no-image { min-height: 260px; }
            .detail-info { padding: 25px 20px; }
            .detail-info h1 { font-size: 22px; }
            .nav-links { display: none; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav>
        <div class="logo-section">
            @if(isset($profile->logo) && $profile->logo)
                <img src="{{ Storage::url($profile->logo) }}" alt="Logo">
            @else
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo">
            @endif
            <div class="logo-text">
                <h3>{{ $profile->nama_perusahaan ?? 'Maw Maw Donut' }}</h3>
                <small>Maw-nya keterusan</small>
            </div>
        </div>
        <div class="nav-links">
            <a href="{{ route('beranda') }}">Beranda</a>
            <a href="{{ route('tentang') }}">Tentang Kami</a>
            <a href="{{ route('katalog') }}" style="color: #F27575;">Katalog Produk</a>
            <a href="https://wa.me/081528844756" class="btn-wa" target="_blank">Chat Via WhatsApp</a>
        </div>
    </nav>

    <!-- BREADCRUMB -->
    <div class="breadcrumb">
        <a href="{{ route('beranda') }}">Beranda</a>
        <span>›</span>
        <a href="{{ route('katalog') }}">Katalog Produk</a>
        <span>›</span>
        {{ $produk->nama_produk }}
    </div>

    <!-- DETAIL PRODUK -->
    <div class="detail-wrapper">
        <div class="detail-card">

            <!-- GAMBAR -->
            <div class="detail-img-wrap">
                @if($produk->gambar)
                    <img src="{{ Storage::url($produk->gambar) }}" alt="{{ $produk->nama_produk }}">
                @else
                    <div class="no-image">
                        <i class="fa-solid fa-image"></i>
                        <p>Foto tidak tersedia</p>
                    </div>
                @endif
            </div>

            <!-- INFO -->
            <div class="detail-info">
                @if($produk->kategori)
                    <span class="badge-kategori">
                        {{ is_object($produk->kategori) ? $produk->kategori->nama : $produk->kategori }}
                    </span>
                @endif

                <h1>{{ $produk->nama_produk }}</h1>
                <div class="detail-harga">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                <div class="divider"></div>

                @if(!empty($produk->deskripsi))
                    <p class="detail-deskripsi">{{ $produk->deskripsi }}</p>
                @else
                    <p class="detail-deskripsi empty">Deskripsi produk belum tersedia.</p>
                @endif

                <div class="btn-group">
                    <a href="https://wa.me/{{ $profile->wa_number ?? '081528844756' }}?text=Halo%20{{ urlencode($profile->nama_perusahaan ?? 'Maw Maw Donut') }},%20saya%20ingin%20memesan%20{{ urlencode($produk->nama_produk) }}"
                       class="btn-wa-detail" target="_blank">
                        <i class="fa-brands fa-whatsapp"></i> Pesan via WhatsApp
                    </a>
                    <a href="{{ route('katalog') }}" class="btn-kembali-detail">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- PRODUK LAINNYA -->
        @if(isset($related) && $related->count() > 0)
        <div class="produk-lain-section">
            <h2>Produk Lainnya</h2>
            <div class="produk-lain-grid">
                @foreach($related as $item)
                <a href="{{ route('katalog.detail', $item->id_produk) }}" class="produk-lain-card">
                    @if($item->gambar)
                        <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_produk }}">
                    @else
                        <div class="produk-lain-img-placeholder">
                            <i class="fa-solid fa-cookie-bite"></i>
                        </div>
                    @endif
                    <div class="produk-lain-info">
                        <p>{{ $item->nama_produk }}</p>
                        <span>Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h3>Kontak Kami</h3>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> {{ $profile->alamat ?? 'Cabang Pusat Maw Maw Donut' }}</li>
                    <li><i class="fas fa-phone"></i> {{ $profile->telepon ?? '081528844756' }}</li>
                    <li>{{ $profile->email ?? 'Mawmawdonut.Btg@Gmail.Com' }}</li>
                    <li>Jam Operasional 08.00 - 22.00 WIB</li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Ikuti Kami</h3>
                <div class="social-icons">
                    <img src="{{ asset('images/ig-icon.png') }}" alt="Instagram">
                    <img src="{{ asset('images/fb-icon.png') }}" alt="Facebook">
                </div>
            </div>
        </div>
    </footer>

</body>
</html>