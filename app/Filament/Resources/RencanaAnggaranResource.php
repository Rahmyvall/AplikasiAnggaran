<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RencanaAnggaranResource\Pages;
use App\Models\RencanaAnggaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RencanaAnggaranResource extends Resource
{
    protected static ?string $model = RencanaAnggaran::class;

    // Ganti icon ke yang lebih relevan untuk anggaran
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationLabel = 'Rencana Anggaran';
    protected static ?string $modelLabel = 'Rencana Anggaran';
    protected static ?string $navigationGroup = 'Data Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_periode')
                    ->relationship('periode', 'nama_periode') // sesuaikan nama kolom
                    ->required()
                    ->label('Periode'),

                Forms\Components\Select::make('id_kategori')
                    ->relationship('kategori', 'nama_kategori') // sesuaikan nama kolom
                    ->required()
                    ->label('Kategori'),

                Forms\Components\Select::make('id_proyek')
                    ->relationship('proyek', 'nama_proyek') // sesuaikan nama kolom
                    ->label('Proyek')
                    ->searchable()
                    ->nullable(),

                Forms\Components\Select::make('departemen_id')
                    ->relationship('departemen', 'nama_departemen') // sesuaikan nama kolom
                    ->label('Departemen')
                    ->searchable()
                    ->nullable(),

                Forms\Components\TextInput::make('jumlah_anggaran')
                    ->numeric()
                    ->label('Jumlah Anggaran')
                    ->required(),

                Forms\Components\Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->rows(3)
                    ->nullable(),

                Forms\Components\DatePicker::make('tanggal_dibuat')
                    ->label('Tanggal Dibuat')
                    ->disabled()
                    ->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('periode.nama_periode')->label('Periode'),
                Tables\Columns\TextColumn::make('kategori.nama_kategori')->label('Kategori'),
                Tables\Columns\TextColumn::make('proyek.nama_proyek')->label('Proyek')->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('departemen.nama_departemen')->label('Departemen')->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('jumlah_anggaran')->money('IDR')->sortable(),
                Tables\Columns\TextColumn::make('keterangan')->limit(50)->wrap(),
                Tables\Columns\TextColumn::make('tanggal_dibuat')->dateTime()->sortable(),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
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
        return [
            // Tambahkan relation managers jika ada
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRencanaAnggarans::route('/'),
            'create' => Pages\CreateRencanaAnggaran::route('/create'),
            'edit' => Pages\EditRencanaAnggaran::route('/{record}/edit'),
        ];
    }
}
