<?php

namespace App\Filament\Resources\Kafedras\Pages;

use App\Filament\Resources\Kafedras\KafedraResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKafedras extends ListRecords
{
    protected static string $resource = KafedraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
