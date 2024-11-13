<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Produk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Menghitung jumlah produk dan petugas
        $jumlahProduk = Produk::count();
        $jumlahPetugas = Petugas::count();

        // Mengirim data ke view
        return view('dashboard', compact('jumlahProduk', 'jumlahPetugas'));
    }
}
