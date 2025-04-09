<?php

namespace App\Filament\Resources\StatusPersetujuanResource\Pages;

use App\Filament\Resources\StatusPersetujuanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatusPersetujuans extends ListRecords
{
    protected static string $resource = StatusPersetujuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
