@extends('layouts.app') 

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
        <h2 class="card-title text-center mb-4">Masuk ke Akun Anda</h2>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- ALERT ERROR KESELURUHAN --}}
            @if ($errors->any() && !old('password'))
                <div class="alert alert-danger mb-3" role="alert">
                    Email atau Password salah.
                </div>
            @endif

            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">Login</button>
            </div>
        </form>

        <div class="text-center mt-4">
            <hr class="my-3">
            <p class="mb-0 text-muted">Belum punya akun?</p>
            <a href="{{ route('register') }}" class="btn btn-link">Daftar Akun Baru</a>
        </div>
    </div>
</div>
@endsection