<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk     = Produk::count();
        $totalProdukAktif= Produk::where('status', 'aktif')->count();
        $totalKategori   = Kategori::count();
        $totalAdmin      = User::count();

        $produkTerbaru   = Produk::with('kategori')
                            ->latest()
                            ->take(5)
                            ->get();

        $kategoris       = Kategori::withCount('produk')
                            ->orderBy('nama_kategori')
                            ->get();

        return view('dashboard.index', compact(
            'totalProduk',
            'totalProdukAktif',
            'totalKategori',
            'totalAdmin',
            'produkTerbaru',
            'kategoris'
        ));
    }
}
