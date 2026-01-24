<?php

namespace App\Filament\Resources\Dekans\Pages;

use App\Filament\Resources\Dekans\DekanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDekans extends ListRecords
{
    protected static string $resource = DekanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
