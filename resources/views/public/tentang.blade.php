@extends('layouts.public')
@section('title', 'Tentang Kami — Maw Maw Donut')
@section('metadesc', 'Tentang perjalanan Maw Maw Donut dalam menghadirkan donat lezat untuk semua orang.')

@push('styles')
<style>
    /* ── HERO ── */
    .tentang-hero {
        position: relative;
        overflow: hidden;
        padding: 60px 6%;
        color: #fff;
        text-align: center;
    }

    .tentang-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('/images/tentang_bg.jpg') center/cover no-repeat;
        z-index: 0;
        filter: brightness(.75)
    }

    .tentang-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(242, 117, 117, .8), rgba(255, 198, 201, .6));
        z-index: 1
    }

    .tentang-hero>* {
        position: relative;
        z-index: 2
    }

    .tentang-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 5vw, 2.5rem);
        font-weight: 700;
        margin-bottom: 12px;
        text-shadow: 0 2px 12px rgba(0, 0, 0, .18);
    }

    .tentang-hero p {
        font-size: 16px;
        opacity: .95;
        max-width: 560px;
        margin: 0 auto;
        line-height: 1.7;
        text-shadow: 0 1px 6px rgba(0, 0, 0, .12);
    }

    /* ── VISI MISI ── */
    .visimisi-section {
        padding: 80px 6%;
        background: #fff;
        position: relative;
        overflow: hidden;
    }

    .visimisi-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('/images/pattern_donat.jpg') repeat;
        background-size: 320px;
        opacity: .04;
        pointer-events: none;
        z-index: 0
    }

    .visimisi-section>* {
        position: relative;
        z-index: 1
    }

    .visimisi-section h2 {
        text-align: center;
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.4rem, 3vw, 1.8rem);
        color: var(--pink);
        margin-bottom: 12px;
        font-weight: 700;
    }

    .visimisi-section p.sub {
        text-align: center;
        font-size: 15px;
        color: var(--text-light);
        margin-bottom: 56px;
    }

    .visimisi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 32px;
        max-width: 960px;
        margin: 0 auto;
    }

    .vm-card {
        background: #fff;
        border-radius: var(--radius);
        padding: 40px 36px;
        text-align: left;
        box-shadow: 0 8px 24px rgba(242, 117, 117, .12);
        border-top: 5px solid var(--pink);
        transition: transform var(--t), box-shadow var(--t);
    }

    .vm-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 36px rgba(242, 117, 117, .18);
    }

    .vm-card.misi {
        border-top-color: var(--pink-light)
    }

    .vm-card .vm-icon {
        font-size: 2.6rem;
        margin-bottom: 20px;
        display: block;
    }

    .vm-card h3 {
        font-size: 20px;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 16px;
    }

    .vm-card.misi h3 {
        color: var(--pink)
    }

    .vm-card p {
        font-size: 15px;
        color: var(--text-mid);
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
        color: var(--text-mid);
        line-height: 1.7;
    }

    .vm-card ul li::before {
        content: '●';
        color: var(--pink);
        font-size: 11px;
        flex-shrink: 0;
        margin-top: 4px;
    }

    /* ── PENCAPAIAN ── */
    .achiev-section {
        padding: 80px 6%;
        position: relative;
        overflow: hidden;
    }

    .achiev-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('/images/interior_1.jpg') center/cover no-repeat;
        opacity: .06;
        pointer-events: none;
        z-index: 0
    }

    .achiev-section::after {
        content: '';
        position: absolute;
        inset: 0;
        background: var(--pink-blush);
        opacity: .92;
        z-index: 0
    }

    .achiev-section>* {
        position: relative;
        z-index: 1
    }

    .achiev-section h2 {
        text-align: center;
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.4rem, 3vw, 1.8rem);
        color: var(--pink);
        margin-bottom: 12px;
        font-weight: 700;
    }

    .achiev-section p.sub {
        text-align: center;
        font-size: 15px;
        color: var(--text-light);
        margin-bottom: 56px;
    }

    .achiev-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 24px;
        max-width: 1000px;
        margin: 0 auto 56px;
    }

    .achiev-card {
        background: #fff;
        border-radius: var(--radius);
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
        color: var(--pink);
        line-height: 1;
        margin-bottom: 8px;
    }

    .achiev-card .achiev-label {
        font-size: 14px;
        color: var(--text-mid);
        font-weight: 600;
    }

    /* ── TIMELINE ── */
    .timeline-wrap {
        max-width: 760px;
        margin: 0 auto;
    }

    .timeline-wrap h3 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.2rem, 3vw, 1.4rem);
        font-weight: 700;
        color: var(--text);
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
        background: linear-gradient(var(--pink), var(--pink-light));
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
        background: var(--pink);
        border: 3px solid #fff;
        box-shadow: 0 0 0 2px var(--pink);
    }

    .tl-year {
        font-size: 12px;
        font-weight: 800;
        color: var(--pink);
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-bottom: 4px;
    }

    .tl-text {
        font-size: 15px;
        color: var(--text-mid);
        line-height: 1.7;
    }

    /* ── INFO KONTAK ── */
    .info-section {
        background: #fff;
        padding: 60px 6%;
    }

    .info-section h2 {
        text-align: center;
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.4rem, 3vw, 1.8rem);
        color: var(--pink);
        margin-bottom: 36px;
        font-weight: 700;
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
        border-radius: var(--radius);
        padding: 30px 24px;
        text-align: center;
        box-shadow: 0 4px 16px rgba(0, 0, 0, .06);
        transition: transform var(--t), box-shadow var(--t);
    }

    .info-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(242, 117, 117, .18);
    }

    .info-card i {
        font-size: 32px;
        color: var(--pink);
        margin-bottom: 16px;
        display: block;
    }

    .info-card h3 {
        font-size: 16px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 8px;
    }

    .info-card p,
    .info-card a {
        font-size: 14px;
        color: var(--text-mid);
        line-height: 1.7;
        text-decoration: none;
    }

    .info-card a:hover {
        color: var(--pink);
    }

    /* ── RESPONSIVE ── */
    @media(max-width:768px) {
        .visimisi-grid {
            grid-template-columns: 1fr
        }

        .achiev-grid {
            grid-template-columns: repeat(2, 1fr)
        }

        .timeline-wrap {
            padding-left: 16px
        }

        .tl-dot {
            left: -36px
        }
    }

    @media(max-width:480px) {
        .achiev-grid {
            grid-template-columns: 1fr
        }

        .timeline-wrap {
            padding-left: 24px
        }

        .tl-dot {
            left: -20px
        }
    }
</style>
@endpush

@section('content')

{{-- ── HERO ── --}}
<section class="tentang-hero">
    <h1>Tentang Kami</h1>
    <p>Kenalan lebih dekat dengan Maw Maw Donut 🍩</p>
</section>

{{-- ── VISI MISI ── --}}
<section class="visimisi-section">
    <h2>Visi Misi</h2>
    <p class="sub">Landasan yang mengarahkan setiap langkah kami dalam menghadirkan yang terbaik.</p>
    <div class="visimisi-grid">
        <div class="vm-card">
            <span class="vm-icon">🎯</span>
            <h3>Visi</h3>
            <p>Menjadi brand donat lokal nomor satu yang dikenal dengan kelezatan, inovasi, dan kehangatan di setiap gigitan — menghadirkan kebahagiaan manis untuk seluruh keluarga Indonesia.</p>
        </div>
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

{{-- ── INFO KONTAK ── --}}
<section class="info-section">
    <h2>Temukan Kami</h2>
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
</section>

@endsection