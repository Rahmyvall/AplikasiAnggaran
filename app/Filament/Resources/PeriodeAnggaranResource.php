<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeriodeAnggaranResource\Pages;
use App\Models\Periode_anggaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PeriodeAnggaranResource extends Resource
{
    protected static ?string $model = Periode_anggaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days'; // Ganti icon di sini

    protected static ?string $navigationLabel = 'Periode Anggaran';
    protected static ?string $pluralModelLabel = 'Periode Anggaran';
    protected static ?string $modelLabel = 'Periode Anggaran';
    protected static ?string $navigationGroup = 'Data Master';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_periode')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Periode'),
    
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->date()
                    ->label('Mulai'),
    
                Tables\Columns\TextColumn::make('tanggal_berakhir')
                    ->date()
                    ->label('Berakhir'),
    
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'aktif',
                        'danger' => 'tidak_aktif',
                        'warning' => 'selesai',
                    ])
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'aktif' => 'Aktif',
                        'tidak_aktif' => 'Tidak Aktif',
                        'selesai' => 'Selesai',
                        default => ucfirst($state),
                    }),
    
                Tables\Columns\TextColumn::make('tanggal_dibuat')
                    ->dateTime()
                    ->label('Tanggal Dibuat')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->headerActions([
                Action::make('Export PDF')
                    ->label('Export PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function () {
                        $data = Periode_anggaran::all();
    
                        $pdf = Pdf::loadView('exports.periode-anggaran-pdf', compact('data'));
    
                        return response()->streamDownload(
                            fn () => print($pdf->output()),
                            'periode-anggaran.pdf'
                        );
                    }),
    
                Action::make('Export Word')
                    ->label('Export Word')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function () {
                        $data = Periode_anggaran::all();
    
                        $phpWord = new PhpWord();
                        $section = $phpWord->addSection();
    
                        $section->addText('Daftar Periode Anggaran');
                        foreach ($data as $item) {
                            $section->addText("{$item->nama_periode} | {$item->tanggal_mulai} - {$item->tanggal_berakhir} | Status: {$item->status}");
                        }
    
                        $tempFile = tempnam(sys_get_temp_dir(), 'periode-anggaran') . '.docx';
                        $writer = IOFactory::createWriter($phpWord, 'Word2007');
                        $writer->save($tempFile);
    
                        return response()->download($tempFile)->deleteFileAfterSend(true);
                    }),
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
            'index' => Pages\ListPeriodeAnggarans::route('/'),
            'create' => Pages\CreatePeriodeAnggaran::route('/create'),
            'edit' => Pages\EditPeriodeAnggaran::route('/{record}/edit'),
        ];
    }
}
