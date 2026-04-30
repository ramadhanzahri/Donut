@extends('layouts.public')

@section('title', 'Katalog Produk — ' . ($profile->nama_perusahaan ?? 'Maw Maw Donut'))
@section('metadesc', 'Temukan semua varian donat lezat kami dengan berbagai topping kekinian.')

@push('styles')
<style>
/* ── HERO ── */
.katalog-hero{
    position:relative;overflow:hidden;
    padding:60px 6% 50px;
    text-align:center;
    color:#fff;
}
.katalog-hero::before{content:'';position:absolute;inset:0;
    background:url('/images/interior2.jpg') center/cover no-repeat;z-index:0;filter:brightness(.65)}
.katalog-hero::after{content:'';position:absolute;inset:0;
    background:linear-gradient(135deg,rgba(242,117,117,.78) 0%,rgba(255,179,186,.55) 100%);z-index:1}
.katalog-hero>*{position:relative;z-index:2}
.katalog-hero h1{
    font-family:'Playfair Display',serif;
    font-size:clamp(2rem,5vw,3rem);
    margin-bottom:10px;
    text-shadow:0 2px 12px rgba(0,0,0,.2);
}
.katalog-hero p{font-size:15px;opacity:.95;text-shadow:0 1px 6px rgba(0,0,0,.12)}

/* ── SEARCH BAR ── */
.search-section{
    background:#fff;
    padding:28px 6% 0;
    position:sticky;
    top:60px;
    z-index:100;
    border-bottom:1px solid var(--border);
}
.search-bar{
    display:flex;
    align-items:center;
    background:var(--pink-pale);
    border:2px solid var(--border);
    border-radius:50px;
    padding:6px 8px 6px 20px;
    gap:8px;
    max-width:640px;
    margin:0 auto 20px;
    transition:border-color var(--t),box-shadow var(--t);
}
.search-bar:focus-within{
    border-color:var(--pink);
    box-shadow:0 0 0 3px rgba(242,117,117,.15);
}
.search-bar i{color:var(--pink);font-size:16px;flex-shrink:0}
.search-bar input{
    flex:1;background:transparent;border:none;outline:none;
    font-size:15px;color:var(--text);
    font-family:'DM Sans',sans-serif;
}
.search-bar input::placeholder{color:var(--text-light)}
.search-bar button{
    background:var(--pink);color:#fff;border:none;
    border-radius:50px;padding:9px 20px;
    font-size:13px;font-weight:700;cursor:pointer;
    transition:background var(--t);white-space:nowrap;
    font-family:'DM Sans',sans-serif;
}
.search-bar button:hover{background:var(--pink-dark)}
.search-clear{
    background:none;border:none;color:var(--text-light);
    font-size:18px;cursor:pointer;padding:0 4px;
    transition:color var(--t);
}
.search-clear:hover{color:var(--pink)}

/* ── FILTER AREA ── */
.filter-section{background:#fff;padding:0 6% 16px}
.filter-row{
    display:flex;align-items:center;gap:10px;
    flex-wrap:wrap;padding-top:14px;
}
.filter-row+.filter-row{padding-top:10px;border-top:1px solid var(--border)}
.filter-label{
    font-size:11px;font-weight:700;color:var(--text-light);
    text-transform:uppercase;letter-spacing:.08em;white-space:nowrap;
    min-width:60px;
}
.pills{display:flex;gap:8px;flex-wrap:wrap;align-items:center}
.pill{
    display:inline-flex;align-items:center;gap:6px;
    padding:7px 16px;border-radius:20px;
    border:1.5px solid var(--border);
    color:var(--text-mid);font-size:13px;font-weight:600;
    text-decoration:none;cursor:pointer;background:#fff;
    transition:all var(--t);white-space:nowrap;
}
.pill:hover{border-color:var(--pink);color:var(--pink);background:var(--pink-pale)}
.pill.active{background:var(--pink);color:#fff;border-color:var(--pink)}
.pill .pill-count{
    background:rgba(255,255,255,.3);
    padding:1px 7px;border-radius:20px;font-size:11px;
}
.pill.active .pill-count{background:rgba(255,255,255,.25)}

/* ── RESULT INFO ── */
.result-section{
    padding:20px 6% 0;
    display:flex;align-items:center;justify-content:space-between;
    flex-wrap:wrap;gap:10px;
}
.result-info{font-size:13px;color:var(--text-light)}
.result-info strong{color:var(--text);font-weight:700}
.reset-all{
    display:inline-flex;align-items:center;gap:6px;
    font-size:12px;color:var(--pink);font-weight:600;
    text-decoration:none;padding:5px 12px;border-radius:20px;
    border:1.5px solid var(--pink-light);
    transition:background var(--t);
}
.reset-all:hover{background:var(--pink-pale)}

/* ── PRODUK GRID ── */
.produk-section{padding:24px 6% 60px}
.produk-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(min(230px,100%),1fr));
    gap:24px;
}
.produk-card{
    background:#fff;border-radius:var(--radius);
    overflow:hidden;
    box-shadow:0 4px 16px rgba(0,0,0,.07);
    transition:transform var(--t),box-shadow var(--t);
    display:flex;flex-direction:column;
}
.produk-card:hover{transform:translateY(-5px);box-shadow:0 12px 32px rgba(242,117,117,.18)}
.produk-card a{text-decoration:none;color:inherit;display:flex;flex-direction:column;flex:1}
.card-img{
    width:100%;height:200px;object-fit:cover;display:block;
    background:var(--pink-pale);
}
.card-img-placeholder{
    height:200px;background:linear-gradient(135deg,#fce4ec,var(--pink-pale));
    display:flex;align-items:center;justify-content:center;font-size:56px;
}
.card-body{padding:16px;flex:1;display:flex;flex-direction:column}
.card-kat{
    font-size:11px;font-weight:700;color:var(--pink);
    text-transform:uppercase;letter-spacing:.06em;margin-bottom:5px;
}
.card-nama{
    font-size:15px;font-weight:700;color:var(--text);
    margin-bottom:8px;line-height:1.3;flex:1;
}
.card-harga{font-size:17px;font-weight:800;color:var(--pink)}

/* Highlight search keyword */
mark{background:rgba(242,117,117,.2);color:var(--pink);border-radius:3px;padding:0 2px}

/* ── EMPTY STATE ── */
.empty-wrap{text-align:center;padding:80px 20px;color:var(--text-light)}
.empty-wrap .empty-icon{font-size:56px;margin-bottom:16px}
.empty-wrap h3{font-size:18px;color:var(--text);margin-bottom:8px}
.empty-wrap p{font-size:14px;max-width:300px;margin:0 auto 20px}

@media(max-width:640px){
    .search-section{position:relative;top:auto}
    .filter-row{gap:8px}
    .katalog-hero{padding:40px 5% 32px}
}
</style>
@endpush

@section('content')

{{-- ── HERO ── --}}
<section class="katalog-hero">
    <h1>🍩 Katalog Produk</h1>
    <p>Temukan semua varian donat lezat — topping kekinian, rasa yang tak terlupakan</p>
</section>

{{-- ── SEARCH + FILTER STICKY ── --}}
<div class="search-section">
    {{-- Search Bar --}}
    <form method="GET" action="{{ route('katalog') }}" id="searchForm">
        {{-- Pertahankan parameter lain --}}
        @if(request('kategori'))
            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
        @endif
        @if(request('sort'))
            <input type="hidden" name="sort" value="{{ request('sort') }}">
        @endif

        <div class="search-bar">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="q" id="searchInput"
                   placeholder="Cari nama produk donat..."
                   value="{{ request('q') }}"
                   autocomplete="off">
            @if(request('q'))
            <button type="button" class="search-clear" onclick="clearSearch()" title="Hapus pencarian">
                <i class="fa-solid fa-xmark"></i>
            </button>
            @endif
            <button type="submit">Cari</button>
        </div>
    </form>

    <div class="filter-section">
        {{-- Filter Kategori --}}
        <div class="filter-row">
            <span class="filter-label"><i class="fa-solid fa-tags"></i> Kategori</span>
            <div class="pills">
                <a href="{{ route('katalog', array_filter(['q' => request('q'), 'sort' => request('sort')])) }}"
                   class="pill {{ !request('kategori') ? 'active' : '' }}">
                    Semua
                </a>
                @foreach($kategoris as $kat)
                <a href="{{ route('katalog', array_filter(['kategori' => $kat->id_kategori, 'q' => request('q'), 'sort' => request('sort')])) }}"
                   class="pill {{ request('kategori') == $kat->id_kategori ? 'active' : '' }}">
                    {{ $kat->nama_kategori }}
                    <span class="pill-count">{{ $kat->produk_count }}</span>
                </a>
                @endforeach
            </div>
        </div>

        {{-- Sort --}}
        <div class="filter-row">
            <span class="filter-label"><i class="fa-solid fa-arrow-up-down"></i> Urutkan</span>
            <div class="pills">
                @php
                $sorts = [
                    ''               => ['icon' => 'fa-clock',          'label' => 'Terbaru'],
                    'nama_asc'       => ['icon' => 'fa-arrow-down-a-z', 'label' => 'Nama A–Z'],
                    'nama_desc'      => ['icon' => 'fa-arrow-up-z-a',   'label' => 'Nama Z–A'],
                    'harga_termurah' => ['icon' => 'fa-circle-arrow-down','label'=> 'Harga Termurah'],
                    'harga_termahal' => ['icon' => 'fa-circle-arrow-up', 'label' => 'Harga Termahal'],
                ];
                @endphp
                @foreach($sorts as $value => $opt)
                <a href="{{ route('katalog', array_filter(['kategori' => request('kategori'), 'q' => request('q'), 'sort' => $value ?: null])) }}"
                   class="pill {{ request('sort', '') === $value ? 'active' : '' }}">
                    <i class="fa-solid {{ $opt['icon'] }}"></i>
                    {{ $opt['label'] }}
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- ── RESULT INFO ── --}}
<div class="result-section">
    <div class="result-info">
        @if(request('q'))
            Hasil pencarian "<strong>{{ request('q') }}</strong>": 
        @endif
        <strong>{{ $produks->count() }}</strong> produk ditemukan
        @if(request('kategori'))
            @php $aktifKat = $kategoris->firstWhere('id_kategori', request('kategori')); @endphp
            @if($aktifKat) dalam kategori <strong>{{ $aktifKat->nama_kategori }}</strong> @endif
        @endif
    </div>

    @if(request()->hasAny(['q','kategori','sort']))
    <a href="{{ route('katalog') }}" class="reset-all">
        <i class="fa-solid fa-rotate-left"></i> Reset Filter
    </a>
    @endif
</div>

{{-- ── PRODUK GRID ── --}}
<section class="produk-section">
    @if($produks->isEmpty())
    <div class="empty-wrap">
        <div class="empty-icon">🔍</div>
        <h3>Produk Tidak Ditemukan</h3>
        <p>
            @if(request('q'))
                Tidak ada produk dengan kata kunci "{{ request('q') }}".
            @else
                Belum ada produk di kategori ini.
            @endif
        </p>
        <a href="{{ route('katalog') }}" class="btn-pink" style="display:inline-flex">
            <i class="fa-solid fa-rotate-left"></i> Lihat Semua Produk
        </a>
    </div>
    @else
    <div class="produk-grid">
        @foreach($produks as $produk)
        <div class="produk-card">
            <a href="{{ route('katalog.detail', $produk->id_produk) }}">
                @if($produk->gambar)
                    <img class="card-img"
                         src="{{ Storage::url($produk->gambar) }}"
                         alt="{{ $produk->nama_produk }}"
                         loading="lazy" width="230" height="200">
                @else
                    <div class="card-img-placeholder">🍩</div>
                @endif
                <div class="card-body">
                    <div class="card-kat">{{ $produk->kategori->nama_kategori ?? '' }}</div>
                    <div class="card-nama">
                        @if(request('q'))
                            {!! str_ireplace(
                                request('q'),
                                '<mark>' . request('q') . '</mark>',
                                e($produk->nama_produk)
                            ) !!}
                        @else
                            {{ $produk->nama_produk }}
                        @endif
                    </div>
                    <div class="card-harga">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @endif
</section>

@endsection

@push('scripts')
<script>
function clearSearch(){
    var url = new URL(window.location.href);
    url.searchParams.delete('q');
    window.location.href = url.toString();
}

// Live search suggestion — Enter key submit
document.getElementById('searchInput').addEventListener('keydown', function(e){
    if(e.key === 'Enter') document.getElementById('searchForm').submit();
});
</script>
@endpush
