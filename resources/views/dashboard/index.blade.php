@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(min(220px, 100%), 1fr));
        gap: 20px;
        margin-bottom: 28px
    }

    .stat-card {
        background: var(--surface-2);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 22px 20px;
        box-shadow: var(--shadow);
        display: flex;
        align-items: center;
        gap: 18px;
        transition: transform var(--t), box-shadow var(--t);
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md)
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .stat-icon.pink {
        background: var(--pink-pale);
        color: var(--pink)
    }

    .stat-icon.green {
        background: #edfdf5;
        color: #1a7a4a
    }

    .stat-icon.blue {
        background: #eef4ff;
        color: #4285F4
    }

    .stat-icon.orange {
        background: #fff8ed;
        color: #e67e22
    }

    .stat-body {}

    .stat-label {
        font-size: 12px;
        font-weight: 600;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: .06em;
        margin-bottom: 4px
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text);
        line-height: 1
    }

    .stat-sub {
        font-size: 12px;
        color: var(--text-light);
        margin-top: 4px
    }

    .grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px
    }

    .welcome-card {
        background: linear-gradient(135deg, var(--pink) 0%, var(--pink-dark) 100%);
        border-radius: var(--radius-lg);
        padding: 28px 28px;
        color: #fff;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
    }

    .welcome-card::after {
        content: '🍩';
        position: absolute;
        right: 24px;
        bottom: -8px;
        font-size: 80px;
        opacity: .2;
        line-height: 1;
    }

    .welcome-card h2 {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        margin-bottom: 6px
    }

    .welcome-card p {
        font-size: 14px;
        opacity: .85;
        max-width: 400px
    }

    .welcome-card .wc-meta {
        margin-top: 16px;
        font-size: 12px;
        opacity: .7
    }

    .quick-links {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 20px
    }

    .quick-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(255, 255, 255, .15);
        color: #fff;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        border: 1px solid rgba(255, 255, 255, .2);
        transition: background var(--t);
    }

    .quick-link:hover {
        background: rgba(255, 255, 255, .25)
    }

    @media(max-width:700px) {
        .grid-2 {
            grid-template-columns: 1fr
        }
    }
</style>
@endpush

@section('content')

{{-- Welcome Banner --}}
<div class="welcome-card">
    <h2>Halo, {{ Auth::user()->name }}! 👋</h2>
    <p>Selamat datang di panel admin Maw Maw Donut. Kelola produk dan kategori dari sini.</p>
    <div class="wc-meta">
        <i class="fa-solid fa-clock"></i>
        Login sebagai <strong>{{ Auth::user()->role }}</strong>
        &nbsp;·&nbsp;
        {{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
    </div>
    <div class="quick-links">
        <a href="{{ route('produk.index') }}" class="quick-link">
            <i class="fa-solid fa-box-open"></i> Kelola Produk
        </a>
        <a href="{{ route('kategori.index') }}" class="quick-link">
            <i class="fa-solid fa-tags"></i> Kelola Kategori
        </a>
        <a href="{{ route('beranda') }}" target="_blank" class="quick-link">
            <i class="fa-solid fa-globe"></i> Lihat Website
        </a>
    </div>
</div>

{{-- Stats Cards --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon pink"><i class="fa-solid fa-box-open"></i></div>
        <div class="stat-body">
            <div class="stat-label">Total Produk</div>
            <div class="stat-value">{{ $totalProduk }}</div>
            <div class="stat-sub">Semua produk terdaftar</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fa-solid fa-circle-check"></i></div>
        <div class="stat-body">
            <div class="stat-label">Produk Aktif</div>
            <div class="stat-value">{{ $totalProdukAktif }}</div>
            <div class="stat-sub">Tampil di website</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fa-solid fa-tags"></i></div>
        <div class="stat-body">
            <div class="stat-label">Kategori</div>
            <div class="stat-value">{{ $totalKategori }}</div>
            <div class="stat-sub">Kategori tersedia</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange"><i class="fa-solid fa-users-gear"></i></div>
        <div class="stat-body">
            <div class="stat-label">Total Admin</div>
            <div class="stat-value">{{ $totalAdmin }}</div>
            <div class="stat-sub">Pengguna terdaftar</div>
        </div>
    </div>
</div>

{{-- Recent Tables --}}
<div class="grid-2">
    {{-- Produk Terbaru --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Produk Terbaru</span>
            <a href="{{ route('produk.index') }}" class="btn btn-sm btn-outline-pink">Lihat Semua</a>
        </div>
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produkTerbaru as $p)
                    <tr>
                        <td style="color:var(--text);font-weight:600">{{ $p->nama_produk }}</td>
                        <td>{{ $p->harga_rupiah }}</td>
                        <td>
                            <span class="badge {{ $p->status === 'aktif' ? 'badge-success' : 'badge-danger' }}">
                                {{ $p->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">
                            <div class="empty-state" style="padding:20px">
                                <p>Belum ada produk</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Kategori --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Daftar Kategori</span>
            <a href="{{ route('kategori.index') }}" class="btn btn-sm btn-outline-pink">Kelola</a>
        </div>
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
                        <th style="text-align:right">Jml Produk</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $kat)
                    <tr>
                        <td style="color:var(--text);font-weight:600">{{ $kat->nama_kategori }}</td>
                        <td style="text-align:right">
                            <span class="badge badge-info">{{ $kat->produk_count }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2">
                            <div class="empty-state" style="padding:20px">
                                <p>Belum ada kategori</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection