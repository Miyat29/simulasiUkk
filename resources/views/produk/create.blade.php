@extends('layout.app')

@section('contents')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <h2 class="text-center">Tambah Produk</h2>

    <form action="{{ route('produk.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nama">Nama Produk</label>
            <input type="text" id="nama" name="nama" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="kategori">Kategori</label>
            <select id="kategori" name="kategori" class="form-control" required>
                <option value="" disabled selected>Pilih Kategori</option>
                <option value="Elektronik">Elektronik</option>
                <option value="Pakaian">Pakaian</option>
                <option value="Pakaian">Minuman</option>
                <option value="Makanan">Makanan</option>
                <option value="Peralatan Rumah">Peralatan Rumah</option>
                <!-- Tambahkan opsi lain sesuai kebutuhan -->
            </select>
        </div>

        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" id="harga" name="harga" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" id="stok" name="stok" class="form-control" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
