<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // FIX: Tambahkan ini untuk memastikan fungsi auth() bekerja
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FishController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\CartController; 
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =======================================================
// 1. ROUTE AUTENTIKASI (LOGIN & REGISTER) - Akses Publik
// =======================================================

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// =======================================================
// 2. HALAMAN UTAMA (ROOT /) - GERBANG LOGIN
// =======================================================

Route::get('/', function () {
    // Mengecek status otentikasi
    if (Auth::check()) { // Menggunakan Auth::check() lebih eksplisit daripada helper auth()
        return view('HomePage');
    }
    return redirect()->route('login'); 
})->name('home');

Route::get('/home', function () {
    // Melindungi route /home
    if (Auth::check()) {
        return view('HomePage');
    }
    return redirect()->route('login');
});


// =======================================================
// 3. ROUTE YANG DILINDUNGI (PERLU LOGIN - menggunakan middleware 'auth')
// =======================================================

Route::middleware(['auth'])->group(function () {
    
    // 2. Daftar ikan (produk)
    Route::get('/fishView', [FishController::class, 'fishView'])->name('fish.view');

    // 3. Halaman detail produk
    Route::get('/fishDetail/{id}', [FishController::class, 'fishDetail'])->name('fish.detail');
    Route::get('/fish/{slug}', [FishController::class, 'fishDetail'])->name('fish.show');

    // 4. Route keranjang
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
        return view('Hubungi-Kami'); 
    })->name('hubungi-kami');

    // 9. Halaman Kategori
    Route::get('/kategori-barang', [KategoriController::class, 'index'])->name('kategori.barang');
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
});