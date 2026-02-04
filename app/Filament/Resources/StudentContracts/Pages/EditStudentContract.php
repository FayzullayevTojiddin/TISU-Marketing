<?php

namespace App\Filament\Resources\StudentContracts\Pages;

use App\Filament\Resources\StudentContracts\StudentContractResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditStudentContract extends EditRecord
{
    protected static string $resource = StudentContractResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('download')
                ->label('Shartnomani yuklab olish')
                ->icon('heroicon-o-arrow-down-tray')
                ->visible(fn () => filled($this->record->file_path))
                ->action(function () {
                    $fullPath = storage_path(
                        'app/' . ltrim($this->record->file_path, '/')
                    );

                    if (! file_exists($fullPath)) {
                        abort(404, 'Contract file not found');
                    }

                    return response()->download($fullPath);
                }),
            DeleteAction::make(),
        ];
    }
}
