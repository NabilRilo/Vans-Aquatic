{{-- resources/views/produk/DetailFish.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail ' . $product->nama)

@section('content')
<div class="container my-5 py-3">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-body p-lg-5 p-md-4 p-3">
            <div class="row g-4">
                {{-- Product Image Section with Carousel --}}
                <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                    <div class="image-container w-100">
                        @php
                            $galleryImages = $product->gallery_images ?? [];
                            $allImages = array_filter(array_merge([$product->gambar], $galleryImages));
                        @endphp

                        @if(count($allImages) > 0)
                            <div id="productCarousel" class="carousel slide w-100">
                                <div class="carousel-inner rounded-3">
                                    @foreach($allImages as $index => $image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image) }}" 
                                             class="d-block w-100 product-image-main" 
                                             alt="{{ $product->nama }} - Gambar {{ $index + 1 }}">
                                    </div>
                                    @endforeach
                                </div>
                                
                                @if(count($allImages) > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                                @endif
                            </div>

                            @if(count($allImages) > 1)
                            <div class="thumbnail-container mt-4">
                                @foreach($allImages as $index => $image)
                                <img src="{{ asset('storage/' . $image) }}" 
                                     class="thumbnail {{ $index === 0 ? 'active' : '' }}" 
                                     data-bs-target="#productCarousel" 
                                     data-bs-slide-to="{{ $index }}"
                                     alt="Thumbnail {{ $index + 1 }}">
                                @endforeach
                            </div>
                            @endif
                        @else
                            <p class="text-center text-secondary">Tidak ada gambar yang tersedia.</p>
                        @endif
                    </div>
                </div>

                {{-- Product Details Section --}}
                <div class="col-lg-6 col-md-6">
                    <h1 class="display-5 fw-bold text-primary mb-3">{{ $product->nama }}</h1>
                    <p class="lead text-secondary mb-4">{{ $product->deskripsi }}</p>

                    <div class="d-flex align-items-baseline mb-4">
                        <h3 class="fw-bold text-success me-3">Rp {{ number_format($product->harga, 0, ',', '.') }}</h3>
                        @if ($product->stok > 0)
                            <span class="badge bg-success-subtle text-success-emphasis fs-6 px-3 py-2 rounded-pill">Tersedia</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger-emphasis fs-6 px-3 py-2 rounded-pill">Stok Kosong</span>
                        @endif
                    </div>

                    <div class="product-info-list mb-4">
                        <ul class="list-group list-group-flush rounded-3 border">
                            <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                                <strong>Stok:</strong>
                                <span>{{ $product->stok }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                                <strong>Kategori:</strong>
                                <span>{{ $product->category->name ?? 'Umum' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                                <strong>Berat:</strong>
                                <span>{{ $product->berat ?? '-' }} gram</span>
                            </li>
                        </ul>
                    </div>

                    {{-- Action Buttons --}}
                    <form action="{{ route('keranjang.tambah', ['id' => $product->id]) }}" method="GET" class="d-flex flex-column flex-sm-row gap-3 mt-4">
                        <a href="{{ route('fish.view') }}" class="btn btn-outline-secondary btn-lg flex-grow-1">
                            <i class="bi bi-arrow-left me-2"></i> Kembali
                        </a>

                        <div class="input-group flex-grow-1">
                            <input type="number" name="jumlah" value="1" min="1" max="{{ $product->stok }}" class="form-control form-control-lg text-center" required>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/fishdetail.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/product_detail.js') }}"></script>
@endpush
