<?php

namespace App\Filament\Widgets;

use App\Models\Transaksi;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Actions\ViewAction;

class TransaksiOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
{
    return $table
        ->query(
            Transaksi::with(['periode', 'kategori', 'proyek', 'departemen'])
                ->latest('tanggal_transaksi')
        )
        ->defaultPaginationPageOption(5)
        ->defaultSort('tanggal_transaksi', 'desc')
        ->columns([
            Tables\Columns\TextColumn::make('tanggal_transaksi')
                ->label('Tanggal')
                ->date()
                ->sortable(),

            Tables\Columns\TextColumn::make('jenis_transaksi')
                ->label('Jenis')
                ->badge()
                ->sortable(),

            Tables\Columns\TextColumn::make('jumlah_transaksi')
                ->label('Jumlah')
                ->money('IDR', locale: 'id')
                ->sortable(),

            Tables\Columns\TextColumn::make('kategori.nama_kategori')
                ->label('Kategori')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('departemen.nama_departemen')
                ->label('Departemen')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('proyek.nama_proyek')
                ->label('Proyek')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('deskripsi')
                ->label('Deskripsi')
                ->limit(30)
                ->wrap()
                ->searchable(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('jenis_transaksi')
                ->label('Filter Jenis Transaksi')
                ->options([
                    'pemasukan' => 'Pemasukan',
                    'pengeluaran' => 'Pengeluaran',
                ]),
        ])
        ->actions([
            ViewAction::make('lihat')
                ->label('Detail')
                ->modalHeading('Detail Transaksi')
                ->modalSubheading(fn (Transaksi $record) => 'Tipe: ' . $record->jenis_transaksi)
                ->modalContent(fn (Transaksi $record) => view('filament.transaksi.detail', ['record' => $record]))
        ]);
}
}
