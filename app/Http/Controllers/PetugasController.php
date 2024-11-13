<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $petugas = Petugas::all();
        return view('petugas.index', compact('petugas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('petugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {
        Petugas::create($request->all());
        return redirect()->route('petugas.index')->with('success', 'Konsumen berhasil ditambahkan');
        // // Validasi data
        // $request->validate([
        //     'nama' => 'required|string|max:255',
        //     'email' => 'required|email|unique:petugas,email',
        //     'telepon' => 'required|string|max:15',
        //     'password' => 'required|string|min:8',
        // ]);
        
        // Menyimpan data dengan password yang di-hash
        // Petugas::create([
        //     'nama' => $request->nama,
        //     'email' => $request->email,
        //     'telepon' => $request->telepon,
        //     'password' => bcrypt($request->password), // Meng-hash password
        // ]);
    
        // return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $petugas = Petugas::findOrFail($id);
        return view('petugas.edit', compact('petugas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       // Validasi data
    $request->validate([
        'nama' => 'required|string|max:255',
        'telepon' => 'required|string|max:15',
    ]);

        // Mengupdate data
        $petugas = Petugas::findOrFail($id);
        $petugas->update($request->all());
        return redirect()->route('petugas.index')->with('success', 'Data petugas berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Petugas::findOrFail($id)->delete();
        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil dihapus');
    }
}
