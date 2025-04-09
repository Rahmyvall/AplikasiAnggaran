<?php

namespace App\Filament\Resources\PeriodeAnggaranResource\Pages;

use App\Filament\Resources\PeriodeAnggaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPeriodeAnggaran extends EditRecord
{
    protected static string $resource = PeriodeAnggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
