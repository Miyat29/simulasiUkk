<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function index()
{
    $pembayaran = Pembayaran::paginate(10); // Ambil semua data dari tabel 'pembayaran'
    return view('pembayaran.index', compact('pembayaran')); // Kirimkan ke view
}

    public function create()
    {
        return view('pembayaran.create');
    }

    public function store(Request $request)
{
    // Ambil nomor referensi terakhir
    $lastReference = DB::table('pembayaran')->orderBy('id', 'desc')->value('nomor_referensi');

    // Tentukan nomor referensi baru
    if ($lastReference) {
        $number = (int) substr($lastReference, 1); // Ambil angka setelah 'X'
        $newNumber = $number + 1;
    } else {
        $newNumber = 1; // Nomor awal jika belum ada data
    }

    $nomorReferensi = 'X' . str_pad($newNumber, 4, '0', STR_PAD_LEFT); // Format 'X0001', 'X0002', dst.

    // Tentukan detail berdasarkan metode pembayaran
    $detail = null;
    if ($request->input('metode') == 'ewallet') {
        $detail = $request->input('detail_ewallet');  // Untuk ewallet, ambil detail dari input ewallet
    } elseif ($request->input('metode') == 'transfer_bank') {
        $detail = $request->input('detail_bank');  // Untuk transfer bank, ambil detail dari input bank
    } else {
        $detail = $request->input('detail'); // Untuk cash atau qris, gunakan detail biasa
    }

    // Debug untuk memastikan detail diterima


    // Simpan data ke database
    Pembayaran::create([
        'metode' => $request->input('metode'),
        'detail' => $detail,
        'nomor_referensi' => $nomorReferensi,
    ]);

    return redirect()->route('pembayaran.index')->with('success', 'Data berhasil ditambahkan.');
}


}
