@extends('layout.app')

@section('title', 'Dashboard')

@section('contents')
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">
            Dashboard
        </h1>
    </div>
</header>
<hr />
<main>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card: Jumlah Produk -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-500 rounded-full text-white">
                            <i class="fas fa-box fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-600">Jumlah Produk</h3>
                            <p class="text-2xl font-bold text-gray-800">
                                {{ $jumlahProduk ?? 0 }}
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('produk.index') }}" class="btn btn-primary">Lihat</a>
                </div>
            </div>

            <!-- Card: Jumlah Petugas -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-500 rounded-full text-white">
                            <i class="fas fa-user-tie fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-600">Jumlah Petugas</h3>
                            <p class="text-2xl font-bold text-gray-800">
                                {{ $jumlahPetugas ?? 0 }}
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('petugas.index') }}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
