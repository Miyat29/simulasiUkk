@extends('layout.app')

@section('contents')
<div class="row p-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="text-center">History Order</h5>

                <!-- Tabel History Order -->
                <div class="table-responsive mt-3">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Kasir</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->created_at->format('d M Y') }}</td>
                                    <td class="text-center">{{ $item->kasir_name }}</td>
                                    <td class="text-center">Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('transaksi.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $transaksi->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
