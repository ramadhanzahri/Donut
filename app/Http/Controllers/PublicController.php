<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    // Profile statis — tidak butuh model/database
    private function getProfile()
    {
        return (object)[
            'nama_perusahaan' => 'Maw Maw Donut',
            'deskripsi'       => 'Donat lezat dengan berbagai varian rasa kekinian.',
            'telepon'         => '081528844756',
            'wa_number'       => '081528844756',
            'email'           => 'mawmawdonut@gmail.com',
            'alamat'          => 'Cabang Pusat Maw Maw Donut',
            'logo'            => null,   // isi path logo jika ada
            'maps_embed'      => null,   // isi URL embed Google Maps jika ada
        ];
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
        $kategoris = Kategori::withCount([
                'produk' => fn($q) => $q->where('tbl_produk.status', 'aktif')
            ])
            ->orderBy('nama_kategori')
            ->get();

        $query = Produk::with('kategori')->where('status', 'aktif');

        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }
        if ($request->filled('q')) {
            $query->where('nama_produk', 'like', '%' . $request->q . '%');
        }

        switch ($request->sort) {
            case 'nama_asc':       $query->orderBy('nama_produk', 'asc');  break;
            case 'nama_desc':      $query->orderBy('nama_produk', 'desc'); break;
            case 'harga_termahal': $query->orderBy('harga', 'desc');       break;
            case 'harga_termurah': $query->orderBy('harga', 'asc');        break;
            default:               $query->latest();                        break;
        }

        $produks = $query->get();
        $profile = $this->getProfile();
        return view('public.katalog', compact('kategoris', 'produks', 'profile'));
    }

    public function detail(Produk $produk)
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