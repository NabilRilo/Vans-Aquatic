@extends('layouts.app')

@section('title', 'Metode Pembayaran')

{{-- Push CSS khusus halaman ini ke stack 'styles' di layouts.app --}}
@push('styles')
<link href="{{ asset('css/metodepembayaran.css') }}" rel="stylesheet">
{{-- Tambahkan ikon untuk metode pembayaran --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush

@section('content')
<div class="container my-5">
    <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-4">📝 Detail Pengiriman</h4>

                        {{-- Form Data Diri --}}
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" required maxlength="100" value="{{ old('nama', auth()->user()->name ?? '') }}">
                            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label fw-bold">Alamat Pengiriman</label>
                            <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required maxlength="255">{{ old('alamat') }}</textarea>
                            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label fw-bold">Nomor HP (WhatsApp)</label>
                            <input type="tel" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" required pattern="[0-9+]{9,15}" placeholder="08123456789" maxlength="15" value="{{ old('no_hp') }}">
                            @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <hr class="my-4">

                        {{-- Ringkasan Pesanan (Accordion) --}}
                        @php
                        $keranjang = session('keranjang', []);
                        $totalBayar = array_reduce($keranjang, fn($carry, $item) => $carry + ($item['harga'] * $item['jumlah']), 0);
                        @endphp

                        <div class="accordion" id="orderSummaryAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrderSummary" aria-expanded="false" aria-controls="collapseOrderSummary">
                                        <strong>Ringkasan Pesanan</strong> (Klik untuk lihat detail)
                                    </button>
                                </h2>
                                <div id="collapseOrderSummary" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#orderSummaryAccordion">
                                    <div class="accordion-body p-0">
                                        @if(count($keranjang) > 0)
                                        <table class="table align-middle mb-0">
                                            <tbody>
                                                @foreach($keranjang as $item)
                                                <tr>
                                                    <td width="80"><img src="{{ asset('storage/' . $item['gambar']) }}" alt="{{ $item['nama'] }}" class="img-fluid rounded"></td>
                                                    <td>{{ $item['nama'] }} <br> <small class="text-muted">{{ $item['jumlah'] }} x Rp {{ number_format($item['harga'],0,',','.') }}</small></td>
                                                    <td class="text-end fw-medium">Rp {{ number_format($item['harga'] * $item['jumlah'],0,',','.') }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @else
                                        <div class="alert alert-info m-3">Keranjang kosong. <a href="{{ route('fish.view') }}">Belanja sekarang</a></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-4">💳 Pilih Pembayaran</h4>

                        {{-- QRIS --}}
                        <input type="radio" class="btn-check" name="metode" id="metode-qris" value="QRIS" autocomplete="off" {{ old('metode') == 'QRIS' ? 'checked' : '' }}>
                        <label class="payment-method-card" for="metode-qris">
                            <i class="bi bi-qr-code"></i>
                            <div>
                                <div class="fw-bold">QRIS</div>
                                <small class="text-muted">Bayar dengan scan QR Code.</small>
                            </div>
                        </label>

                        {{-- Transfer Bank --}}
                        <input type="radio" class="btn-check" name="metode" id="metode-transfer" value="Transfer Bank" autocomplete="off" {{ old('metode') == 'Transfer Bank' ? 'checked' : '' }}>
                        <label class="payment-method-card" for="metode-transfer">
                            <i class="bi bi-bank"></i>
                            <div>
                                <div class="fw-bold">Transfer Bank</div>
                                <small class="text-muted">Transfer manual ke rekening yang tertera.</small>
                            </div>
                        </label>

                        {{-- E-Wallet --}}
                        <input type="radio" class="btn-check" name="metode" id="metode-ewallet" value="E-Wallet" autocomplete="off" {{ old('metode') == 'E-Wallet' ? 'checked' : '' }}>
                        <label class="payment-method-card" for="metode-ewallet">
                            <i class="bi bi-wallet2"></i>
                            <div>
                                <div class="fw-bold">E-Wallet</div>
                                <small class="text-muted">Bayar ke nomor GoPay, OVO, atau DANA.</small>
                            </div>
                        </label>

                        {{-- COD --}}
                        <input type="radio" class="btn-check" name="metode" id="metode-cod" value="COD" autocomplete="off" {{ old('metode') == 'COD' ? 'checked' : '' }}>
                        <label class="payment-method-card" for="metode-cod">
                            <i class="bi bi-truck"></i>
                            <div>
                                <div class="fw-bold">Cash on Delivery (COD)</div>
                                <small class="text-muted">Bayar tunai saat barang diterima.</small>
                            </div>
                        </label>

                        {{-- === Container untuk Info Pembayaran === --}}

                        {{-- Info QRIS --}}
                        <div class="mt-3 text-center" id="qris-info-container" style="display:none;">
                            <div class="alert alert-info p-3">
                                <h6 class="fw-bold alert-heading mb-2">Scan QR Code di bawah untuk bayar:</h6>
                                <img src="{{ asset('images/qrisikan.jpg') }}" alt="QRIS Code" class="img-fluid rounded" style="max-width: 200px;">
                                <p class="small text-muted mt-2">Pastikan jumlah yang dibayarkan sesuai total harga.</p>
                            </div>
                        </div>

                        {{-- Info Rekening Bank --}}
                        <div class="mt-3" id="transfer-info-container" style="display:none;">
                            <div class="alert alert-info p-3">
                                <h6 class="fw-bold alert-heading mb-2">Silakan transfer ke salah satu rekening:</h6>
                                <ul class="list-unstyled mb-0 small">
                                    <li><strong>BCA:</strong> 1234567890 (a.n. Admin Toko Ikan)</li>
                                    <li><strong>Mandiri:</strong> 0987654321 (a.n. Admin Toko Ikan)</li>
                                </ul>
                            </div>
                        </div>

                        {{-- Info E-Wallet --}}
                        <div class="mt-3" id="ewallet-info-container" style="display:none;">
                            <div class="alert alert-info p-3">
                                <h6 class="fw-bold alert-heading mb-2">Silakan bayar ke salah satu E-Wallet:</h6>
                                <ul class="list-unstyled mb-0 small">
                                    <li><strong>GoPay/DANA:</strong> 081234567890 (a.n. Admin Toko Ikan)</li>
                                    <li><strong>OVO:</strong> 089876543210 (a.n. Admin Toko Ikan)</li>
                                </ul>
                            </div>
                        </div>

                        {{-- Upload Bukti Pembayaran --}}
                        <div class="mt-3" id="upload-bukti-container" style="display:none;">
                            <label for="bukti_pembayaran" class="form-label fw-bold">Upload Bukti Pembayaran</label>
                            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control @error('bukti_pembayaran') is-invalid @enderror" accept="image/*,.pdf">
                            @error('bukti_pembayaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">Wajib diisi jika memilih QRIS / Transfer / E-Wallet. (JPG, PNG, PDF maks 2MB)</small>
                        </div>

                        <hr class="my-4">

                        {{-- Rincian Total --}}
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Subtotal</span>
                            <strong>Rp {{ number_format($totalBayar,0,',','.') }}</strong>
                        </div>
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>Total Bayar</span>
                            <span>Rp {{ number_format($totalBayar,0,',','.') }}</span>
                        </div>

                        <input type="hidden" name="total_harga" value="{{ $totalBayar }}">

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg" {{ count($keranjang) == 0 ? 'disabled' : '' }}>
                                <i class="bi bi-shield-check-fill"></i> Bayar Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentMethods = document.querySelectorAll('input[name="metode"]');
        const uploadContainer = document.getElementById('upload-bukti-container');
        const uploadInput = document.getElementById('bukti_pembayaran');
        const transferInfoContainer = document.getElementById('transfer-info-container');
        const ewalletInfoContainer = document.getElementById('ewallet-info-container');
        const qrisInfoContainer = document.getElementById('qris-info-container');

        function updatePaymentView() {
            const selectedMethod = document.querySelector('input[name="metode"]:checked');

            // Reset semua
            uploadContainer.style.display = 'none';
            transferInfoContainer.style.display = 'none';
            ewalletInfoContainer.style.display = 'none';
            qrisInfoContainer.style.display = 'none';
            uploadInput.required = false;

            if (selectedMethod) {
                const methodValue = selectedMethod.value;

                if (methodValue === 'Transfer Bank') {
                    transferInfoContainer.style.display = 'block';
                    uploadContainer.style.display = 'block';
                    uploadInput.required = true;
                } else if (methodValue === 'E-Wallet') {
                    ewalletInfoContainer.style.display = 'block';
                    uploadContainer.style.display = 'block';
                    uploadInput.required = true;
                } else if (methodValue === 'QRIS') {
                    qrisInfoContainer.style.display = 'block';
                    uploadContainer.style.display = 'block';
                    uploadInput.required = true;
                }
            }
        }

        updatePaymentView();
        paymentMethods.forEach(method => {
            method.addEventListener('change', updatePaymentView);
        });
    });
</script>
@endpush
