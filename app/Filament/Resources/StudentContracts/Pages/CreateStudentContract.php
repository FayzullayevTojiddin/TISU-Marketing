<?php

namespace App\Filament\Resources\StudentContracts\Pages;

use App\Filament\Resources\StudentContracts\StudentContractResource;
use App\Services\ContractGenerateService;
use Filament\Resources\Pages\CreateRecord;

class CreateStudentContract extends CreateRecord
{
    protected static string $resource = StudentContractResource::class;

    protected function afterCreate(): void
    {
        app(ContractGenerateService::class)->generate($this->record);
    }
}
