@extends('layout.app')

@section('contents')
<div class="container">
    <h1>Data Petugas</h1>
    <a href="{{ route('petugas.create') }}" class="btn btn-primary mb-3">Tambah Petugas</a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Email</th>
                <th class="text-center">Telepon</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($petugas as $index => $p)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ $p->nama }}</td>
                <td class="text-center">{{ $p->email }}</td>
                <td class="text-center">{{ $p->telepon }}</td>
                <td class="text-center">
                    <a href="{{ route('petugas.edit', $p->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('petugas.destroy', $p->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

