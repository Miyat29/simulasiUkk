@extends('layout.app')

@section('contents')
<div class="container">
    <h1>Edit Petugas</h1>

    <form action="{{ route('petugas.update', $petugas->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $petugas->nama }}" required>
        </div>
        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" value="{{ $petugas->telepon }}" required>
        </div>
        <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
    </form>
</div>
@endsection
