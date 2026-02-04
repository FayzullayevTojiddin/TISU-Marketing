<?php

namespace App\Livewire;

use App\Models\Student;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;

class StudentSatsOverview extends ChartWidget
{
    protected ?string $heading = 'Studentlar jins bo‘yicha';

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
        $male = Cache::remember('student_male_stats', now()->addDay(), fn () => Student::where('sex', 'male')->count());
        $female = Cache::remember('student_female_stats', now()->addDay(), fn () => Student::where('sex', 'female')->count());

        return [
            'datasets' => [
                [
                    'data' => [$male, $female],
                    'backgroundColor' => [
                        '#3B82F6',
                        '#EC4899',
                    ],
                ],
            ],
            'labels' => [
                'Erkak',
                'Ayol',
            ],
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
