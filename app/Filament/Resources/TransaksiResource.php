<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiResource\Pages;
use App\Models\Transaksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_pembeli')
                    ->label('Nama Pembeli')
                    ->required()
                    ->maxLength(100),

                Forms\Components\Textarea::make('alamat')
                    ->label('Alamat')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('no_hp')
                    ->label('Nomor HP')
                    ->required()
                    ->maxLength(15),

                Forms\Components\TextInput::make('metode_pembayaran')
                    ->label('Metode Pembayaran')
                    ->required()
                    ->maxLength(50),

                Forms\Components\FileUpload::make('bukti_pembayaran')
                    ->label('Bukti Pembayaran')
                    ->image()
                    ->directory('bukti_pembayaran')
                    ->nullable(),

                Forms\Components\TextInput::make('total_harga')
                    ->label('Total Harga')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_pembeli')
                    ->label('Nama Pembeli')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(50),

                Tables\Columns\TextColumn::make('no_hp')
                    ->label('Nomor HP'),

                Tables\Columns\TextColumn::make('metode_pembayaran')
                    ->label('Metode Pembayaran'),

                Tables\Columns\ImageColumn::make('bukti_pembayaran')
                    ->label('Bukti Pembayaran')
                    ->disk('public')
                    ->rounded()
                    ->toggleable()
                    ->url(fn ($record) => $record->bukti_pembayaran ? asset('storage/' . $record->bukti_pembayaran) : null)
                    ->openUrlInNewTab(), // ✅ klik gambar buka di tab baru

                Tables\Columns\TextColumn::make('total_harga')
                    ->label('Total Harga')
                    ->money('idr', true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }
}
