<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Manajemen Transaksi',
            'transaksi' => Transaksi::paginate(10),
            'content' => 'transaksi/index',
        ];
        
        return view('transaksi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'user_id' => auth()->user()->id,
            'kasir_name' => auth()->user()->name,
            'total' => 0,
        ];
    
        // Menggunakan create untuk menyimpan data secara otomatis
        $transaksi = Transaksi::create($data);
    
        return redirect('transaksi/' . $transaksi->id . '/edit');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil transaksi berdasarkan ID
        $transaksi = Transaksi::find($id);
        
        if (!$transaksi) {
            return redirect()->route('transaksi.index')->with('error', 'Transaksi tidak ditemukan.');
        }
    
        // Ambil detail transaksi berdasarkan transaksi ID
        $transaksi_detail = TransaksiDetail::where('transaksi_id', $id)->get();
        $kembalian = max(0, $transaksi->uang_dibayar - $transaksi->total);
    
        // Data yang akan ditampilkan di halaman detail
        $data = [
            'title' => 'Detail Transaksi',
            'transaksi' => $transaksi,
            'transaksi_detail' => $transaksi_detail,
            'kembalian'=>$kembalian
        ];
    
        return view('transaksi.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produk = Produk::get();
    
        $produk_id = request('produk_id');
        $p_detail = Produk::find($produk_id);
    
        $transaksi_detail = TransaksiDetail::whereTransaksiId($id)->get();
    
        $act = request('act');
        $jumlah = request('jumlah', 1); // Tetapkan default 1 jika jumlah tidak ada dalam request
    
        if ($act == 'min') {
            $jumlah = max(1, $jumlah - 1); // Pastikan jumlah minimal 1
        } else {
            $jumlah = $jumlah + 1;
        }
    
        // Pastikan $p_detail tidak null sebelum mengakses $p_detail->harga
        $subtotal = $p_detail ? $jumlah * $p_detail->harga : 0;
    
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return redirect()->back()->withErrors('Transaksi tidak ditemukan.');
        }
    
        $dibayarkan = request('dibayarkan', 0); // Default dibayarkan 0 jika tidak ada dalam request
        $kembalian = $dibayarkan - ($transaksi->total ?? 0); // Gunakan 0 jika total null
    
        $data = [
            'title' => 'Tambah Transaksi',
            'produk' => $produk,
            'p_detail' => $p_detail,
            'jumlah' => $jumlah,
            'transaksi_detail' => $transaksi_detail,
            'transaksi' => $transaksi,
            'kembalian' => $kembalian,
            'subtotal' => $subtotal,
        ];
    
        return view('transaksi.create', $data);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);
    
        if (!$transaksi) {
            return redirect()->route('transaksi.index')->with('error', 'Transaksi tidak ditemukan.');
        }
    
        $transaksi->delete();
    
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    /**
     * Menampilkan History Order (Transaksi yang sudah selesai)
     */
  // Menampilkan History Order
public function history()
{  
    // Mengambil transaksi yang sudah selesai, urutkan berdasarkan tanggal terbaru
    $transaksi = Transaksi::where('status', 'selesai')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    // Pastikan 'transaksi.history' digunakan untuk halaman history
    return view('transaksi.history', compact('transaksi'));
}

}
