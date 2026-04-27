@extends('layouts.public')
@section('title', 'Beranda')

@push('styles')
<style>
/* ═══ HERO ═══ */
.hero{padding:88px 6% 72px;text-align:center;background:linear-gradient(160deg,#fff9fb 0%,#fff0f5 100%)}
.hero-badge{display:inline-block;background:var(--pink-pale);color:var(--pink);font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;padding:6px 18px;border-radius:20px;margin-bottom:20px}
.hero h2{font-family:'Playfair Display',serif;font-size:clamp(2rem,5vw,3.2rem);color:var(--text);line-height:1.2;margin-bottom:16px}
.hero h2 em{color:var(--pink);font-style:italic}
.hero p{font-size:16px;color:var(--text-mid);max-width:520px;margin:0 auto 32px}
.hero-cta{display:flex;gap:16px;justify-content:center;flex-wrap:wrap}

/* ═══ PRODUK FAVORIT ═══ */
.section-pad{padding:64px 6%}
.section-head{text-align:center;margin-bottom:36px}
.section-head h2{font-family:'Playfair Display',serif;font-size:clamp(1.5rem,3vw,2rem);color:var(--text);margin-bottom:8px}
.section-head p{font-size:14px;color:var(--text-light)}
.produk-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(min(240px,100%),1fr));gap:24px}
.produk-card{background:#fff;border-radius:var(--radius);border:1px solid var(--border);overflow:hidden;box-shadow:var(--shadow);transition:transform var(--t),box-shadow var(--t)}
.produk-card:hover{transform:translateY(-4px);box-shadow:0 12px 32px rgba(242,117,117,.18)}
.produk-card a{text-decoration:none;color:inherit;display:block}
.card-img{width:100%;height:180px;object-fit:cover;background:#fde8f0}
.card-img-placeholder{width:100%;height:180px;background:var(--pink-pale);display:flex;align-items:center;justify-content:center;font-size:48px}
.card-body{padding:16px}
.card-body .kateg{font-size:11px;font-weight:700;color:var(--pink);text-transform:uppercase;letter-spacing:.06em;margin-bottom:6px}
.card-body h3{font-size:15px;font-weight:700;margin-bottom:6px;line-height:1.3}
.card-body .harga{font-size:16px;font-weight:700;color:var(--pink)}

/* ═══ PROFIL PERUSAHAAN ═══ */
.profil-section{background:linear-gradient(135deg,#fff0f5 0%,#fff9fb 60%,#fff0f5 100%);padding:80px 6%}
.profil-inner{display:grid;grid-template-columns:1fr 1fr;gap:56px;align-items:start;max-width:1000px;margin:0 auto}
.profil-logo-wrap{display:flex;flex-direction:column;align-items:center;gap:20px}
.profil-logo-circle{width:160px;height:160px;border-radius:50%;background:var(--pink);display:flex;align-items:center;justify-content:center;font-size:72px;box-shadow:0 16px 48px rgba(242,117,117,.28)}
.profil-logo-name{font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:700;color:var(--text);text-align:center}
.profil-logo-tag{font-size:13px;color:var(--text-light);font-style:italic}
.kontak-grid{display:flex;flex-direction:column;gap:10px;margin-top:20px;width:100%}
.kontak-item{display:flex;align-items:center;gap:14px;background:#fff;border:1px solid var(--border);border-radius:var(--radius-sm);padding:13px 16px;text-decoration:none;transition:box-shadow var(--t),transform var(--t)}
.kontak-item:hover{box-shadow:var(--shadow);transform:translateX(3px)}
.kontak-icon{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
.kontak-icon.wa{background:#e8fdf1;color:#25D366}
.kontak-icon.email{background:#eef4ff;color:#4285F4}
.kontak-icon.alamat{background:var(--pink-pale);color:var(--pink)}
.kontak-text strong{display:block;font-size:11px;font-weight:700;color:var(--text-light);text-transform:uppercase;letter-spacing:.06em;margin-bottom:2px}
.kontak-text span{font-size:14px;font-weight:600;color:var(--text)}
.profil-info h2{font-family:'Playfair Display',serif;font-size:clamp(1.4rem,3vw,1.9rem);color:var(--text);margin-bottom:16px;line-height:1.3}
.profil-info p{font-size:15px;color:var(--text-mid);line-height:1.9;margin-bottom:14px}
.profil-nilai{display:flex;flex-direction:column;gap:12px;margin-top:20px}
.nilai-item{display:flex;align-items:flex-start;gap:12px}
.nilai-icon{width:36px;height:36px;border-radius:10px;background:var(--pink-pale);display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
.nilai-text strong{display:block;font-size:14px;font-weight:700;color:var(--text);margin-bottom:2px}
.nilai-text span{font-size:13px;color:var(--text-mid)}

/* ═══ TENTANG KAMI ═══ */
.tentang-section{padding:80px 6%}
.tentang-section-head{text-align:center;margin-bottom:48px}
.tentang-section-head h2{font-family:'Playfair Display',serif;font-size:clamp(1.5rem,3vw,2.2rem);color:var(--text);margin-bottom:10px}
.tentang-section-head p{font-size:15px;color:var(--text-mid);max-width:500px;margin:0 auto}
.vm-grid{display:grid;grid-template-columns:1fr 1fr;gap:28px;max-width:860px;margin:0 auto 56px}
.vm-card{background:#fff;border:1px solid var(--border);border-radius:var(--radius);padding:32px;box-shadow:var(--shadow)}
.vm-card .icon{font-size:36px;margin-bottom:16px}
.vm-card h3{font-family:'Playfair Display',serif;font-size:1.2rem;color:var(--text);margin-bottom:12px}
.vm-card p{font-size:14px;color:var(--text-mid);line-height:1.8}

/* ═══ SEJARAH TIMELINE ═══ */
.sejarah-wrap{max-width:860px;margin:0 auto 60px}
.sejarah-wrap .sub-head{font-family:'Playfair Display',serif;font-size:1.4rem;color:var(--text);margin-bottom:8px;text-align:center}
.sejarah-wrap .sub-desc{font-size:14px;color:var(--text-light);text-align:center;margin-bottom:36px}
.timeline{position:relative;padding-left:0}
.timeline::before{content:'';position:absolute;left:50%;top:0;bottom:0;width:2px;background:linear-gradient(to bottom,transparent,var(--pink-light),var(--pink),var(--pink-light),transparent);transform:translateX(-50%)}
.tl-item{display:grid;grid-template-columns:1fr 48px 1fr;gap:0;align-items:start;margin-bottom:36px}
.tl-item:last-child{margin-bottom:0}
.tl-content{background:#fff;border:1px solid var(--border);border-radius:var(--radius);padding:20px 22px;box-shadow:var(--shadow)}
.tl-item.left .tl-content{grid-column:1}
.tl-item.left .tl-spacer{grid-column:2}
.tl-item.left .tl-empty{grid-column:3}
.tl-item.right .tl-empty{grid-column:1}
.tl-item.right .tl-spacer{grid-column:2}
.tl-item.right .tl-content{grid-column:3}
.tl-dot{width:48px;display:flex;justify-content:center;align-items:flex-start;padding-top:18px}
.tl-dot-inner{width:16px;height:16px;border-radius:50%;background:var(--pink);border:3px solid #fff;box-shadow:0 0 0 3px var(--pink-light)}
.tl-year{display:inline-block;background:var(--pink);color:#fff;font-size:12px;font-weight:700;padding:3px 12px;border-radius:20px;margin-bottom:8px}
.tl-content h4{font-size:15px;font-weight:700;color:var(--text);margin-bottom:6px}
.tl-content p{font-size:13px;color:var(--text-mid);line-height:1.7}

/* STATS */
.stats-band{background:var(--pink-pale);border-radius:var(--radius-lg);padding:40px 32px;max-width:680px;margin:0 auto}
.stats-band h3{font-family:'Playfair Display',serif;text-align:center;font-size:1.3rem;color:var(--text);margin-bottom:28px}
.stats-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.stat-item{background:#fff;border-radius:var(--radius);padding:24px 16px;text-align:center;box-shadow:var(--shadow)}
.stat-item .num{font-size:2.2rem;font-weight:800;color:var(--pink);line-height:1;margin-bottom:8px}
.stat-item p{font-size:13px;color:var(--text-mid);font-weight:600}

.divider-section{height:2px;background:linear-gradient(90deg,transparent,var(--pink-light),transparent);margin:0 6%}

@media(max-width:768px){
    .profil-inner{grid-template-columns:1fr}
    .profil-logo-wrap{margin-bottom:4px}
    .vm-grid{grid-template-columns:1fr}
    .stats-grid{grid-template-columns:1fr 1fr}
    .timeline::before{left:20px;transform:none}
    .tl-item,.tl-item.left,.tl-item.right{display:block;padding-left:48px;position:relative}
    .tl-dot{position:absolute;left:0;top:0;width:40px;padding-top:16px}
    .tl-empty{display:none}
    .tl-spacer{display:none}
    .tl-content{margin:0}
}
</style>
@endpush

@section('content')

{{-- ══════════════════════ SECTION 1: HERO ══════════════════════ --}}
<section id="beranda" class="hero">
    <span class="hero-badge">🍩 Selamat Datang</span>
    <h2>Donat Lezat,<br><em>Maw-nya Keterusan</em></h2>
    <p>Brand lokal yang menyajikan donat lembut dengan beragam topping kekinian untuk semua momen spesial Anda.</p>
    <div class="hero-cta">
        <a href="{{ route('katalog') }}" class="btn-pink"><i class="fa-solid fa-shop"></i> Lihat Katalog</a>
        <a href="#profil" class="btn-outline">Tentang Kami</a>
    </div>
</section>

{{-- Produk Favorit --}}
<section class="section-pad">
    <div class="section-head">
        <h2>Produk Pilihan</h2>
        <p>Donat-donat terlezat yang paling banyak digemari</p>
    </div>
    @if($produkFavorit->isEmpty())
        <p style="text-align:center;color:var(--text-light);padding:40px 0">Belum ada produk tersedia.</p>
    @else
    <div class="produk-grid">
        @foreach($produkFavorit as $p)
        <div class="produk-card">
            <a href="{{ route('katalog.detail', $p->id_produk) }}">
                @if($p->gambar)
                    <img class="card-img" src="{{ $p->gambar_url }}" alt="{{ $p->nama_produk }}"
                         width="240" height="180" loading="lazy">
                @else
                    <div class="card-img-placeholder">🍩</div>
                @endif
                <div class="card-body">
                    <p class="kateg">{{ $p->kategori->nama_kategori ?? '' }}</p>
                    <h3>{{ $p->nama_produk }}</h3>
                    <p class="harga">{{ $p->harga_rupiah }}</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <div style="text-align:center;margin-top:36px">
        <a href="{{ route('produk') }}" class="btn-outline">Lihat Semua Produk <i class="fa-solid fa-arrow-right"></i></a>
    </div>
    @endif
</section>

<div class="divider-section"></div>

@endsection
