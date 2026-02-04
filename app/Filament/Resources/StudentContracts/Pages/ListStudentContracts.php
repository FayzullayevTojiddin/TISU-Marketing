<?php

namespace App\Filament\Resources\StudentContracts\Pages;

use App\Filament\Resources\StudentContracts\StudentContractResource;
use App\Livewire\StudentContractStats;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStudentContracts extends ListRecords
{
    protected static string $resource = StudentContractResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getHeaderWidgets(): array
    {
        return [
            StudentContractStats::class
        ];
    }
}
