<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tambahproduk; // Ini adalah model untuk produk Anda
use App\Models\Transaksi;    // Import model Transaksi
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; // Untuk menyimpan bukti pembayaran

class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman metode pembayaran.
     * Ini yang dipanggil oleh route 'metode.pembayaran'.
     */
    public function showPaymentForm(Request $request) // <--- TAMBAHKAN METODE INI
    {
        $keranjang = session()->get('keranjang', []);
        $total_harga = 0;
        foreach ($keranjang as $item) {
            $total_harga += $item['harga'] * $item['jumlah'];
        }
        return view('MetodePembayaran', compact('keranjang', 'total_harga'));
    }


    /**
     * Memproses checkout: Mengurangi stok DAN menyimpan transaksi.
     * Ini yang dipanggil oleh route 'checkout.process'.
     */
    public function process(Request $request)
    {
        // Validasi data yang dikirimkan dari form (dari metodepembayaran.blade.php)
        $validatedData = $request->validate([
            'nama' => 'required|string|max:100', // Nama input form adalah 'nama'
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'metode' => 'required|string|max:50', // Nama input form adalah 'metode'
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:2048', // Validasi file
            'total_harga' => 'required|numeric', // Dari hidden input
        ]);

        // Ambil data dari keranjang belanja
        $keranjangItems = Session::get('keranjang', []);

        if (empty($keranjangItems)) {
            return redirect()->route('home')->with('error', 'Keranjang belanja Anda kosong!');
        }

        // Gunakan transaksi database
        DB::beginTransaction();

        try {
            // Logika upload bukti pembayaran (jika ada)
            $buktiPembayaranPath = null;
            if ($request->hasFile('bukti_pembayaran')) {
                $buktiPembayaranPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            }

            // Loop setiap item di keranjang untuk mengurangi stok
            foreach ($keranjangItems as $productId => $item) {
                $jumlahDibeli = $item['jumlah'];

                $produk = Tambahproduk::where('id', $productId)->lockForUpdate()->first();

                if ($produk && $produk->stok >= $jumlahDibeli) {
                    $produk->stok -= $jumlahDibeli;
                    $produk->save();
                } else {
                    throw new \Exception("Stok untuk produk '{$item['nama']}' tidak mencukupi atau produk tidak ditemukan.");
                }
            }

            // MENYIMPAN TRANSAKSI KE DATABASE
            Transaksi::create([
                'nama_pembeli'      => $validatedData['nama'],
                'alamat'            => $validatedData['alamat'],
                'no_hp'             => $validatedData['no_hp'],
                'metode_pembayaran' => $validatedData['metode'],
                'bukti_pembayaran'  => $buktiPembayaranPath,
                'total_harga'       => $validatedData['total_harga'],
            ]);

            // Jika semua berhasil, simpan perubahan secara permanen
            DB::commit();

            // Kosongkan keranjang belanja
            Session::forget('keranjang');

            // Arahkan ke halaman sukses
            return redirect()->route('pesanan.sukses')->with('success', 'Pesanan Anda berhasil diproses!');

        } catch (\Exception $e) {
            // Jika ada kesalahan, batalkan transaksi dan kembalikan dengan pesan error
            DB::rollBack();
            return redirect()->back()->withInput($request->except('bukti_pembayaran'))->with('error', $e->getMessage());
        }
    }

    /**
     * Menampilkan halaman sukses pembayaran.
     * Ini yang dipanggil oleh route 'pesanan.sukses'.
     */
    public function success() // <--- PASTIKAN METODE INI JUGA ADA
    {
        return view('PesananSukses');
    }
}