<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::all();
        return view('produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil kode produk terakhir dan buat kode produk baru
        $lastKodeProduk = Produk::latest('kode_produk')->first(); 
        $kode_produk = $lastKodeProduk ? 'PROD-' . (intval(substr($lastKodeProduk->kode_produk, 5)) + 1) : 'P0001';
    
        return view('produk.create', compact('kode_produk'));
    }
    
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);
    
       // Di dalam ProdukController, method create
        $lastProduct = Produk::orderBy('id', 'desc')->first();
        $kode_produk = 'P0' . str_pad(($lastProduct ? $lastProduct->id + 1 : 1), 4, '0', STR_PAD_LEFT);

    
        // Membuat produk baru
        Produk::create([
            'kode_produk' => $kode_produk, // Menggunakan kode produk yang dihitung
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);
    
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produk = produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);
    
        // Cari produk berdasarkan ID
        $produk = Produk::findOrFail($id);
    
        // Update data produk
        $produk->update([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);
    
        // Redirect ke halaman daftar produk
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Temukan produk berdasarkan ID dan hapus
        Produk::findOrFail($id)->delete();
    
        // Redirect kembali ke daftar produk dengan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }
}    
