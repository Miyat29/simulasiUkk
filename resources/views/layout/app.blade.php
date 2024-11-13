<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">



</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-blue-600 text-white">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Main Wrapper with Sidebar and Content -->
    <div class="flex h-screen" x-data="{ open: true }">

        <!-- Sidebar -->
        <div :class="open ? 'w-64' : 'w-20'" class="h-full bg-gradient-to-b from-blue-900 to-blue-600 text-white flex flex-col transition-all duration-300 ease-in-out">
            <div class="flex justify-between items-center p-4">
                <!-- Hamburger Menu for Sidebar Toggle -->
                <button @click="open = !open" class="text-white focus:outline-none">
                    <i :class="open ? 'bi bi-x' : 'bi bi-list'" class="text-2xl"></i>
                </button>
                <!-- Sidebar Title when Open -->
                <div :class="open ? 'block' : 'hidden'">
                    <h1 class="text-xl font-bold">Admin Dashboard</h1>
                    <p class="mt-2 text-sm">Welcome back!</p>
                </div>
            </div>

            <!-- Sidebar Menu Links -->
            <div class="mt-6 flex flex-col space-y-2 px-4">
                <!-- Data Produk Menu -->
                <a href="{{ route('dashboard') }}" class="flex items-center py-3 text-white hover:bg-blue-700 transition rounded-md">
                    <i class="bi bi-house-door-fill mr-3 text-xl"></i> <span :class="open ? 'block' : 'hidden'">Dahboard</span>
                </a>
                <a href="{{ route('produk.index') }}" class="flex items-center py-3 text-white hover:bg-blue-700 transition rounded-md">
                    <i class="bi bi-box-fill mr-3 text-xl"></i> <span :class="open ? 'block' : 'hidden'">Data Produk</span>
                </a>
                <!-- Data Petugas Menu -->
                <a href="{{ route('petugas.index') }}" class="flex items-center py-3 text-white hover:bg-blue-700 transition rounded-md">
                    <i class="bi bi-person-fill mr-3 text-xl"></i> <span :class="open ? 'block' : 'hidden'">Data Petugas</span>
                </a>
                <!-- Jenis Pembayaran Menu -->
                <a href="{{ route('pembayaran.index') }}" class="flex items-center py-3 text-white hover:bg-blue-700 transition rounded-md">
                    <i class="bi bi-credit-card-fill mr-3 text-xl"></i> <span :class="open ? 'block' : 'hidden'">Jenis Pembayaran</span>
                </a>
                <!-- Transaksi Order Menu -->
                <a href="{{ route('transaksi.index') }}" class="flex items-center py-3 text-white hover:bg-blue-700 transition rounded-md">
                    <i class="bi bi-cart-fill mr-3 text-xl"></i> <span :class="open ? 'block' : 'hidden'">Transaksi Order</span>
                </a>
                 <!-- Generate Laporan Menu-->
                 <a href="" class="flex items-center py-3 text-white hover:bg-blue-700 transition rounded-md">
                    <i class="fas fa-clipboard mr-3 text-xl"></i> <span :class="open ? 'block' : 'hidden'">Generate Laporan</span>
                </a>
                  <!-- History order menu-->
                  <a href="{{ route('history.index') }}" class="flex items-center py-3 text-white hover:bg-blue-700 transition rounded-md">
                    <i class="fas fa-reply mr-3 text-xl"></i> <span :class="open ? 'block' : 'hidden'">History Order</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                
                <a href="#" onclick="document.getElementById('logout-form').submit();" class="flex items-center py-3 text-white hover:bg-blue-700 transition rounded-md">
                    <i class="bi bi-box-arrow-in-right mr-3 text-xl"></i> 
                    <span :class="open ? 'block' : 'hidden'">Logout</span>
                </a>
                
            </div>

            <!-- Sidebar Footer -->
            <div class="mt-auto px-4 py-6">
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 bg-white p-6">
            @yield('contents')
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>