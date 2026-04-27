@extends('layouts.public')
@section('title', 'Profil Perusahaan — Maw Maw Donut')
@section('metadesc', 'Profil lengkap Maw Maw Donut — donat lokal dengan topping kekinian.')

@push('styles')
<style>
/* ── HERO ── */
.profil-hero{
    background:linear-gradient(135deg,var(--pink),var(--pink-light));
    padding:60px 6%;color:#fff;text-align:center;
}
.profil-hero h1{
    font-family:'Playfair Display',serif;
    font-size:clamp(2rem,5vw,2.5rem);
    font-weight:700;
    margin-bottom:12px;
}
.profil-hero p{
    font-size:16px;
    opacity:.9;
    max-width:560px;
    margin:0 auto;
    line-height:1.7;
}

/* ── PROFIL SECTION ── */
.profil-section{
    background:var(--pink-blush);
    padding:80px 6%;
}
.profil-inner{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:56px;
    align-items:start;
    max-width:1000px;
    margin:0 auto;
}
.profil-logo-wrap{
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:16px;
}
.profil-logo-circle{
    width:180px;
    height:180px;
    border-radius:50%;
    background:var(--pink);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:80px;
    box-shadow:0 16px 48px rgba(242,117,117,.28);
    overflow:hidden;
    margin-bottom:12px;
}
.profil-logo-circle img{
    width:100%;
    height:100%;
    object-fit:cover;
}
.profil-logo-name{
    font-family:'Playfair Display',serif;
    font-size:1.2rem;
    font-weight:700;
    color:var(--text);
    text-align:center;
}
.profil-logo-tag{
    font-size:13px;
    color:var(--text-light);
    font-style:italic;
    text-align:center;
}
.profil-info h2{
    font-family:'Playfair Display',serif;
    font-size:clamp(1.4rem,3vw,1.8rem);
    font-weight:700;
    color:var(--text);
    margin-bottom:16px;
    line-height:1.3;
}
.profil-info p{
    font-size:15px;
    color:var(--text-mid);
    line-height:1.9;
    margin-bottom:16px;
}
.profil-nilai{
    display:flex;
    flex-direction:column;
    gap:14px;
    margin-top:24px;
}
.nilai-item{
    display:flex;
    align-items:flex-start;
    gap:12px;
}
.nilai-icon{
    width:36px;
    height:36px;
    border-radius:10px;
    background:var(--pink-pale);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
    flex-shrink:0;
}
.nilai-text strong{
    display:block;
    font-size:14px;
    font-weight:700;
    color:var(--text);
    margin-bottom:2px;
}
.nilai-text span{
    font-size:13px;
    color:var(--text-mid);
}

/* ── SEJARAH ── */
.sejarah-section{
    padding:80px 6%;
    background:#fff;
}
.sejarah-container h2{
    font-family:'Playfair Display',serif;
    font-size:clamp(1.4rem,3vw,1.8rem);
    color:var(--pink);
    margin-bottom:8px;
    text-align:center;
}
.sejarah-sub{
    font-size:15px;
    color:var(--text-light);
    text-align:center;
    margin-bottom:40px;
}
.sejarah-container p{
    font-size:15px;
    color:var(--text-mid);
    line-height:1.9;
    margin-bottom:16px;
}
.timeline{
    position:relative;
    padding-left:32px;
    max-width:760px;
    margin:32px auto 0;
}
.timeline::before{
    content:'';
    position:absolute;
    left:8px;
    top:0;
    bottom:0;
    width:2px;
    background:linear-gradient(var(--pink),var(--pink-light));
    border-radius:2px;
}
.tl-item{
    position:relative;
    margin-bottom:28px;
}
.tl-item:last-child{
    margin-bottom:0;
}
.tl-dot{
    position:absolute;
    left:-28px;
    top:4px;
    width:16px;
    height:16px;
    border-radius:50%;
    background:var(--pink);
    border:3px solid #fff;
    box-shadow:0 0 0 2px var(--pink);
}
.tl-year{
    font-size:12px;
    font-weight:800;
    color:var(--pink);
    text-transform:uppercase;
    letter-spacing:.08em;
    margin-bottom:4px;
}
.tl-text{
    font-size:15px;
    color:var(--text-mid);
    line-height:1.7;
}

/* ── INFO KONTAK ── */
.info-section{
    background:var(--pink-blush);
    padding:80px 6%;
}
.info-section h2{
    text-align:center;
    font-family:'Playfair Display',serif;
    font-size:clamp(1.4rem,3vw,1.8rem);
    color:var(--pink);
    margin-bottom:40px;
    font-weight:700;
}
.info-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:24px;
    max-width:1000px;
    margin:0 auto 48px;
}
.info-card{
    background:#fff;
    border-radius:var(--radius);
    padding:32px 24px;
    text-align:center;
    box-shadow:var(--shadow);
    transition:transform var(--t),box-shadow var(--t);
}
.info-card:hover{
    transform:translateY(-4px);
    box-shadow:0 12px 32px rgba(242,117,117,.18);
}
.info-card i{
    font-size:32px;
    color:var(--pink);
    margin-bottom:16px;
    display:block;
}
.info-card h3{
    font-size:16px;
    font-weight:700;
    color:var(--text);
    margin-bottom:8px;
}
.info-card p, .info-card a{
    font-size:14px;
    color:var(--text-mid);
    line-height:1.7;
    text-decoration:none;
}
.info-card a:hover{
    color:var(--pink);
}
.wa-cta-wrap{
    text-align:center;
}
.btn-wa-big{
    display:inline-flex;
    align-items:center;
    gap:10px;
    background:#25d366;
    color:#fff;
    padding:14px 36px;
    border-radius:28px;
    text-decoration:none;
    font-size:16px;
    font-weight:700;
    box-shadow:0 6px 20px rgba(37,211,102,.3);
    transition:background .2s, transform .2s;
}
.btn-wa-big:hover{
    background:#1ebe5d;
    transform:translateY(-2px);
}

/* ── RESPONSIVE ── */
@media(max-width:768px){
    .profil-inner{grid-template-columns:1fr;gap:32px}
    .profil-logo-wrap{flex-direction:row;align-items:center;gap:20px;justify-content:flex-start}
    .profil-logo-circle{width:80px;height:80px;font-size:36px}
    .profil-logo-name{text-align:left;flex:1}
    .profil-logo-tag{text-align:left}
    .sejarah-section{padding:60px 5%}
    .info-section{padding:60px 5%}
}
</style>
@endpush

@section('content')

{{-- ── HERO ── --}}
<section class="profil-hero">
    <h1>Profil Perusahaan</h1>
    <p>Brand lokal yang menyajikan kebahagiaan lewat donat lembut dengan beragam topping kekinian.</p>
</section>

{{-- ── PROFIL ── --}}
<section class="profil-section">
    <div class="profil-inner">
        <div class="profil-logo-wrap">
            <div class="profil-logo-circle">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo Maw Maw Donut" loading="lazy">
            </div>
            <p class="profil-logo-name">Maw Maw Donut</p>
            <p class="profil-logo-tag">Brand Donat Lokal Indonesia</p>
        </div>
        <div class="profil-info">
            <h2>Kenalan Lebih Dekat dengan
                <span style="color:var(--pink)">Maw Maw Donut</span>
            </h2>
            <p>Maw Maw Donut adalah brand donat lokal yang hadir untuk menghadirkan kelezatan di setiap momen spesial Anda. Kami percaya bahwa makanan yang baik dimulai dari bahan-bahan pilihan.</p>
            <p>Dibuat dengan cinta, disajikan dengan kehangatan — karena setiap gigitan harus berkesan dan selalu membuat ketagihan.</p>
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

{{-- ── SEJARAH ── --}}
<section class="sejarah-section">
    <div class="sejarah-container">
        <h2>Sejarah Maw Maw Donut</h2>
        <p class="sejarah-sub">Perjalanan kami dari dapur kecil hingga brand lokal yang dicintai.</p>
        <p>Maw Maw Donut lahir dari passion seorang ibu rumah tangga yang ingin menghadirkan camilan berkualitas bagi keluarga dan lingkungan sekitarnya. Berawal dari dapur kecil, resep turun-temurun dipadukan dengan kreasi topping kekinian hingga digemari banyak orang.</p>
        <p>Perlahan namun pasti, usaha ini berkembang dari sekadar pesanan tetangga menjadi brand lokal yang dikenal luas. Dengan semangat yang tidak pernah padam, kami terus berinovasi demi memberikan yang terbaik bagi pelanggan setia kami.</p>
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
</section>

{{-- ── INFO KONTAK ── --}}
<section class="info-section">
    <h2>Informasi Kontak</h2>
    <div class="info-grid">
        <div class="info-card">
            <i class="fas fa-map-marker-alt"></i>
            <h3>Alamat</h3>
            <p>Cabang Pusat Maw Maw Donut</p>
        </div>
        <div class="info-card">
            <i class="fab fa-whatsapp"></i>
            <h3>WhatsApp</h3>
            <a href="https://wa.me/6281528844756" target="_blank" rel="noopener">0815-2884-4756</a>
        </div>
        <div class="info-card">
            <i class="fas fa-envelope"></i>
            <h3>Email</h3>
            <a href="mailto:mawmawdonut@gmail.com">mawmawdonut@gmail.com</a>
        </div>
        <div class="info-card">
            <i class="fas fa-clock"></i>
            <h3>Jam Operasional</h3>
            <p>08.00 – 22.00 WIB<br>Setiap Hari</p>
        </div>
    </div>
    <div class="wa-cta-wrap">
        <a href="https://wa.me/6281528844756" class="btn-wa-big" target="_blank" rel="noopener">
            <i class="fab fa-whatsapp"></i> Pesan Sekarang via WhatsApp
        </a>
    </div>
</section>

@endsection
