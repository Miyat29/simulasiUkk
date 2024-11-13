@extends('layout.app')

@section('contents')
<div class="container">
    <h1 class="text-center">Daftar Produk</h1>
    <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah produk</a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Kode Produk</th>
                <th class="text-center">Nama</th>
                <th class="text-center">kategori</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Stok</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produk as $index => $p)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ $p->kode_produk }}</td>
                <td class="text-center">{{ $p->nama }}</td>
                <td class="text-center">{{ $p->kategori }}</td>
                <td class="text-center">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                <td class="text-center">{{ $p->stok }}</td>
                <td class="text-center">
                      <!-- Tombol Lihat -->
                      <a href="{{ route('produk.show', $p->id) }}" class="btn btn-info btn-sm"> <i class="fas fa-clipboard"></i>Lihat</a>
                      <a href="{{ route('produk.edit', $p->id) }}" class="btn btn-warning btn-sm">  <i class="bi bi-pencil-square"></i>Edit</a>
                    <form action="{{ route('produk.destroy', $p->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"><i class="fas fa-trash"></i>Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

