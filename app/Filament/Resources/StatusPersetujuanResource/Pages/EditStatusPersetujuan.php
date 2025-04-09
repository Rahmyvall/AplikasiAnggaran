<?php

namespace App\Filament\Resources\StatusPersetujuanResource\Pages;

use App\Filament\Resources\StatusPersetujuanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatusPersetujuan extends EditRecord
{
    protected static string $resource = StatusPersetujuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
