<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilePerusahaan extends Model
{
    protected $table      = 'tbl_profile_perusahaan';
    protected $primaryKey = 'id_profile';

    protected $fillable = [
        'nama_perusahaan',
        'alamat',
        'telepon',
        'email',
        'deskripsi',
        'sejarah',
        'logo',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Accessor: URL lengkap logo perusahaan.
     * Penggunaan: $profile->logo_url
     */
    public function getLogoUrlAttribute(): ?string
    {
        if ($this->logo) {
            return \Illuminate\Support\Facades\Storage::url($this->logo);
        }
        return null;
    }

    /**
     * Accessor: nomor WA format internasional (tanpa awalan 0).
     * Contoh: 081528844756 → 6281528844756
     * Penggunaan: $profile->wa_number
     */
    public function getWaNumberAttribute(): string
    {
        $telepon = $this->telepon ?? '';
        if (str_starts_with($telepon, '0')) {
            return '62' . substr($telepon, 1);
        }
        return $telepon;
    }

    /**
     * Accessor: Maps embed URL (untuk halaman Tentang).
     * Penggunaan: $profile->maps_embed
     */
    public function getMapsEmbedUrlAttribute(): ?string
    {
        // Ambil LANGSUNG dari $attributes — bukan via $this->maps_embed
        $raw = $this->attributes['maps_embed'] ?? null;

        if ($raw) {
            return $raw;
        }

        if ($this->alamat) {
            return 'https://www.google.com/maps?q=' . urlencode($this->alamat) . '&output=embed';
        }

        return null;
    }
}
