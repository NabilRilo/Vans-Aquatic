@extends('layouts.app')

@section('title', 'Home - Vans Aquatic')

@section('content')

<section class="hero-section position-relative overflow-hidden" style="height: 85vh; min-height: 650px;">
    
    {{-- ======================================================= --}}
    {{-- BAGIAN BARU: LOGOUT BUTTON (Hanya tampil jika @auth) --}}
    {{-- ======================================================= --}}
    @auth
    <div class="position-absolute top-0 end-0 m-4 z-index-10">
        
        {{-- Tombol Utama untuk aksi belanja, dll. --}}
        <a href="{{ url('/fishView') }}" class="btn btn-warning me-2 px-4 rounded-pill shadow-sm">
            <i class="mdi mdi-shopping me-1"></i> Mulai Belanja
        </a>
        
        {{-- 1. Form tersembunyi untuk proses Logout (POST) --}}
        <form id="logout-form-home" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        
        {{-- 2. Tombol yang memicu pengiriman form logout --}}
        <a class="btn btn-danger text-white px-4 rounded-pill shadow-sm" href="#" 
           onclick="event.preventDefault(); document.getElementById('logout-form-home').submit();">
           <i class="mdi mdi-logout me-1"></i> Logout
        </a>
    </div>
    @endauth
    {{-- ======================================================= --}}
    
    <div id="heroCarousel" class="carousel slide h-100" data-bs-ride="carousel" data-bs-interval="6000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner h-100">
            {{-- Slide 1 --}}
            <div class="carousel-item active" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color: white; height: 100%;">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100 text-center">
                    <h1 class="display-1 fw-bolder animate__animated animate__fadeInUp">Vans Aquatic: Keindahan Akuatik di Ujung Jari Anda</h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s">Temukan ikan hias berkualitas tinggi untuk akuarium impian Anda.</p>
                    <div class="button-group d-flex flex-column flex-sm-row justify-content-center align-items-center">
                        <a href="{{ url('/fishView') }}" class="btn btn-warning btn-lg px-5 rounded-pill animate__animated animate__zoomIn animate__delay-2s m-2">
                            <i class="mdi mdi-shopping me-2"></i> Jelajahi Produk
                        </a>
                        <a href="{{ url('/fishView') }}" class="btn btn-outline-light btn-lg px-5 rounded-pill animate__animated animate__zoomIn animate__delay-2s m-2">
                            <i class="mdi mdi-fish me-2"></i> Lihat Semua Koleksi
                        </a>
                    </div>
                </div>
            </div>

            {{-- Slide 2 --}}
            <div class="carousel-item" style="background: linear-gradient(to right top, #2a5298, #1e3c72); color: white; height: 100%;">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100 text-center">
                    <h1 class="display-1 fw-bolder animate__animated animate__fadeInUp">Pengiriman Aman, Kualitas Terjamin</h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s">Ikan sehat sampai di tangan Anda dengan layanan terbaik kami.</p>
                    <div class="button-group d-flex flex-column flex-sm-row justify-content-center align-items-center">
                        <a href="{{ url('/fishView') }}" class="btn btn-warning btn-lg px-5 rounded-pill animate__animated animate__zoomIn animate__delay-2s m-2">
                            <i class="mdi mdi-truck-fast me-2"></i> Pelajari Pengiriman
                        </a>
                        <a href="{{ url('/fishView') }}" class="btn btn-outline-light btn-lg px-5 rounded-pill animate__animated animate__zoomIn animate__delay-2s m-2">
                            <i class="mdi mdi-fish me-2"></i> Lihat Semua Koleksi
                        </a>
                    </div>
                </div>
            </div>

            {{-- Slide 3 --}}
            <div class="carousel-item" style="background: linear-gradient(to right top, #1e3c72, #2a5298); color: white; height: 100%;">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100 text-center">
                    <h1 class="display-1 fw-bolder animate__animated animate__fadeInUp">Jelajahi Koleksi Ikan Hias Kami</h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s">Dari ikan tropis hingga eksotis, kami punya semuanya!</p>
                    <div class="button-group d-flex flex-column flex-sm-row justify-content-center align-items-center">
                        <a href="{{ url('/fishView') }}" class="btn btn-warning btn-lg px-5 rounded-pill animate__animated animate__zoomIn animate__delay-2s m-2">
                            <i class="mdi mdi-fish me-2"></i> Lihat Semua Koleksi
                        </a>
                        <a href="{{ url('/fishView') }}" class="btn btn-outline-light btn-lg px-5 rounded-pill animate__animated animate__zoomIn animate__delay-2s m-2">
                            <i class="mdi mdi-shopping me-2"></i> Mulai Berbelanja
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container intro-section my-5 py-5 bg-light rounded-4 shadow-lg text-center">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-11">
            <h2 class="display-3 fw-bold mb-4 text-primary">Vans Aquatic: Toko Ikan Online Terpercaya</h2>
            <p class="fs-5 text-secondary px-lg-5 mb-4">
                Vans Aquatic adalah destinasi utama untuk pecinta ikan hias di seluruh Indonesia. Kami menawarkan berbagai jenis ikan hias berkualitas tinggi, mulai dari ikan tropis yang berwarna-warni hingga spesies eksotis yang langka. Dengan pengalaman bertahun-tahun dalam industri akuatik, kami memastikan setiap ikan yang kami jual dalam kondisi sehat dan siap mempercantik akuarium Anda.
            </p>
            <p class="fs-5 text-secondary px-lg-5 mb-5">
                Kami memahami bahwa membeli ikan secara online membutuhkan kepercayaan. Oleh karena itu, Vans Aquatic menyediakan layanan pengiriman yang aman dengan kemasan khusus untuk menjaga kesehatan ikan selama perjalanan. Tim kami juga siap memberikan panduan perawatan ikan untuk memastikan pengalaman Anda menyenangkan, baik untuk pemula maupun penghobi berpengalaman. Jelajahi koleksi kami dan temukan ikan impian Anda!
            </p>
            <a href="{{ url('/fishView') }}" class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm">
                <i class="mdi mdi-aquarium me-2"></i> Mulai Berbelanja Sekarang
            </a>
        </div>
    </div>
</section>

<section class="container why-us-section my-5 py-5">
    <div class="row justify-content-center mb-5">
        <div class="col-12 text-center">
            <h2 class="display-3 fw-bold text-primary mb-3">Mengapa Memilih Vans Aquatic?</h2>
            <p class="lead text-secondary">Pengalaman terbaik dalam berbelanja ikan hias hanya di sini.</p>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-lg-4 col-md-6 mb-4 text-center">
            <div class="card h-100 border-0 p-4 shadow-lg feature-card">
                <div class="icon-circle mb-4 mx-auto">
                    <i class="mdi mdi-fish display-4 text-white"></i>
                </div>
                <h3 class="fw-bold mb-3 text-dark">Koleksi Ikan Berkualitas</h3>
                <p class="text-secondary">Kami menyediakan ikan hias sehat dari sumber terpercaya dengan berbagai jenis dan warna yang memukau.</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4 text-center">
            <div class="card h-100 border-0 p-4 shadow-lg feature-card">
                <div class="icon-circle mb-4 mx-auto">
                    <i class="mdi mdi-truck-fast display-4 text-white"></i>
                </div>
                <h3 class="fw-bold mb-3 text-dark">Pengiriman Aman & Cepat</h3>
                <p class="text-secondary">Kemasan khusus dan kurir terpercaya memastikan ikan sampai dalam kondisi prima ke seluruh Indonesia.</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4 text-center">
            <div class="card h-100 border-0 p-4 shadow-lg feature-card">
                <div class="icon-circle mb-4 mx-auto">
                    <i class="mdi mdi-face-agent display-4 text-white"></i>
                </div>
                <h3 class="fw-bold mb-3 text-dark">Dukungan Pelanggan Optimal</h3>
                <p class="text-secondary">Tim ahli kami siap membantu dengan panduan perawatan dan menjawab setiap pertanyaan Anda.</p>
            </div>
        </div>
    </div>
</section>

<footer class="bg-dark text-white py-4 mt-5 text-center">
    <div class="container">
        <p class="mb-0">Bersama laut, kami tumbuh | Van's Aquatic</p>
        <p class="mb-0 small">&copy; {{ date('Y') }} Van's Aquatic. All rights reserved.</p>
        
        {{-- Tombol Logout di Footer (Optional, hanya tampil jika @auth) --}}
        @auth
        <form id="logout-form-footer" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link btn-sm text-warning mt-2 p-0">
                <i class="mdi mdi-logout-variant me-1"></i> Logout
            </button>
        </form>
        @endauth
    </div>
</footer>

@endsection