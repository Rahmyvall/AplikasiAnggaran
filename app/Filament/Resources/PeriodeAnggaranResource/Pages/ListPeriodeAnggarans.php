<?php

namespace App\Filament\Resources\PeriodeAnggaranResource\Pages;

use App\Filament\Resources\PeriodeAnggaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPeriodeAnggarans extends ListRecords
{
    protected static string $resource = PeriodeAnggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
