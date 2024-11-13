@extends('layout.app')

@section('contents')
<div class="row justify-content-center p-2">
    <div class="col-md-10">
        <div class="card mx-auto">
            <div class="card-body">
                <h5 class="text-center">{{ $title }}</h5>

                <div class="mb-2 text-left">
                    <a href="{{ route('transaksi.index') }}" class="btn btn-info mb-2"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>

                <!-- Tabel detail transaksi -->
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Produk</th>
                                <th class="text-center">Jumlah Produk</th>
                                <th class="text-center">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi_detail as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->produk_name }}</td>
                                    <td class="text-center">{{ $item->jumlah }}</td>
                                    <td class="text-center">Rp. {{ format_rupiah($item->subtotal) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
