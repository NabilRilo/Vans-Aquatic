<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TambahprodukResource\Pages;
use App\Models\Tambahproduk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class TambahprodukResource extends Resource
{
    protected static ?string $model = Tambahproduk::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Produk';
    protected static ?string $modelLabel = 'Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->placeholder('Pilih Kategori Produk')
                    ->required()
                    ->native(false)
                    ->searchable(),

                Forms\Components\TextInput::make('nama')
                    ->label('Nama Produk')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) =>
                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                    ),

                Forms\Components\Hidden::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi Produk')
                    ->rows(3)
                    ->nullable()
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('harga')
                    ->label('Harga Produk')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),

                Forms\Components\TextInput::make('stok')
                    ->label('Stok Produk')
                    ->required()
                    ->numeric()
                    ->minValue(0),

                Forms\Components\FileUpload::make('gambar')
                    ->label('Gambar Utama')
                    ->image()
                    ->directory('produk-gambar')
                    ->disk('public')
                    ->required()
                    ->columnSpanFull()
                    ->helperText('Gambar utama yang akan ditampilkan pertama'),

                // ✅ PERBAIKAN: Gallery Images dengan preview dan pengurutan yang lebih baik
                Forms\Components\FileUpload::make('gallery_images')
                    ->label('Gallery Images (Maksimal 5 foto)')
                    ->image()
                    ->multiple()
                    ->maxFiles(5)
                    ->directory('produk-gallery')
                    ->disk('public')
                    ->columnSpanFull()
                    ->helperText('Upload maksimal 5 gambar untuk gallery slider. Urutan gambar dapat diatur dengan drag & drop.')
                    ->reorderable()
                    ->appendFiles()
                    ->panelLayout('grid')
                    ->imageResizeMode('cover')
                    ->imageResizeTargetWidth('800')
                    ->imageResizeTargetHeight('600')
                    ->imagePreviewHeight('150')
                    ->loadingIndicatorPosition('left')
                    ->panelAspectRatio('1:1')
                    ->removeUploadedFileButtonPosition('right')
                    ->uploadButtonPosition('left')
                    ->uploadProgressIndicatorPosition('left'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Gambar Utama')
                    ->disk('public')
                    ->rounded()
                    ->size(50)
                    ->url(fn ($record) => $record->gambar ? asset('storage/' . $record->gambar) : null)
                    ->openUrlInNewTab(),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable()
                    ->badge(),

                Tables\Columns\TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable()
                    ->color('success'),

                Tables\Columns\TextColumn::make('stok')
                    ->label('Stok')
                    ->sortable()
                    ->color(fn ($record) => $record->stok > 0 ? 'success' : 'danger')
                    ->formatStateUsing(fn ($state) => $state > 0 ? $state : 'HABIS'),

                Tables\Columns\TextColumn::make('gallery_images_count')
                    ->label('Gallery')
                    ->badge()
                    ->color(fn ($state) => $state > 0 ? 'info' : 'gray')
                    ->formatStateUsing(fn ($state) => $state > 0 ? "{$state} foto" : 'Belum ada')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->label('Filter Kategori')
                    ->preload()
                    ->multiple(),

                Tables\Filters\Filter::make('has_gallery')
                    ->label('Punya Gallery')
                    ->query(fn ($query) => $query->whereNotNull('gallery_images')),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->tooltip('Edit Produk'),
                Tables\Actions\DeleteAction::make()
                    ->tooltip('Hapus Produk'),
                
                Tables\Actions\Action::make('view_website')
                    ->label('Lihat di Website')
                    ->icon('heroicon-o-eye')
                    ->url(fn ($record) => route('fish.detail', $record->slug))
                    ->openUrlInNewTab()
                    ->tooltip('Lihat produk di website'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    
                    Tables\Actions\BulkAction::make('reset_gallery')
                        ->label('Reset Gallery')
                        ->icon('heroicon-o-trash')
                        ->action(fn ($records) => $records->each->update(['gallery_images' => null]))
                        ->deselectRecordsAfterCompletion()
                        ->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListTambahproduks::route('/'),
            'create' => Pages\CreateTambahproduk::route('/create'),
            'edit' => Pages\EditTambahproduk::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'success';
    }
}