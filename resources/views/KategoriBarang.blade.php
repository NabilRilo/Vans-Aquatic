@extends('layouts.app')

@section('title', 'Kategori Produk')

@push('styles')
<link href="{{ asset('css/category_product_styles.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@5.9.55/css/materialdesignicons.min.css">
@endpush

@section('content')
<div class="container mt-5">
    <h2 class="mb-5 text-center fw-bold text-primary animate__animated animate__fadeInDown">
        Jelajahi Kategori Produk Kami
    </h2>

    <div class="row">
        @forelse ($categories as $kategori)
        <div class="col-12 mb-4 category-item-wrapper animate__animated animate__fadeInUp animate__delay-{{ $loop->index * 0.2 }}s">
            <div class="card category-card shadow-lg border-0 rounded-4 overflow-hidden">
                {{-- Header kategori --}}
                <a href="#" class="card-header category-header d-flex justify-content-between align-items-center p-4 text-decoration-none collapsed" data-bs-toggle="collapse" data-bs-target="#products-{{ $kategori->id }}" aria-expanded="false" aria-controls="products-{{ $kategori->id }}">
                    <h5 class="mb-0 text-dark fw-bold">{{ $kategori->name }}</h5>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-primary rounded-pill fs-6 py-2 px-3 me-2 animate__animated animate__pulse animate__infinite">
                            {{ $kategori->products_count }} Produk
                        </span>
                        <i class="mdi mdi-chevron-down fs-5 text-primary icon-toggle"></i>
                    </div>
                </a>

                {{-- Produk --}}
                <div id="products-{{ $kategori->id }}" class="category-products collapse p-4">
                    @if ($kategori->products->isEmpty())
                    <div class="text-center text-muted py-5 fs-5">
                        Tidak ada produk untuk kategori ini.
                    </div>
                    @else
                    <div class="row g-4">
                        @foreach ($kategori->products as $product)
                        <div class="col-6 col-md-4 col-lg-3 product-item animate__animated animate__zoomIn animate__delay-{{ $loop->index * 0.1 }}s">
                            <div class="card h-100 product-card shadow-sm border-0 rounded-3 overflow-hidden">
                                {{-- Link ke halaman detail produk --}}
                                <a href="{{ route('fish.detail', $product->slug) }}">
                                    <img src="{{ asset('storage/' . $product->gambar) }}" class="card-img-top object-fit-cover product-image" alt="{{ $product->nama }}">
                                </a>
                                <div class="card-body d-flex flex-column p-3">
                                    <h6 class="card-title text-center mb-1 fw-bold text-truncate product-name">{{ $product->nama }}</h6>
                                    <p class="card-text text-center text-muted flex-grow-1 small">Stok: {{ $product->stok }}</p>
                                </div>
                                <div class="card-footer text-center p-2 bg-light border-0">
                                    <span class="fw-bold text-success fs-5 product-price">Rp{{ number_format($product->harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="lead text-muted animate__animated animate__fadeIn">Belum ada kategori produk yang tersedia.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Jika ingin menambahkan JS khusus, tulis di sini. Untuk collapse Bootstrap sudah otomatis bekerja.
</script>
@endpush
