<?php

namespace App\Filament\Pages\Dashboard\Widgets;

use App\Models\StudentContract;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;

class PaymentStatsChart extends ChartWidget
{
    protected ?string $heading = 'To\'lov foizi bo\'yicha';
    protected ?string $maxHeight = '300px';

    public ?array $filters = [];

    protected function getData(): array
    {
        $stats = $this->getPaymentStats();

        return [
            'datasets' => [
                [
                    'data' => [
                        $stats['range_0_25'],
                        $stats['range_25_50'],
                        $stats['range_50_75'],
                        $stats['range_75_100'],
                    ],
                    'backgroundColor' => [
                        '#ef4444', // red - 0-25%
                        '#f97316', // orange - 25-50%
                        '#eab308', // yellow - 50-75%
                        '#22c55e', // green - 75-100%
                    ],
                    'borderWidth' => 0,
                ],
            ],
            'labels' => ['0-25%', '25-50%', '50-75%', '75-100%'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                ],
            ],
            'cutout' => '60%',
        ];
    }

    protected function getPaymentStats(): array
    {
        $cacheKey = 'dashboard_chart_' . md5(json_encode($this->filters));

        return Cache::remember($cacheKey, now()->addDay(), function () {
            $query = StudentContract::query();

            if (!empty($this->filters['contract_type_id'])) {
                $query->where('contract_type_id', $this->filters['contract_type_id']);
            }

            if (!empty($this->filters['student_id'])) {
                $query->where('student_id', $this->filters['student_id']);
            } elseif (!empty($this->filters['group_id'])) {
                $query->whereHas('student', fn ($q) => $q->where('group_id', $this->filters['group_id']));
            } elseif (!empty($this->filters['kurator_id'])) {
                $query->whereHas('student.group', fn ($q) => $q->where('kurator_id', $this->filters['kurator_id']));
            } elseif (!empty($this->filters['kafedra_id'])) {
                $query->whereHas('student.group.kurator', fn ($q) => $q->where('kafedra_id', $this->filters['kafedra_id']));
            } elseif (!empty($this->filters['dekan_id'])) {
                $query->whereHas('student.group.kurator.kafedra', fn ($q) => $q->where('dekan_id', $this->filters['dekan_id']));
            }

            $contracts = $query->with('payments')->get();

            $stats = [
                'range_0_25' => 0,
                'range_25_50' => 0,
                'range_50_75' => 0,
                'range_75_100' => 0,
            ];

            foreach ($contracts as $contract) {
                $percentage = $contract->amount > 0
                    ? ($contract->payments->sum('amount') / $contract->amount) * 100
                    : 0;

                if ($percentage >= 75) {
                    $stats['range_75_100']++;
                } elseif ($percentage >= 50) {
                    $stats['range_50_75']++;
                } elseif ($percentage >= 25) {
                    $stats['range_25_50']++;
                } else {
                    $stats['range_0_25']++;
                }
            }

            return $stats;
        });
    }
}
