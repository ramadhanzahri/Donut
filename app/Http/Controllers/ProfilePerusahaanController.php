<?php

namespace App\Http\Controllers;

use App\Models\ProfilePerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilePerusahaanController extends Controller
{
    /**
     * Ambil profil perusahaan (selalu satu record).
     * Jika belum ada, buat default otomatis.
     */
    private function getProfile(): ProfilePerusahaan
    {
        return ProfilePerusahaan::first() ?? ProfilePerusahaan::create([
            'nama_perusahaan' => 'Maw Maw Donut',
            'deskripsi'       => 'Donat lezat dengan berbagai varian rasa.',
            'telepon'         => '081528844756',
            'email'           => 'mawmawdonut@gmail.com',
            'alamat'          => '',
            'sejarah'         => '',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD — Kelola Profil Perusahaan
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $profile = $this->getProfile();
        return view('dashboard.profile-perusahaan', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = $this->getProfile();

        $request->validate([
            'nama_perusahaan' => 'required|string|max:150',
            'deskripsi'       => 'nullable|string|max:500',
            'sejarah'         => 'nullable|string|max:5000',
            'telepon'         => 'nullable|string|max:20',
            'email'           => 'nullable|email|max:100',
            'alamat'          => 'nullable|string|max:500',
            'logo'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama_perusahaan.required' => 'Nama perusahaan wajib diisi.',
            'nama_perusahaan.max'      => 'Nama perusahaan maksimal 150 karakter.',
            'deskripsi.max'            => 'Deskripsi maksimal 500 karakter.',
            'sejarah.max'              => 'Sejarah maksimal 5000 karakter.',
            'email.email'              => 'Format email tidak valid.',
            'logo.image'               => 'File harus berupa gambar.',
            'logo.mimes'               => 'Format logo harus jpg, jpeg, png, atau webp.',
            'logo.max'                 => 'Ukuran logo maksimal 2MB.',
        ]);

        // Ambil semua field yang sesuai fillable (kecuali logo — dihandle terpisah)
        $data = $request->only([
            'nama_perusahaan',
            'deskripsi',
            'sejarah',
            'telepon',
            'email',
            'alamat',
        ]);

        // Hapus logo lama jika checkbox hapus_logo dicentang
        if ($request->boolean('hapus_logo') && $profile->logo) {
            Storage::disk('public')->delete($profile->logo);
            $data['logo'] = null;
        }

        // Upload logo baru (timpa jika ada logo lama)
        if ($request->hasFile('logo')) {
            if ($profile->logo) {
                Storage::disk('public')->delete($profile->logo);
            }
            $data['logo'] = $request->file('logo')->store('profile', 'public');
        }

        $profile->update($data);

        return redirect()->route('profile-perusahaan.index')
            ->with('success', 'Profil perusahaan berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | PUBLIC — Halaman Profil Perusahaan
    |--------------------------------------------------------------------------
    */

    public function profilPublik()
    {
        $profile = $this->getProfile();
        return view('public.profil', compact('profile'));
    }
}
