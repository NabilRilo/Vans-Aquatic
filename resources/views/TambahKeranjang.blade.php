@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@push('styles')
    <link href="{{ asset('css/tambahkeranjang.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@endpush

@section('content')
<div class="container mt-5 cart-page-container">
    <h2 class="mb-4 page-title"><i class="mdi mdi-cart-outline me-2"></i>Keranjang Belanja Anda</h2>

    @if (session('success'))
        <div class="alert alert-success animate__animated animate__fadeIn">{{ session('success') }}</div>
    @endif

    @php
        $keranjang = session('keranjang', []);
        $totalBayar = 0;
    @endphp

    @if (count($keranjang) > 0)
        <div class="cart-items-section mb-5">
            <div class="row g-4">
                @foreach ($keranjang as $id => $item)
                    <div class="col-12">
                        <div class="card cart-item-card animate__animated animate__fadeInUp">
                            <div class="card-body d-flex align-items-center flex-wrap">
                                <div class="product-image-cell me-3">
                                    @if ($item['gambar'])
                                        <img src="{{ asset('storage/' . $item['gambar']) }}" alt="{{ $item['nama'] }}" class="product-thumbnail" />
                                    @else
                                        <img src="https://via.placeholder.com/100" alt="No Image" class="product-thumbnail" />
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1">{{ $item['nama'] }}</h5>
                                    <p class="text-muted mb-1">Harga: Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>
                                    
                                    <div class="d-flex align-items-center mt-2">
                                        <div class="quantity-selector me-3">
                                            <button type="button" class="btn btn-minus" data-id="{{ $id }}" data-action="decrease">-</button>
                                            <input type="number" name="jumlah" value="{{ $item['jumlah'] }}" min="1" class="form-control quantity-input" data-id="{{ $id }}">
                                            <button type="button" class="btn btn-plus" data-id="{{ $id }}" data-action="increase">+</button>
                                        </div>
                                        <form action="{{ route('keranjang.update', $id) }}" method="POST" class="d-inline update-form">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="jumlah" class="hidden-quantity-input" value="{{ $item['jumlah'] }}">
                                            <button type="submit" class="btn btn-outline-secondary update-quantity-btn">Update</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <p class="fw-bold mb-2">Total: Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</p>
                                    <form action="{{ route('keranjang.hapus', $id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                            <i class="mdi mdi-trash-can-outline"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $totalBayar += $item['harga'] * $item['jumlah'];
                    @endphp
                @endforeach
            </div>
        </div>

        <div class="cart-summary-checkout row justify-content-end">
            <div class="col-md-5 col-lg-4">
                <div class="card summary-card">
                    <div class="card-body">
                        <h5 class="card-title summary-title">Ringkasan Belanja</h5>
                        <ul class="list-group list-group-flush summary-list">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Total Item
                                <span class="badge bg-primary rounded-pill">{{ count($keranjang) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold total-amount">
                                Total Belanja
                                <span>Rp {{ number_format($totalBayar, 0, ',', '.') }}</span>
                            </li>
                        </ul>
                        <div class="d-grid mt-4">
                            <form action="{{ route('metode.pembayaran') }}" method="GET">
                                <button type="submit" class="btn btn-gradient btn-lg checkout-button">
                                    Lanjut ke Pembayaran <i class="mdi mdi-arrow-right-circle-outline ms-2"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="empty-cart-message text-center animate__animated animate__fadeIn">
            <i class="mdi mdi-cart-off" style="font-size: 6rem; color: #ced4da;"></i>
            <div class="alert alert-info mt-3">
                Keranjang Anda masih kosong. Yuk, pilih ikan-ikan cantik!
            </div>
            <a href="{{ route('fish.view') }}" class="btn btn-gradient continue-shopping-btn">
                Kembali Belanja
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartItems = document.querySelectorAll('.cart-item-card');

        cartItems.forEach(item => {
            const minusBtn = item.querySelector('.btn-minus');
            const plusBtn = item.querySelector('.btn-plus');
            const quantityInput = item.querySelector('.quantity-input');
            const hiddenInput = item.querySelector('.hidden-quantity-input');
            const updateForm = item.querySelector('.update-form');

            if (minusBtn) {
                minusBtn.addEventListener('click', function() {
                    let quantity = parseInt(quantityInput.value);
                    if (quantity > 1) {
                        quantityInput.value = quantity - 1;
                        hiddenInput.value = quantity - 1;
                        updateForm.submit();
                    }
                });
            }

            if (plusBtn) {
                plusBtn.addEventListener('click', function() {
                    let quantity = parseInt(quantityInput.value);
                    quantityInput.value = quantity + 1;
                    hiddenInput.value = quantity + 1;
                    updateForm.submit();
                });
            }
        });
    });
</script>
@endpush