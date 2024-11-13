<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class TransaksiDetailController extends Controller
{
    public function create(Request $request)
    {
        // dd($request->all()); // Debugging untuk memeriksa data yang dikirim
        
        $produk_id = $request->produk_id;
        $transaksi_id =  $request->transaksi_id;

        $td = TransaksiDetail::whereProdukId($produk_id)->whereTransaksiId($transaksi_id)->first();

        $transaksi = Transaksi::find($transaksi_id);

        if($td == null) {

            $data = [
                'produk_id' => $produk_id,
                'produk_name' => $request->produk_name,
                'transaksi_id' => $transaksi_id,
                'jumlah' => $request->jumlah,
                'subtotal' => $request->subtotal,
            ];
        
            TransaksiDetail::create($data);

            $dt= [
              'total'=>$request->subtotal + $transaksi->total      
            ];
            $transaksi->update($dt);
        } else{
            $data = [
                'jumlah' =>$td->jumlah *$request->jumlah,
                'subtotal'=> $request->subtotal *$td->subtotal,
            ];
            $td->update($data);

            $dt= [
                'total'=>$request->subtotal + $transaksi->total      
              ];
              $transaksi->update($dt);
        }
        return redirect('/transaksi/' . $transaksi_id . '/edit');

    }

    function delete()
    {
        $id = request('id');
        $td = TransaksiDetail::find($id);

        $transaksi = Transaksi::find($td->transaksi_id);
        $data = [
            'total' => $transaksi->total - $td->subtotal,
        ];
        $transaksi->update($data);

        $td ->delete();


        return redirect()->back();
    }

   

    public function selesai($id)
    {
        $transaksi = Transaksi::find($id);
    
        if (!$transaksi) {
        
            return redirect('/transaksi')->withErrors('Transaksi dengan ID ini tidak ditemukan.');
        }
    
        $transaksi->update(['status' => 'selesai']);
     
    
        return redirect('/transaksi');
    }
    
    
    
}
