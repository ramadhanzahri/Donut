<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    protected $table      = 'tbl_kategori';
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori',
        'gambar',
        'status',
        'jumlah_produk',
    ];

    protected $casts = [
        'jumlah_produk' => 'integer',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];

    /**
     * Relasi: satu kategori memiliki banyak produk.
     */
    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class, 'id_kategori', 'id_kategori');
    }

    /**
     * Relasi: hanya produk yang berstatus aktif.
     */
    public function produkAktif(): HasMany
    {
        return $this->hasMany(Produk::class, 'id_kategori', 'id_kategori')
            ->where('status', 'aktif');
    }

    /**
     * Scope: hanya kategori aktif.
     * Penggunaan: Kategori::aktif()->get()
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}