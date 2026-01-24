<?php

namespace App\Filament\Resources\Dekans\Pages;

use App\Filament\Resources\Dekans\DekanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDekan extends EditRecord
{
    protected static string $resource = DekanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
