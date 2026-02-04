<?php

namespace App\Livewire;

use App\Models\Student;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;

class StudentCoursePieChart extends ChartWidget
{
    protected ?string $heading = 'Studentlar kurslar bo‘yicha';

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
        $students = Cache::remember(
            'student_course_stats',
            now()->addDays(1),
            function () {
                return Student::query()
                    ->join('groups', 'students.group_id', '=', 'groups.id')
                    ->selectRaw('
                        (EXTRACT(YEAR FROM CURRENT_DATE) - groups.enrollment_year + 1) as course,
                        COUNT(students.id) as total
                    ')
                    ->where('groups.status', true)
                    ->groupBy('course')
                    ->havingRaw('(EXTRACT(YEAR FROM CURRENT_DATE) - groups.enrollment_year + 1) BETWEEN 1 AND 7')
                    ->orderBy('course')
                    ->get();
            }
        );

        return [
            'datasets' => [
                [
                    'data' => $students->pluck('total')->toArray(),
                    'backgroundColor' => [
                        '#22C55E',
                        '#3B82F6',
                        '#F59E0B',
                        '#EF4444',
                        '#8B5CF6',
                        '#14B8A6',
                        '#F97316',
                    ],
                ],
            ],
            'labels' => $students
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
