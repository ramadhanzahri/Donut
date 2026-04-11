<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks   = Produk::with('kategori')->latest()->get();
        $kategoris = Kategori::where('status', 'aktif')->orderBy('nama_kategori')->get();
        return view('dashboard.produk', compact('produks', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:150',
            'id_kategori' => 'required|exists:tbl_kategori,id_kategori',
            'harga'       => 'required|numeric|min:0',
            'status'      => 'required|in:aktif,nonaktif',
            'deskripsi'   => 'nullable|string|max:1000',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'id_kategori.required' => 'Kategori wajib dipilih.',
            'id_kategori.exists'   => 'Kategori yang dipilih tidak valid.',
            'harga.required'       => 'Harga wajib diisi.',
            'harga.numeric'        => 'Harga harus berupa angka.',
            'harga.min'            => 'Harga tidak boleh negatif.',
            'status.required'      => 'Status wajib dipilih.',
            'deskripsi.max'        => 'Deskripsi maksimal 1000 karakter.',
            'gambar.image'         => 'File harus berupa gambar.',
            'gambar.mimes'         => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'gambar.max'           => 'Ukuran gambar maksimal 2MB.',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('produk', 'public');
        }

        $produk = Produk::create([
            'nama_produk' => $request->nama_produk,
            'id_kategori' => $request->id_kategori,
            'harga'       => $request->harga,
            'status'      => $request->status,
            'deskripsi'   => $request->deskripsi,
            'gambar'      => $gambar,
        ]);

        $this->syncJumlahProduk($request->id_kategori);

        return redirect()->route('produk.index')
            ->with('success', "Produk \"{$produk->nama_produk}\" berhasil ditambahkan.");
    }

    public function show(Produk $produk)
    {
        $produk->load('kategori');
        return view('dashboard.produk-detail', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:150',
            'id_kategori' => 'required|exists:tbl_kategori,id_kategori',
            'harga'       => 'required|numeric|min:0',
            'status'      => 'required|in:aktif,nonaktif',
            'deskripsi'   => 'nullable|string|max:1000',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'id_kategori.required' => 'Kategori wajib dipilih.',
            'id_kategori.exists'   => 'Kategori tidak valid.',
            'harga.required'       => 'Harga wajib diisi.',
            'harga.numeric'        => 'Harga harus berupa angka.',
            'status.required'      => 'Status wajib dipilih.',
            'gambar.image'         => 'File harus berupa gambar.',
            'gambar.mimes'         => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'gambar.max'           => 'Ukuran gambar maksimal 2MB.',
        ]);

        $oldKategoriId = $produk->id_kategori;

        $data = [
            'nama_produk' => $request->nama_produk,
            'id_kategori' => $request->id_kategori,
            'harga'       => $request->harga,
            'status'      => $request->status,
            'deskripsi'   => $request->deskripsi,
        ];

        if ($request->hasFile('gambar')) {
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update($data);

        // Sync kategori lama
        $this->syncJumlahProduk($oldKategoriId);

        // Sync kategori baru jika beda
        if ($oldKategoriId != $request->id_kategori) {
            $this->syncJumlahProduk($request->id_kategori);
        }

        return redirect()->route('produk.index')
            ->with('success', "Produk \"{$produk->nama_produk}\" berhasil diupdate.");
    }

    public function destroy(Produk $produk)
    {
        $idKategori = $produk->id_kategori;

        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $nama = $produk->nama_produk;
        $produk->delete();

        $this->syncJumlahProduk($idKategori);

        return redirect()->route('produk.index')
            ->with('success', "Produk \"{$nama}\" berhasil dihapus.");
    }

    /**
     * Sinkronisasi kolom jumlah_produk pada tbl_kategori.
     */
    private function syncJumlahProduk(int|string $idKategori): void
    {
        $kategori = Kategori::find($idKategori);
        if ($kategori) {
            $kategori->update([
                'jumlah_produk' => $kategori->produk()->count(),
            ]);
        }
    }
}