<?php

namespace App\Filament\Resources\Kafedras\Pages;

use App\Filament\Resources\Kafedras\KafedraResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKafedra extends EditRecord
{
    protected static string $resource = KafedraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
