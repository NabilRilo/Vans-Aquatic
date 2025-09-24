<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';
    protected static ?string $title = 'Produk dalam Kategori Ini';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->disk('public')
                    ->circular()
                    ->url(fn ($record) => $record->gambar ? asset('storage/' . $record->gambar) : null) // menambahkan URL
                    ->openUrlInNewTab(), // klik gambar buka tab baru

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Produk'),

                Tables\Columns\TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('stok')
                    ->label('Stok'),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
