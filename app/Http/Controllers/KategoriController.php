<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::withCount('produk')->latest()->get();
        return view('dashboard.kategori', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'status'        => 'required|in:aktif,nonaktif',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.max'      => 'Nama kategori maksimal 100 karakter.',
            'status.required'        => 'Status wajib dipilih.',
            'gambar.image'           => 'File harus berupa gambar.',
            'gambar.mimes'           => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'gambar.max'             => 'Ukuran gambar maksimal 2MB.',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('kategori', 'public');
        }

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'status'        => $request->status,
            'gambar'        => $gambar,
            'jumlah_produk' => 0,
        ]);

        return redirect()->route('kategori.index')
            ->with('success', "Kategori \"{$request->nama_kategori}\" berhasil ditambahkan.");
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'status'        => 'required|in:aktif,nonaktif',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'status.required'        => 'Status wajib dipilih.',
            'gambar.image'           => 'File harus berupa gambar.',
            'gambar.mimes'           => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'gambar.max'             => 'Ukuran gambar maksimal 2MB.',
        ]);

        $data = [
            'nama_kategori' => $request->nama_kategori,
            'status'        => $request->status,
        ];

        if ($request->hasFile('gambar')) {
            if ($kategori->gambar) {
                Storage::disk('public')->delete($kategori->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('kategori', 'public');
        }

        $kategori->update($data);

        return redirect()->route('kategori.index')
            ->with('success', "Kategori \"{$kategori->nama_kategori}\" berhasil diupdate.");
    }

    public function destroy(Kategori $kategori)
    {
        if ($kategori->gambar) {
            Storage::disk('public')->delete($kategori->gambar);
        }

        $nama = $kategori->nama_kategori;
        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('success', "Kategori \"{$nama}\" berhasil dihapus.");
    }
}