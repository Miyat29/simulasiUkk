@extends('layout.app')

@section('contents')
<div class="row p-2">
    <!-- Kolom Form Input -->
    <div class="col-md-6"> <!-- Pastikan menggunakan "col-md-6" untuk setengah halaman -->
        <div class="card">
            <div class="card-body">
                <div class="row mt-1">
                    <div class="col-md-4">
                        <label for="">Kode Produk</label>
                    </div>
                    <div class="col-md-8">
                        <form method="GET">
                            <div class="d-flex">
                                <select name="produk_id" class="form-control" id="">
                                    <option value="">--{{ isset($p_detail) ? $p_detail->nama: 'Nama Produk'  }}--</option>
                                    @foreach ($produk as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>                            
                                <button type="submit" class="btn btn-primary">Pilih</button>
                            </div>
                        </form>                        
                        
                    </div>
                </div>

                <form action="{{ url('/transaksi/detail/create') }}" method="POST">
                    @csrf

                    <input type="hidden" name="transaksi_id" value="{{ Request::segment(2) }}">
                    <input type="hidden" name="produk_id" value="{{ isset($p_detail) ? $p_detail->id :  '' }}">
                    <input type="hidden" name="produk_name" value="{{ isset($p_detail) ? $p_detail->nama :  '' }}">
                    <input type="hidden" name="subtotal" value="{{ $subtotal ?? '' }}">
                    


                        <div class="row mt-1">
                            <div class="col-md-4">
                                <label for="">Nama Produk</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="{{ isset($p_detail) ? $p_detail->nama: ''  }}" class="form-control" disabled name="nama_produk">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-4">
                                <label for="">Harga Satuan</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="{{ isset($p_detail) ? format_rupiah($p_detail->harga) : '' }}" class="form-control" disabled name="harga_satuan">
                            </div>                            
                        </div>
        
                        <div class="row mt-1">
                            <div class="col-md-4">
                                <label for="">Jumlah</label>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex">
                                    <a href="?produk_id={{ request('produk_id') }}&act=min&jumlah={{ $jumlah }}" class="btn btn-primary"><i class="fas fa-minus"></i></a>
                                    <input type="number" value="{{ $jumlah }}" id="jumlah" class="form-control mx-2" name="jumlah">
                                    <a href="?produk_id={{ request('produk_id') }}&act=plus&jumlah={{ $jumlah }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>                            
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <h5><button class="btn btn-warning">Subtotal : Rp.{{ format_rupiah($subtotal) }}</button></h5>
                            </div>
                        </div>
                        
                        <div class="row mt-1">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <a href="{{ route('transaksi.index') }}" class="btn btn-info"><i class="fas fa-arrow-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-warning">Simpan <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
                

    <!-- Kolom Daftar Transaksi -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>

                        @foreach ($transaksi_detail as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->produk_name }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ 'Rp. '. format_rupiah($item->subtotal) }}</td>
                                <td>
                                    <a href="/transaksi/detail/delete?id={{ $item->id }}"><i class="fas fa-times"></i>
                                </td>
                            </tr>
                            @endforeach
                    </thead>
            
                </table>

                <form action="{{ route('transaksi.selesai', $transaksi->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i>Selesai</button>
                    <a href="" class="btn btn-info"><i class="fas fa-file"> Pending</i></a>
                </div>
            </form>                
        </div>
    </div>
</div>

<div class="row p-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="" method="GET">

                    <div class="form-group">
                        <label for="">Total Belanja</label>
                        <input type="text" value="Rp.{{ format_rupiah($transaksi->total) }}" name="total_belanja" class="form-control" id="">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="">Dibayarkan</label>
                        <input type="text" name="dibayarkan" value="Rp.{{ format_rupiah(request('dibayarkan', 0)) }}" class="form-control" id="dibayarkan" oninput="formatRupiah(this)">
                    </div>                                  
                    <br>
                    <button type="submit" class="btn btn-primary btn-block w-100">Hitung</button>
                </form>
                    
                    <hr>
                    <div class="form-group">
                        <label for="">Kembalian</label>
                        <input type="text"  value="{{ format_rupiah($kembalian) }}" name="kembalian" class="form-control" id="">
                    </div>
                </div>
                
            </div>
        </div>

</div>
@endsection
