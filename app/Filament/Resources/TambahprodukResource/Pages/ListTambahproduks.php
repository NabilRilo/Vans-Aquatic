<?php

namespace App\Filament\Resources\TambahprodukResource\Pages;

use App\Filament\Resources\TambahprodukResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTambahproduks extends ListRecords
{
    protected static string $resource = TambahprodukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
