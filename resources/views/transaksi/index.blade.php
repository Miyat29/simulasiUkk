@extends('layout.app')

@section('contents')
<div class="row justify-content-center p-2">
    <div class="col-md-10">
        <div class="card mx-auto">
            <div class="card-body">
                <h5 class="text-center">{{ $title }}</h5>

                <div class="mb-2 text-left">
                    <a href="{{ route('transaksi.create') }}" class="btn btn-warning mb-2"><i class="fas fa-plus"></i> Tambah Transaksi</a>
                </div>

                <div class="table-responsive">
                    <!-- Menampilkan alert jika ada pesan sukses atau error -->
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Tabel data transaksi -->
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Tanggal Transaksi</th>
                                <th class="text-center">Nama Kasir</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->created_at->format('d M Y') }}</td>
                                    <td class="text-center">{{ $item->kasir_name }}</td>
                                    <td class="text-center" style="width: 150px; white-space: nowrap;">
                                        <div class="d-flex justify-content-center">
                                            <!-- Form untuk Hapus -->
                                            <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                                            </form>
                                    
                                            <!-- Tombol Detail -->
                                            <a href="{{ route('transaksi.show', $item->id) }}" class="btn btn-info btn-sm ml-2"><i class="fas fa-eye"></i> Detail</a>
                                        </div>
                                    </td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                <div class="d-flex justify-content-center">
                    {{ $transaksi->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Tambahkan script JavaScript untuk menghilangkan alert otomatis -->
<script>
    // Fungsi untuk menghilangkan alert setelah 3 detik
    setTimeout(function() {
        let alert = document.querySelector('.alert');
        if (alert) {
            alert.style.transition = "opacity 0.5s ease";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000); // Waktu dalam milidetik, di sini 3000 ms = 3 detik
</script>
@endsection
