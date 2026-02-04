<?php

namespace App\Livewire;

use App\Models\Group;
use Filament\Widgets\ChartWidget;

class GroupCoursePieChart extends ChartWidget
{
    protected ?string $heading = 'Guruhlar kurslar bo‘yicha (Diagramma)';

    public function getColumnSpan(): int|string|array
    {
        return 'half';
    }

    protected function getType(): string
    {
        return 'doughnut';
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
            ->havingRaw('(EXTRACT(YEAR FROM CURRENT_DATE) - enrollment_year + 1) BETWEEN 1 AND 7')
            ->orderBy('course')
            ->get();

        return [
            'datasets' => [
                [
                    'data' => $groups->pluck('total')->toArray(),
                    'backgroundColor' => [
                        '#22C55E', // 1-kurs
                        '#3B82F6', // 2-kurs
                        '#F59E0B', // 3-kurs
                        '#EF4444', // 4-kurs
                        '#8B5CF6', // 5-kurs
                        '#14B8A6', // 6-kurs
                        '#F97316', // 7-kurs
                    ],
                ],
            ],
            'labels' => $groups
                ->pluck('course')
                ->map(fn ($course) => "{$course}-kurs")
                ->toArray(),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                    'labels' => [
                        'color' => '#E5E7EB',
                        'font' => [
                            'size' => 13,
                        ],
                    ],
                ],
                'tooltip' => [
                    'backgroundColor' => '#111827',
                    'titleColor' => '#F9FAFB',
                    'bodyColor' => '#F9FAFB',
                ],
            ],
            'cutout' => '60%',
        ];
    }
}
