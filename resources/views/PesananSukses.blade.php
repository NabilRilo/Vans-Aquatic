@extends('layouts.app')

@section('title', 'Pesanan Berhasil')

{{-- Push CSS khusus halaman ini ke stack 'styles' di layouts.app --}}
@push('styles')
    <link href="{{ asset('css/pesananSukses.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container mt-5 order-success-container">
    <div class="card order-success-card">
        <div class="card-body">
            <h2 class="card-title">🎉 Pesanan Anda Berhasil!</h2>
            <p class="card-text">Terima kasih banyak atas pesanan Anda. Kami telah menerima pembayaran Anda dan pesanan Anda akan segera kami proses.</p>
            <p class="card-text">Anda akan menerima email konfirmasi dengan detail pesanan Anda. Mohon ditunggu ya!</p>

            <a href="{{ route('home') }}" class="btn btn-primary mt-4">Kembali ke Beranda</a>

            <div class="contact-admin mt-4">
                <p>Ada pertanyaan atau butuh bantuan lebih lanjut?</p>
                <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-outline-success">
                    <i class="mdi mdi-whatsapp me-2"></i> Chat Admin Via WhatsApp
                </a>
                <small class="d-block mt-2 text-muted">Jam kerja: Senin - Sabtu, 09:00 - 17:00 WIB</small>
            </div>
        </div>
    </div>
</div>
@endsection