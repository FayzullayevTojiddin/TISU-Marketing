<?php

namespace App\Filament\Resources\Kurators\Pages;

use App\Filament\Resources\Kurators\KuratorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKurators extends ListRecords
{
    protected static string $resource = KuratorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
