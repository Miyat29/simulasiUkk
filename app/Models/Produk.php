<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi plural
    protected $table = 'produk';

    // Kolom yang dapat diisi
    protected $fillable = ['kode_produk', 'nama', 'kategori', 'harga', 'stok'];

    // Tentukan primary key jika menggunakan selain id (untuk konvensi standar laravel id akan digunakan)
    protected $primaryKey = 'id';

    
}
