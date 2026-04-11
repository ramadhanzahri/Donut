<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\ProfilePerusahaan;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    private function getProfile()
    {
        $profile = ProfilePerusahaan::first();
        // Jika belum ada profile, buat satu dengan data default
        if (!$profile) {
            $profile = ProfilePerusahaan::create([
                'nama_perusahaan' => 'Maw Maw Donut',
                'deskripsi' => 'Donat lezat dengan berbagai varian rasa.',
                'telepon' => '081528844756',
                'email' => 'mawmawdonut@gmail.com',
            ]);
        }
        return $profile;
    }

    public function beranda()
    {
        $produkFavorit = Produk::with('kategori')
            ->where('status', 'aktif')
            ->latest()
            ->take(6)
            ->get();

        $profile = $this->getProfile();

        return view('public.beranda', compact('produkFavorit', 'profile'));
    }

    public function katalog(Request $request)
    {
        $kategoris = Kategori::where('status', 'aktif')
            ->withCount(['produk' => function ($q) {
                $q->where('status', 'aktif');
            }])
            ->orderBy('nama_kategori')
            ->get();

        $query = Produk::with('kategori')->where('status', 'aktif');

        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        $produks = $query->latest()->get();
        $profile = $this->getProfile();

        return view('public.katalog', compact('kategoris', 'produks', 'profile'));
    }

    public function detailProduk(Produk $produk)
    {
        $produk->load('kategori');

        $related = Produk::with('kategori')
            ->where('id_kategori', $produk->id_kategori)
            ->where('id_produk', '!=', $produk->id_produk)
            ->where('status', 'aktif')
            ->take(4)
            ->get();

        $profile = $this->getProfile();

        return view('public.detail-produk', compact('produk', 'related', 'profile'));
    }

    public function tentang()
    {
        $profile = $this->getProfile();
        return view('public.tentang', compact('profile'));
    }
}