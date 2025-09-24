<?php

namespace App\Http\Controllers;

use App\Models\TambahProduk; // Model produk
use Illuminate\Http\Request;

class FishController extends Controller
{
    /**
     * Menampilkan daftar ikan dengan filter pencarian.
     */
    public function fishView(Request $request)
    {
        $search = $request->input('search');

        $productsQuery = TambahProduk::query();

        if ($search) {
            $productsQuery->where('nama', 'like', '%' . $search . '%')
                          ->orWhere('deskripsi', 'like', '%' . $search . '%');
        }

        $products = $productsQuery->orderBy('nama')->get();

        return view('fishView', compact('products'));
    }

    /**
     * Menampilkan detail produk berdasarkan slug.
     */
    public function fishDetail($slug)
    {
        $product = TambahProduk::where('slug', $slug)->firstOrFail();
        return view('FishDetail', compact('product'));
    }
}
