<?php

namespace App\Filament\Resources\TambahprodukResource\Pages;

use App\Filament\Resources\TambahprodukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTambahproduk extends EditRecord
{
   protected static string $resource = TambahprodukResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // contoh: ubah nama jadi huruf besar
        $data['nama'] = strtoupper($data['nama']);
        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}