<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - Van's Aquatic</title>

    {{-- Link Google Fonts untuk Font Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- Link ke File CSS Eksternal Anda --}}
    <link rel="stylesheet" href="{{ asset('css/hubungikami.css') }}">
</head>
<body>

    <div class="container">
        {{-- Dekorasi di atas judul --}}
        <div class="header-decoration">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zap"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
        </div>
        
        <h1 class="page-title">Hubungi Kami</h1>
        
        <div class="contact-cards-grid">
            {{-- Kartu Alamat --}}
            <div class="info-card address-card">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                </div>
                <h3>Alamat</h3>
                <p>
                    Alun - Alun Kota Wisata Batu, Jl. Sudiro, Sisir, Kec. Batu, Kota Batu, Jawa Timur 65314
                </p>
               <a href="https://maps.app.goo.gl/MiNVpmLieCbA1eDc7" target="_blank" class="map-text-link">Lihat di Peta</a>
            </div>

            {{-- Kartu WhatsApp --}}
            <div class="info-card whatsapp-card">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12c0 5.23 4.02 9.47 9.25 9.95L12 22l-.25-.05C6.73 21.47 2 17.23 2 12 2 6.48 6.48 2 12 2s10 4.48 10 10c0 4.7-3.37 8.58-7.9 9.77l-.1.03v.2c0 .28-.22.5-.5.5s-.5-.22-.5-.5v-.2c-4.53-1.19-7.9-5.07-7.9-9.77zM12 20c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/><path d="M16.5 7.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm-9 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM12 16c-2.49 0-4.5-2.01-4.5-4.5h9c0 2.49-2.01 4.5-4.5 4.5z" fill="white"/></svg>
                </div>
                <h3>WhatsApp</h3>
                <div class="whatsapp-numbers">
                    <a href="https://wa.me/628157185675" target="_blank">081-5718-5675</a>
                </div>
            </div>

            {{-- Kartu Telepon --}}
            <div class="info-card phone-card">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1v3.5c0 .55-.45 1-1 1C12.44 21 3 11.56 3 3c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.47.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                </div>
                <h3>Telepon</h3>
                <p>-</p>
                <a href="tel:+625425620928" class="phone-text-link">Hubungi Kami</a>
            </div>
        </div>

        {{-- Bagian Lokasi Kami dengan Peta --}}
        <div class="map-section">
            <h2>Lokasi Kami</h2>
            <div class="map-container">
                {{-- Ganti URL iframe ini dengan embed kode Google Maps lokasi Anda yang sebenarnya --}}
                {{-- Cara mendapatkan embed kode: Buka Google Maps, cari lokasi, klik "Share", pilih "Embed a map", lalu copy HTML-nya --}}
                <iframe 
                     src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7140.333754727656!2d112.52528147566267!3d-7.873464056193838!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e789da3a46807f1%3A0xea1a51125dafb9b8!2sAlun-Alun%20Kota%20Wisata%20Batu!5e0!3m2!1sid!2sid!4v1758718757509!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    width="600" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>

</body>
</html>