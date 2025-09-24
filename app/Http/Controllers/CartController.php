<?php

namespace App\Http\Controllers;

use App\Models\TambahProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function tambah(Request $request, $id)
    {
        $product = TambahProduk::findOrFail($id);
        $jumlah = (int) $request->input('jumlah', 1);

        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah'] += $jumlah;
        } else {
            $keranjang[$id] = [
                'nama'   => $product->nama,
                'harga'  => $product->harga,
                'gambar' => $product->gambar,
                'jumlah' => $jumlah,
            ];
        }

        session()->put('keranjang', $keranjang);

        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function index()
    {
        $keranjang = session()->get('keranjang', []);
        return view('TambahKeranjang', compact('keranjang'));
    }

    public function hapus($id)
    {
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }

        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    // Tambahkan method update untuk mengubah jumlah item
    public function update(Request $request, $id)
    {
        $keranjang = session()->get('keranjang', []);
        $jumlah = (int) $request->input('jumlah', 1);
        
        if (isset($keranjang[$id]) && $jumlah > 0) {
            $keranjang[$id]['jumlah'] = $jumlah;
            session()->put('keranjang', $keranjang);
        }
        
        return redirect()->route('keranjang.index')->with('success', 'Jumlah produk berhasil diupdate!');
    }
}