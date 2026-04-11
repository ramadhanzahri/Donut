<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_user'     => User::count(),
            'superadmin'     => User::where('role', 'superadmin')->count(),
            'admin'          => User::where('role', 'admin')->count(),
            'total_kategori' => Kategori::count(),
            'total_produk'   => Produk::count(),
            'aktif_produk'   => Produk::where('status', 'aktif')->count(),
        ];

        return view('dashboard.index', compact('stats'));
    }
}