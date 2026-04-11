<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    protected $table      = 'tbl_produk';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'nama_produk',
        'id_kategori',
        'harga',
        'deskripsi',
        'gambar',
        'status',
    ];

    protected $casts = [
        'harga'      => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi: produk milik satu kategori.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    /**
     * Scope: hanya produk aktif.
     * Penggunaan: Produk::aktif()->get()
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Accessor: format harga ke Rupiah.
     * Penggunaan: $produk->harga_rupiah
     */
    public function getHargaRupiahAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    /**
     * Accessor: URL lengkap gambar produk.
     * Penggunaan: $produk->gambar_url
     */
    public function getGambarUrlAttribute(): ?string
    {
        if ($this->gambar) {
            return \Illuminate\Support\Facades\Storage::url($this->gambar);
        }
        return null;
    }
}