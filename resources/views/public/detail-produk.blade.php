@extends('layouts.public')
@section('title', $produk->nama_produk)
@section('metadesc', Str::limit(strip_tags($produk->deskripsi ?? 'Produk dari Maw Maw Donut'), 160))

@push('styles')
<style>
    .detail-wrap {
        padding: 48px 6%;
        max-width: 1100px;
        margin: 0 auto;
        position: relative
    }

    .detail-wrap::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('/images/pattern_donat.jpg') repeat;
        background-size: 340px;
        opacity: .03;
        pointer-events: none;
        z-index: 0;
        border-radius: 24px
    }

    .detail-wrap>* {
        position: relative;
        z-index: 1
    }

    .breadcrumb {
        font-size: 13px;
        color: var(--text-light);
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        gap: 6px
    }

    .breadcrumb a {
        color: var(--text-mid);
        text-decoration: none
    }

    .breadcrumb a:hover {
        color: var(--pink)
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 48px;
        align-items: start
    }

    .detail-img {
        border-radius: var(--radius-lg);
        overflow: hidden;
        border: 1px solid var(--border);
        background: var(--pink-pale)
    }

    .detail-img img {
        width: 100%;
        aspect-ratio: 1;
        object-fit: cover
    }

    .detail-img .no-img {
        width: 100%;
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 80px
    }

    .detail-info .kateg {
        font-size: 12px;
        font-weight: 700;
        color: var(--pink);
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-bottom: 10px
    }

    .detail-info h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.5rem, 3vw, 2rem);
        color: var(--text);
        margin-bottom: 16px;
        line-height: 1.25
    }

    .detail-info .harga {
        font-size: 2rem;
        font-weight: 800;
        color: var(--pink);
        margin-bottom: 20px
    }

    .detail-info .desc {
        font-size: 15px;
        color: var(--text-mid);
        line-height: 1.85;
        margin-bottom: 24px
    }

    .badge-nonaktif {
        display: inline-block;
        background: #ffe5e5;
        color: #e53935;
        font-size: 12px;
        font-weight: 700;
        padding: 5px 14px;
        border-radius: 20px;
        margin-bottom: 16px
    }

    .related-section {
        padding: 0 6% 64px
    }

    .related-section h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        margin-bottom: 24px;
        color: var(--text)
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(min(180px, 100%), 1fr));
        gap: 18px
    }

    .rel-card {
        background: #fff;
        border-radius: var(--radius);
        border: 1px solid var(--border);
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        box-shadow: var(--shadow);
        transition: transform var(--t)
    }

    .rel-card:hover {
        transform: translateY(-3px)
    }

    .rel-img {
        width: 100%;
        height: 130px;
        object-fit: cover;
        background: var(--pink-pale);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px
    }

    .rel-body {
        padding: 12px
    }

    .rel-body p {
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 4px
    }

    .rel-body span {
        font-size: 13px;
        color: var(--pink);
        font-weight: 700
    }

    @media(max-width:768px) {
        .detail-grid {
            grid-template-columns: 1fr
        }
    }
</style>
@endpush

@section('content')
<div class="detail-wrap">
    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="{{ route('beranda') }}">Beranda</a>
        <i class="fa-solid fa-chevron-right" style="font-size:10px"></i>
        <a href="{{ route('katalog') }}">Katalog</a>
        <i class="fa-solid fa-chevron-right" style="font-size:10px"></i>
        <span style="color:var(--pink)">{{ $produk->nama_produk }}</span>
    </div>

    <div class="detail-grid">
        {{-- Gambar --}}
        <div class="detail-img">
            @if($produk->gambar)
            <img src="{{ $produk->gambar_url }}" alt="{{ $produk->nama_produk }}" loading="eager">
            @else
            <div class="no-img">🍩</div>
            @endif
        </div>

        {{-- Info --}}
        <div class="detail-info">
            @if($produk->status == 'nonaktif')
            <span class="badge-nonaktif">⛔ Stok Habis</span>
            @endif
            <p class="kateg">{{ $produk->kategori->nama_kategori ?? 'Produk' }}</p>
            <h1>{{ $produk->nama_produk }}</h1>
            <div class="harga">{{ $produk->harga_rupiah }}</div>
            <div class="desc">
                @if($produk->deskripsi)
                {!! nl2br(e($produk->deskripsi)) !!}
                @else
                <em style="color:var(--text-light)">Deskripsi produk belum tersedia.</em>
                @endif
            </div>
            <a href="{{ route('katalog') }}" class="btn-outline" style="align-self:flex-start">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Katalog
            </a>
        </div>
    </div>
</div>

{{-- Produk Terkait --}}
@if($related->isNotEmpty())
<section class="related-section">
    <h3>Produk Terkait</h3>
    <div class="related-grid">
        @foreach($related as $item)
        <a class="rel-card" href="{{ route('katalog.detail', $item->id_produk) }}">
            @if($item->gambar)
            <img class="rel-img" src="{{ $item->gambar_url }}" alt="{{ $item->nama_produk }}"
                width="180" height="130" loading="lazy" style="display:block;object-fit:cover">
            @else
            <div class="rel-img">🍩</div>
            @endif
            <div class="rel-body">
                <p>{{ $item->nama_produk }}</p>
                <span>{{ $item->harga_rupiah }}</span>
            </div>
        </a>
        @endforeach
    </div>
</section>
@endif
@endsection