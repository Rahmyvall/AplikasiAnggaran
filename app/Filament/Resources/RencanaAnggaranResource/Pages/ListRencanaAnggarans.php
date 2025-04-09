<?php

namespace App\Filament\Resources\RencanaAnggaranResource\Pages;

use App\Filament\Resources\RencanaAnggaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRencanaAnggarans extends ListRecords
{
    protected static string $resource = RencanaAnggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
