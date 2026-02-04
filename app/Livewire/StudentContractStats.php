<?php

namespace App\Livewire;

use App\Models\StudentContract;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StudentContractStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Jami kontraktlar', StudentContract::count())
                ->color('primary')
                ->icon('heroicon-o-document-text'),

            Stat::make('Yakunlangan kontraktlar', StudentContract::where('is_completed', true)->count())
                ->color('success')
                ->icon('heroicon-o-check-circle'),

            Stat::make('Yakunlanmagan kontraktlar', StudentContract::where('is_completed', false)->count())
                ->color('danger')
                ->icon('heroicon-o-x-circle'),
        ];
    }
}
