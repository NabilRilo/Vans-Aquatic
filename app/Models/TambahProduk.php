<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tambahproduk extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'tambahproduks'; 

    // Kolom yang bisa diisi - TAMBAHKAN gallery_images
    protected $fillable = [
        'category_id',
        'nama',
        'slug',
        'deskripsi',
        'harga',
        'stok',
        'gambar',
        'gallery_images', // ✅ TAMBAHKAN INI
    ];

    // Casting tipe data - TAMBAHKAN gallery_images
    protected $casts = [
        'harga' => 'integer',
        'stok' => 'integer',
        'gallery_images' => 'array', // ✅ TAMBAHKAN INI (Auto convert JSON to array)
    ];

    /**
     * Relasi ke Category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Accessor untuk gallery images count
     */
    public function getGalleryImagesCountAttribute(): int
    {
        return $this->gallery_images ? count($this->gallery_images) : 0;
    }

    /**
     * Accessor untuk semua images (gambar utama + gallery)
     */
    public function getAllImagesAttribute(): array
    {
        $images = [];
        
        if ($this->gambar) {
            $images[] = $this->gambar;
        }
        
        if ($this->gallery_images && is_array($this->gallery_images)) {
            $images = array_merge($images, $this->gallery_images);
        }
        
        return array_filter($images); // Remove empty values
    }

    /**
     * Generate slug otomatis saat create/update
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Tambahproduk $tambahproduk) {
            if (empty($tambahproduk->slug) && !empty($tambahproduk->nama)) {
                $tambahproduk->slug = Str::slug($tambahproduk->nama);
                
                // Cek jika slug sudah ada, tambahkan angka unik
                $originalSlug = $tambahproduk->slug;
                $count = 1;
                while (static::where('slug', $tambahproduk->slug)->exists()) {
                    $tambahproduk->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });

        static::updating(function (Tambahproduk $tambahproduk) {
            if ($tambahproduk->isDirty('nama') && !empty($tambahproduk->nama)) {
                $tambahproduk->slug = Str::slug($tambahproduk->nama);
                
                // Cek jika slug sudah ada (kecuali untuk record ini)
                $originalSlug = $tambahproduk->slug;
                $count = 1;
                while (static::where('slug', $tambahproduk->slug)
                          ->where('id', '!=', $tambahproduk->id)
                          ->exists()) {
                    $tambahproduk->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });
    }
}