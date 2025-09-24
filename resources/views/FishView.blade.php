@extends('layouts.app')

@section('title', 'Koleksi Ikan Hias Eksotis')

@push('styles')
<link href="{{ asset('css/fishview.css') }}" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
@endpush

@section('content')
<div class="fish-view-container container py-5">
    <div class="text-center mb-5" data-aos="fade-down">
        <h1 class="display-4 page-title">Jelajahi Dunia Bawah Air Kami</h1>
        <p class="lead text-muted">Temukan berbagai jenis ikan hias yang akan mempercantik akuarium Anda.</p>
    </div>

    {{-- Form Pencarian dengan Desain Baru --}}
    <form action="{{ route('fish.view') }}" method="GET" class="search-form" data-aos="zoom-in">
        <input type="text" name="search" class="search-input" placeholder="Cari ikan..." value="{{ request('search') }}">
        <button type="submit" class="search-button">
            <i class="fas fa-search"></i> Cari
        </button>
    </form>

    @if($products->count() > 0)
    <div class="row g-4">
        @foreach($products as $index => $product)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
            <div class="card product-card h-100">
                <div class="product-image-container">
                    <a href="{{ route('fish.detail', $product->slug) }}">
                        @if($product->gambar)
                        <img src="{{ asset('storage/' . $product->gambar) }}" class="card-img-top product-image" alt="{{ $product->nama }}">
                        @else
                        <img src="https://placehold.co/600x400/E0E0E0/B0B0B0?text=Tidak+Ada+Gambar" class="card-img-top product-image" alt="Tidak Ada Gambar">
                        @endif
                    </a>
                    <div class="stock-badge {{ $product->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                        {{ $product->stok > 0 ? 'Stok: ' . $product->stok : 'Stok Kosong' }}
                    </div>
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title product-name">{{ $product->nama }}</h5>
                    <p class="card-text product-description flex-grow-1">{{ Str::limit($product->deskripsi, 70) }}</p>
                    <p class="card-text product-price mb-3">Rp {{ number_format($product->harga,0,',','.') }}</p>
                    <a href="{{ route('fish.detail', $product->slug) }}" class="btn btn-outline-primary product-detail-button mt-auto">
                        Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="alert alert-light text-center py-5 not-found-alert" data-aos="zoom-in">
        <i class="fas fa-fish fa-3x mb-3 text-muted"></i>
        <h4>Oops! Ikan Tidak Ditemukan</h4>
        <p>Tidak ada hasil untuk "<strong>{{ request('search') }}</strong>".</p>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 50
    });
</script>
@endpush