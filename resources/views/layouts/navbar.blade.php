@php
    $keranjang = session()->get('keranjang', []);
    $totalItemUnik = count($keranjang);
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand fw-bold text-dark" href="{{ url('/home') }}">
            <i class="mdi mdi-fish"></i> Van's Aquatic
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('home') ? 'active fw-semibold' : '' }} text-dark" href="{{ url('/home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('fishView') ? 'active fw-semibold' : '' }} text-dark" href="{{ url('/fishView') }}">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('kategori-barang') ? 'active fw-semibold' : '' }} text-dark" href="{{ url('/kategori-barang') }}">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('hubungi-kami') ? 'active fw-semibold' : '' }} text-dark" href="{{ route('hubungi-kami') }}">Hubungi Kami</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link position-relative" href="{{ url('/keranjang') }}">
                        <i class="mdi mdi-cart-outline mdi-24px text-dark"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                            {{ count(session()->get('keranjang', [])) }}
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Add a smooth transition for links to look more modern */
    .navbar-light .navbar-nav .nav-link {
        transition: color 0.3s ease-in-out;
    }

    .navbar-light .navbar-nav .nav-link:hover {
        color: #0d6efd !important; /* A nice blue for hover effect */
    }

    /* Style the active link to stand out */
    .navbar-light .navbar-nav .nav-link.active {
        color: #0d6efd !important;
    }

    /* Adjust badge position and size */
    .nav-link .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
    }

    /* Optional: Use a different font for a professional look */
    body {
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    
</style>