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

    // Ganti icon navigasi di sidebar
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Transaksi';
    protected static ?string $modelLabel = 'Transaksi';
    protected static ?string $navigationGroup = 'Data Master';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('id_periode')
                ->relationship('periode', 'nama_periode') // ganti sesuai kolom yang ditampilkan
                ->required(),

            Forms\Components\Select::make('id_kategori')
                ->relationship('kategori', 'nama_kategori')
                ->required(),

            Forms\Components\Select::make('id_proyek')
                ->relationship('proyek', 'nama_proyek')
                ->nullable(),

            Forms\Components\Select::make('departemen_id')
                ->relationship('departemen', 'nama_departemen')
                ->nullable(),

            Forms\Components\Select::make('jenis_transaksi')
                ->options([
                    'pemasukan' => 'Pemasukan',
                    'pengeluaran' => 'Pengeluaran',
                ])
                ->required(),

            Forms\Components\DatePicker::make('tanggal_transaksi')
                ->required(),

            Forms\Components\TextInput::make('jumlah_transaksi')
                ->numeric()
                ->required(),

            Forms\Components\Textarea::make('deskripsi')
                ->nullable(),

            Forms\Components\FileUpload::make('bukti_pendukung')
                ->directory('bukti-transaksi')
                ->nullable(),

            Forms\Components\DateTimePicker::make('tanggal_dibuat')
                ->disabled()
                ->default(now()),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id_transaksi')->label('ID')->sortable(),
            Tables\Columns\TextColumn::make('periode.nama_periode')->label('Periode')->searchable(),
            Tables\Columns\TextColumn::make('kategori.nama_kategori')->label('Kategori')->searchable(),
            Tables\Columns\TextColumn::make('proyek.nama_proyek')->label('Proyek')->searchable()->toggleable(),
            Tables\Columns\TextColumn::make('departemen.nama_departemen')->label('Departemen')->toggleable(),
            Tables\Columns\TextColumn::make('jenis_transaksi')->sortable(),
            Tables\Columns\TextColumn::make('tanggal_transaksi')->date(),
            Tables\Columns\TextColumn::make('jumlah_transaksi')->money('IDR', true),
            Tables\Columns\TextColumn::make('tanggal_dibuat')->dateTime()->toggleable(isToggledHiddenByDefault: true),
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
        return [];
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
