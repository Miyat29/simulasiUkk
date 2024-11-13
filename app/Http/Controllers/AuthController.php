<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logout()
{
    Auth::logout(); // Logout pengguna
    session()->invalidate(); // Menghapus semua data sesi
    session()->regenerateToken(); // Menjaga keamanan CSRF
    
    return redirect('/login'); // Arahkan ke halaman login
}
}
