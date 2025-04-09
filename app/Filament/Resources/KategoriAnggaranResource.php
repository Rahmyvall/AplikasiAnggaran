<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriAnggaranResource\Pages;
use App\Models\Kategori_anggaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class KategoriAnggaranResource extends Resource
{
    protected static ?string $model = Kategori_anggaran::class;

    // Ganti icon navigasi
    protected static ?string $navigationIcon = 'heroicon-o-folder';


    // (Opsional) Judul menu di sidebar
    protected static ?string $navigationLabel = 'Kategori Anggaran';

    // (Opsional) Nama grup menu di sidebar
    protected static ?string $navigationGroup = 'Manajemen Anggaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kategori')
                    ->label('Nama Kategori')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->rows(3),

                Forms\Components\DateTimePicker::make('tanggal_dibuat')
                    ->label('Tanggal Dibuat')
                    ->disabled(), // Karena default-nya otomatis
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_kategori')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('nama_kategori')
                    ->label('Nama Kategori')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(50),

                Tables\Columns\TextColumn::make('tanggal_dibuat')
                    ->label('Tanggal Dibuat')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKategoriAnggarans::route('/'),
            'create' => Pages\CreateKategoriAnggaran::route('/create'),
            'edit' => Pages\EditKategoriAnggaran::route('/{record}/edit'),
        ];
    }
}
