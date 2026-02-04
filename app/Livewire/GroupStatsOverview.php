<?php

namespace App\Livewire;

use App\Models\Group;
use Filament\Widgets\ChartWidget;

class GroupStatsOverview extends ChartWidget
{
    protected ?string $heading = 'Guruhlar kurslar bo‘yicha';

    public function getColumnSpan(): int|string|array
    {
        return "half";
    }

    public function getMinHeight(): ?string
    {
        return '400px';
    }

    protected function getData(): array
    {
        $groups = Group::query()
            ->where('status', true)
            ->selectRaw('
                (EXTRACT(YEAR FROM CURRENT_DATE) - enrollment_year + 1) as course,
                COUNT(*) as total
            ')
            ->groupBy('course')
            ->havingRaw('(EXTRACT(YEAR FROM CURRENT_DATE) - enrollment_year + 1) <= 7')
            ->orderBy('course')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Guruhlar soni',
                    'data' => $groups->pluck('total')->toArray(),
                    'backgroundColor' => 'rgba(234, 179, 8, 0.85)',
                    'borderColor' => 'rgb(234, 179, 8)',
                    'borderWidth' => 1,
                    'borderRadius' => 10,
                    'barThickness' => 28,
                    'hoverBackgroundColor' => 'rgba(234, 179, 8, 1)',
                ],
            ],
            'labels' => $groups
                ->pluck('course')
                ->map(fn ($course) => "{$course}-kurs")
                ->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,

            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
                'tooltip' => [
                    'backgroundColor' => '#111827',
                    'titleColor' => '#F9FAFB',
                    'bodyColor' => '#F9FAFB',
                    'borderColor' => '#374151',
                    'borderWidth' => 1,
                    'padding' => 10,
                ],
            ],

            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                        'color' => '#9CA3AF',
                        'font' => [
                            'size' => 12,
                        ],
                    ],
                    'grid' => [
                        'color' => 'rgba(255,255,255,0.05)',
                        'drawBorder' => false,
                    ],
                ],
                'x' => [
                    'ticks' => [
                        'color' => '#D1D5DB',
                        'font' => [
                            'size' => 12,
                            'weight' => '500',
                        ],
                    ],
                    'grid' => [
                        'display' => false,
                    ],
                ],
            ],
        ];
    }

    public function getColumns(): int|array|null
    {
        return 8;
    }
}
