@extends('layouts.public')
@section('title', 'Semua Produk')

@push('styles')
<style>
/* ── HERO ── */
.produk-hero{
    position:relative;overflow:hidden;
    padding:60px 6%;color:#fff;text-align:center;
}
.produk-hero::before{content:'';position:absolute;inset:0;
    background:url('/images/interior_1.jpg') center/cover no-repeat;z-index:0;filter:brightness(.65)}
.produk-hero::after{content:'';position:absolute;inset:0;
    background:linear-gradient(135deg,rgba(242,117,117,.75),rgba(255,179,186,.55));z-index:1}
.produk-hero>*{position:relative;z-index:2}
.produk-hero h1{
    font-family:'Playfair Display',serif;
    font-size:clamp(28px,5vw,48px);font-weight:700;margin-bottom:10px;
    text-shadow:0 2px 12px rgba(0,0,0,.2);
}
.produk-hero p{font-size:15px;opacity:.95;max-width:480px;margin:0 auto;text-shadow:0 1px 6px rgba(0,0,0,.12)}

/* ── SEARCH BAR ── */
.search-section{
    background:var(--pink-blush);border-bottom:1px solid var(--border);
    padding:24px 6%;
}
.search-wrap{
    max-width:600px;margin:0 auto;
    display:flex;gap:10px;align-items:center;
}
.search-input-wrap{
    flex:1;position:relative;
}
.search-input-wrap i{
    position:absolute;left:16px;top:50%;transform:translateY(-50%);
    color:var(--pink);font-size:15px;pointer-events:none;
}
.search-input{
    width:100%;padding:13px 44px 13px 44px;
    border:2px solid var(--border);border-radius:50px;
    font-size:14px;font-family:'DM Sans',sans-serif;
    background:#fff;color:var(--text);outline:none;
    transition:border-color var(--t),box-shadow var(--t);
}
.search-input:focus{border-color:var(--pink);box-shadow:0 0 0 3px rgba(242,117,117,.12)}
.search-input::placeholder{color:var(--text-light)}
.search-clear{
    position:absolute;right:16px;top:50%;transform:translateY(-50%);
    background:none;border:none;color:var(--text-light);cursor:pointer;
    font-size:14px;padding:4px;display:none;
    transition:color var(--t);
}
.search-clear:hover{color:var(--pink)}
.search-clear.visible{display:block}
.search-btn{
    padding:13px 24px;background:var(--pink);color:#fff;
    border:none;border-radius:50px;font-size:14px;font-weight:600;
    font-family:'DM Sans',sans-serif;cursor:pointer;
    display:flex;align-items:center;gap:6px;white-space:nowrap;
    transition:background var(--t),transform var(--t);
    box-shadow:0 4px 14px rgba(242,117,117,.28);
}
.search-btn:hover{background:var(--pink-dark);transform:translateY(-1px)}

/* ── PRODUK SECTION ── */
.produk-section{padding:40px 6% 80px}
.produk-info-bar{
    display:flex;align-items:center;justify-content:space-between;
    margin-bottom:24px;flex-wrap:wrap;gap:10px;
}
.produk-count{
    font-size:14px;color:var(--text-mid);
}
.produk-count strong{color:var(--pink);font-weight:700}

/* Search result tag */
.search-tag{
    display:inline-flex;align-items:center;gap:6px;
    background:var(--pink-pale);color:var(--pink);
    padding:5px 14px;border-radius:20px;font-size:13px;font-weight:600;
}
.search-tag a{color:var(--pink);text-decoration:none;margin-left:2px;font-size:12px}
.search-tag a:hover{text-decoration:underline}

/* ── GRID ── */
.produk-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
    gap:22px;
}
.produk-card{
    background:#fff;border-radius:var(--radius);overflow:hidden;
    box-shadow:0 4px 18px rgba(0,0,0,.07);
    text-decoration:none;color:inherit;
    transition:transform var(--t),box-shadow var(--t);
    display:flex;flex-direction:column;
}
.produk-card:hover{transform:translateY(-6px);box-shadow:0 14px 36px rgba(242,117,117,.15)}
.produk-card-img{
    width:100%;height:200px;object-fit:cover;display:block;
    background:linear-gradient(135deg,var(--pink-pale),var(--pink-light));
}
.produk-card-placeholder{
    width:100%;height:200px;background:linear-gradient(135deg,var(--pink-pale),var(--pink-light));
    display:flex;align-items:center;justify-content:center;font-size:52px;
}
.produk-card-body{padding:16px;flex:1;display:flex;flex-direction:column}
.produk-card-kateg{
    font-size:11px;font-weight:700;color:var(--pink);text-transform:uppercase;
    letter-spacing:.06em;margin-bottom:6px;
}
.produk-card-name{
    font-size:15px;font-weight:700;color:var(--text);line-height:1.3;
    margin-bottom:8px;flex:1;
}
.produk-card-name mark{
    background:rgba(242,117,117,.18);color:var(--pink-dark);
    border-radius:3px;padding:0 2px;
}
.produk-card-harga{
    font-size:16px;font-weight:800;color:var(--pink);
}
.produk-card-footer{
    display:flex;align-items:center;justify-content:space-between;
    margin-top:10px;
}
.produk-card-btn{
    font-size:11px;font-weight:700;color:var(--pink);
    background:var(--pink-pale);border-radius:20px;padding:5px 12px;
    text-decoration:none;transition:background var(--t),color var(--t);
}
.produk-card:hover .produk-card-btn{background:var(--pink);color:#fff}

/* ── EMPTY ── */
.empty-state{
    text-align:center;padding:80px 20px;color:var(--text-light);
    grid-column:1/-1;
}
.empty-state .empty-icon{font-size:64px;margin-bottom:20px;opacity:.5}
.empty-state h3{font-size:20px;color:var(--text);margin-bottom:8px;font-weight:700}
.empty-state p{font-size:14px;max-width:360px;margin:0 auto 20px}

/* ── RESPONSIVE ── */
@media(max-width:640px){
    .produk-hero{padding:40px 5%}
    .produk-section{padding:24px 5% 60px}
    .produk-grid{grid-template-columns:repeat(2,1fr);gap:14px}
    .search-wrap{flex-direction:column}
    .search-btn{width:100%;justify-content:center}
}
@media(max-width:400px){
    .produk-grid{grid-template-columns:1fr}
}
</style>
@endpush

@section('content')

{{-- ── HERO ── --}}
<section class="produk-hero">
    <h1><i class="fa-solid fa-cookie-bite" style="margin-right:10px"></i>Semua Produk</h1>
    <p>Temukan donat favoritmu dari seluruh varian yang tersedia</p>
</section>

{{-- ── SEARCH ── --}}
<div class="search-section">
    <form action="{{ route('produk') }}" method="GET" id="searchForm" class="search-wrap">
        <div class="search-input-wrap">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="q" id="searchInput"
                   class="search-input"
                   placeholder="Cari nama produk..."
                   value="{{ request('q') }}"
                   autocomplete="off">
            <button type="button" id="clearBtn"
                    class="search-clear {{ request('q') ? 'visible' : '' }}"
                    aria-label="Hapus pencarian">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <button type="submit" class="search-btn">
            <i class="fa-solid fa-magnifying-glass"></i> Cari
        </button>
    </form>
</div>

{{-- ── PRODUK SECTION ── --}}
<section class="produk-section">

    <div class="produk-info-bar">
        <div class="produk-count">
            @if(request('q'))
                Ditemukan <strong>{{ $produks->count() }}</strong> produk
                untuk pencarian &ldquo;<strong>{{ request('q') }}</strong>&rdquo;
                <a href="{{ route('produk') }}" style="margin-left:8px;color:var(--text-light);font-size:12px">
                    <i class="fa-solid fa-xmark"></i> Reset
                </a>
            @else
                Menampilkan <strong>{{ $produks->count() }}</strong> dari
                <strong>{{ $total }}</strong> produk
            @endif
        </div>
        @if(request('q'))
        <span class="search-tag">
            <i class="fa-solid fa-magnifying-glass"></i>
            {{ request('q') }}
            <a href="{{ route('produk') }}" title="Hapus pencarian">&times;</a>
        </span>
        @endif
    </div>

    <div class="produk-grid">
        @forelse($produks as $produk)
        @php $keyword = request('q'); @endphp
        <a href="{{ route('katalog.detail', $produk->id_produk) }}" class="produk-card">

            {{-- Gambar --}}
            @if($produk->gambar)
                <img class="produk-card-img"
                     src="{{ Storage::url($produk->gambar) }}"
                     alt="{{ $produk->nama_produk }}"
                     loading="lazy" width="220" height="200">
            @else
                <div class="produk-card-placeholder">🍩</div>
            @endif

            <div class="produk-card-body">
                {{-- Kategori --}}
                @if($produk->kategori)
                <div class="produk-card-kateg">
                    <i class="fa-solid fa-tag" style="margin-right:3px"></i>
                    {{ $produk->kategori->nama_kategori }}
                </div>
                @endif

                {{-- Nama + highlight --}}
                <div class="produk-card-name">
                    @if($keyword)
                        {!! preg_replace('/('.preg_quote(e($keyword),'/').')/i','<mark>$1</mark>',e($produk->nama_produk)) !!}
                    @else
                        {{ $produk->nama_produk }}
                    @endif
                </div>

                <div class="produk-card-footer">
                    <span class="produk-card-harga">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </span>
                    <span class="produk-card-btn">Detail →</span>
                </div>
            </div>
        </a>
        @empty
        <div class="empty-state">
            <div class="empty-icon">🔍</div>
            <h3>Produk tidak ditemukan</h3>
            <p>Tidak ada produk yang cocok dengan kata kunci &ldquo;{{ request('q') }}&rdquo;.</p>
            <a href="{{ route('produk') }}" class="btn-pink">
                <i class="fa-solid fa-arrow-left"></i> Lihat Semua Produk
            </a>
        </div>
        @endforelse
    </div>

</section>

@push('scripts')
<script>
(function(){
    var input   = document.getElementById('searchInput');
    var clearBtn = document.getElementById('clearBtn');
    var form    = document.getElementById('searchForm');

    if(input && clearBtn){
        input.addEventListener('input', function(){
            clearBtn.classList.toggle('visible', this.value.length > 0);
        });
        clearBtn.addEventListener('click', function(){
            input.value = '';
            clearBtn.classList.remove('visible');
            input.focus();
            // auto-submit untuk reset
            form.submit();
        });
    }
})();
</script>
@endpush
@endsection
