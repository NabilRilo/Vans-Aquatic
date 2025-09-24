<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FishController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\CartController; 



// 1. Halaman beranda (home)
Route::get('/', function () {
    return view('HomePage');
})->name('home');

Route::get('/home', function () {
    return view('HomePage');
});

// 2. Daftar ikan (produk)
Route::get('/fishView', [FishController::class, 'fishView'])->name('fish.view');

// 3. Halaman detail produk
Route::get('/fishDetail/{id}', [FishController::class, 'fishDetail'])->name('fish.detail');
Route::get('/fish/{slug}', [FishController::class, 'fishDetail'])->name('fish.show');

// 4. Route keranjang - MENGGUNAKAN CONTROLLER
Route::get('/keranjang/tambah/{id}', [CartController::class, 'tambah'])->name('keranjang.tambah');
Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang.index');
Route::delete('/keranjang/hapus/{id}', [CartController::class, 'hapus'])->name('keranjang.hapus');
Route::patch('/keranjang/update/{id}', [CartController::class, 'update'])->name('keranjang.update');

// 5. Halaman metode pembayaran
Route::get('/metodepembayaran', [CheckoutController::class, 'showPaymentForm'])->name('metode.pembayaran');

// 6. Proses checkout & simpan transaksi
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

// 7. Halaman konfirmasi sukses pembayaran
Route::get('/pesanan/sukses', [CheckoutController::class, 'success'])->name('pesanan.sukses');

// 8. Halaman Hubungi Kami
Route::get('/hubungi-kami', function () {
    return view('hubungi-kami');
})->name('hubungi-kami');

// 9. Halaman Kategori
Route::get('/kategori-barang', [KategoriController::class, 'index'])->name('kategori.barang');
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');