<?php

namespace App\Filament\Pages\Dashboard\Widgets;

use App\Models\StudentContract;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class PaymentStatsOverview extends BaseWidget
{
    public ?array $filters = [];

    protected function getStats(): array
    {
        $stats = $this->getPaymentStats();

        return [
            Stat::make('0% - 25%', $stats['range_0_25'])
                ->description('Kam to\'laganlar')
                ->color('danger')
                ->icon('heroicon-o-exclamation-circle'),

            Stat::make('25% - 50%', $stats['range_25_50'])
                ->description('Qisman to\'laganlar')
                ->color('warning')
                ->icon('heroicon-o-clock'),

            Stat::make('50% - 75%', $stats['range_50_75'])
                ->description('Yarmidan ko\'p')
                ->color('info')
                ->icon('heroicon-o-arrow-trending-up'),

            Stat::make('75% - 100%', $stats['range_75_100'])
                ->description('Deyarli to\'liq')
                ->color('success')
                ->icon('heroicon-o-check-circle'),
        ];
    }

    protected function getPaymentStats(): array
    {
        $cacheKey = 'dashboard_stats_' . md5(json_encode($this->filters));

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
