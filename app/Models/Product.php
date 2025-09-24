<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Pastikan ini ada jika Anda menggunakan Str::limit di view

class Product extends Model
{
    use HasFactory;

    // Penting: Beri tahu Laravel bahwa model ini menggunakan tabel 'TambahProduks'
    protected $table = 'TambahProduks';

    // Kolom yang dapat diisi secara massal (sesuaikan dengan kolom di tabel TambahProduks Anda)
    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'stok',
        'gambar',
        // 'category_id', // Ini telah dihapus
    ];

    /**
     * Relasi: Relasi kategori telah dihapus
     */
    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }
}
