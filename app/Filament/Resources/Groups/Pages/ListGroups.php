<?php

namespace App\Filament\Resources\Groups\Pages;

use App\Filament\Resources\Groups\GroupResource;
use App\Livewire\GroupStatsOverview;
use App\Livewire\GroupCoursePieChart;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGroups extends ListRecords
{
    protected static string $resource = GroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getHeaderWidgets(): array
    {
        return [
            GroupStatsOverview::class,
            GroupCoursePieChart::class,
        ];
    }
}
