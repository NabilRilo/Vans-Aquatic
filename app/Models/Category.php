<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'is_active',
    ];

    /**
     * Relasi satu ke banyak dengan produk (TambahProduk).
     * Artinya satu kategori bisa memiliki banyak produk.
     */
    public function products(): HasMany
    {
        return $this->hasMany(TambahProduk::class, 'category_id');
    }
}
