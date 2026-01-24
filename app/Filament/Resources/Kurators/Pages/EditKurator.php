<?php

namespace App\Filament\Resources\Kurators\Pages;

use App\Filament\Resources\Kurators\KuratorResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKurator extends EditRecord
{
    protected static string $resource = KuratorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
