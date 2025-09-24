<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Van\'s Aquatic - Toko Ikan Hias Online')</title>

    {{-- Google Fonts: Poppins dan Segoe UI --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&family=Segoe+UI:wght@300;400;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap 5.3.3 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- Link CSS Kustom Aplikasi Anda --}}
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    {{-- Material Design Icons (MDI) --}}
    <link href="https://cdn.materialdesignicons.com/6.5.95/css/materialdesignicons.min.css" rel="stylesheet" />

    {{-- Animate.css untuk animasi CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    {{-- Ini adalah tempat untuk CSS tambahan dari view anak (misal: KategoriBarang.css) --}}
    @stack('styles')

</head>
<body>
    {{-- Include Navbar Anda. Pastikan file ini ada di resources/views/layouts/navbar.blade.php --}}
    @include('layouts.navbar')

    {{-- Area konten utama --}}
    <main>
        @yield('content')
    </main>

    {{-- jQuery (PENTING! Diperlukan oleh skrip KategoriBarang.blade.php) --}}
    {{-- Letakkan sebelum skrip kustom Anda dan Bootstrap JS jika skrip kustom mengandalkan jQuery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    {{-- Bootstrap 5.3.3 JS Bundle (sudah termasuk Popper.js) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    {{-- Ini adalah tempat untuk JavaScript tambahan dari view anak --}}
    @stack('scripts')

</body>
</html>
