<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatusPersetujuanResource\Pages;
use App\Models\Status_persetujuan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StatusPersetujuanResource extends Resource
{
    protected static ?string $model = Status_persetujuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-badge';
    protected static ?string $navigationLabel = 'Status Persetujuan';
    protected static ?string $pluralLabel = 'Status Persetujuan';
    protected static ?string $modelLabel = 'Status Persetujuan';
    protected static ?string $navigationGroup = 'Manajemen Anggaran';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('id_rencana')
                ->label('Rencana Anggaran')
                ->relationship('rencana', 'nama_rencana')
                ->searchable()
                ->required()
                ->placeholder('Pilih Rencana Anggaran'),

            Forms\Components\Select::make('id_pengguna')
                ->label('Pengguna')
                ->relationship('pengguna', 'nama')
                ->searchable()
                ->required()
                ->placeholder('Pilih Pengguna'),

            Forms\Components\Select::make('status')
                ->label('Status Persetujuan')
                ->options([
                    'menunggu' => 'Menunggu',
                    'disetujui' => 'Disetujui',
                    'ditolak' => 'Ditolak',
                ])
                ->required()
                ->native(false),

            Forms\Components\Textarea::make('catatan')
                ->label('Catatan (Opsional)')
                ->rows(3)
                ->maxLength(500)
                ->placeholder('Tulis catatan jika diperlukan...'),

            Forms\Components\DateTimePicker::make('tanggal_status')
                ->label('Tanggal Status')
                ->default(now())
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('rencana.nama_rencana')
                ->label('Rencana Anggaran')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('pengguna.nama')
                ->label('Pengguna')
                ->searchable()
                ->sortable(),

            Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'warning' => 'menunggu',
                    'success' => 'disetujui',
                    'danger' => 'ditolak',
                ])
                ->sortable(),

            Tables\Columns\TextColumn::make('catatan')
                ->label('Catatan')
                ->limit(40)
                ->wrap()
                ->toggleable(),

            Tables\Columns\TextColumn::make('tanggal_status')
                ->label('Tanggal Status')
                ->dateTime()
                ->sortable(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Dibuat')
                ->dateTime()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->label('Filter Status')
                ->options([
                    'menunggu' => 'Menunggu',
                    'disetujui' => 'Disetujui',
                    'ditolak' => 'Ditolak',
                ]),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ])
        ->defaultSort('tanggal_status', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStatusPersetujuans::route('/'),
            'create' => Pages\CreateStatusPersetujuan::route('/create'),
            'edit' => Pages\EditStatusPersetujuan::route('/{record}/edit'),
        ];
    }
}