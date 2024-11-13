<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\TooManyRedirectsException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi'
        ]);
        
        $infologin = [
            'email'=> $request->email,
            'password'=> $request->password,
        ];
    
        if (Auth::attempt($infologin)) {
            if (Auth::user()->role == 'admin') {
                return redirect('/dashboard'); // Arahkan ke dashboard untuk admin
            } elseif (Auth::user()->role == 'petugas') {
                return redirect('admin/petugas');
            } elseif (Auth::user()->role == 'pimpinan') {
                return redirect('admin/pimpinan');
            } elseif (Auth::user()->role == 'konsumen') {
                return redirect('admin/konsumen');
            }
        } else {
            return redirect('')->withErrors('Email dan Password yang anda masukan salah')->withInput();
        }
    }
    

    public function logout()
    {
        Auth::logout();  // Log out the user
        return redirect('/login');  // Redirect ke halaman login setelah logout
    }
}
