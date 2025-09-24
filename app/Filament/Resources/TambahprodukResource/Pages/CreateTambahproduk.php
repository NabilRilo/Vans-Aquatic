<?php

namespace App\Filament\Resources\TambahprodukResource\Pages;

use App\Filament\Resources\TambahprodukResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTambahproduk extends CreateRecord
{
    protected static string $resource = TambahprodukResource::class;
     protected function getRedirectUrl(): string
    {
        return url('/fishView'); // arahkan ke halaman luar admin
    }
}
