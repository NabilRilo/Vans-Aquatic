<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Menampilkan daftar kategori dan produk di dalamnya.
     * Akan digunakan oleh view KategoriBarang.blade.php.
     */
    public function index()
    {
        // Ambil semua kategori beserta produk terkait dan hitung jumlah produk tiap kategori
        $categories = Category::with('products')->withCount('products')->get();

        // Kirim ke view
        return view('KategoriBarang', compact('categories'));
    }

    /**
     * Menampilkan halaman detail berdasarkan slug kategori (opsional)
     * Tidak dipakai di halaman KategoriBarang.blade.php, hanya jika kamu punya halaman kategori detail.
     */
    public function show($slug)
    {
        // Ambil kategori berdasarkan slug
        $kategori = Category::where('slug', $slug)->firstOrFail();

        // Ambil produk terkait (pakai relasi 'products', bukan 'produks')
        $produks = $kategori->products()->paginate(8);

        return view('kategori.show', compact('kategori', 'produks'));
    }
}
