<?php

namespace App\Livewire;

use App\Models\Student;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class StudentChart extends ChartWidget
{
    protected ?string $heading = 'Talabalar statistikasi';

    // Filtersni qabul qilish uchun
    public ?array $filters = [];

    // Filterlar o'zgarganda widgetni yangilash
    protected static bool $isLazy = false;

    // Widgetga ma'lumot uzatish uchun
    public function mount(): void
    {
        $this->filters = $this->data['filters'] ?? [];
    }

    // Livewire listener - filterlar o'zgarganda
    protected function getListeners(): array
    {
        return [
            'updateChartFilters' => 'updateFilters',
        ];
    }

    public function updateFilters(array $filters): void
    {
        $this->filters = $filters;
    }

    protected function getData(): array
    {
        $query = Student::query();

        // Student tanlangan bo'lsa
        if (!empty($this->filters['student_id'])) {
            $query->where('id', $this->filters['student_id']);
        }
        // Guruh tanlangan bo'lsa
        elseif (!empty($this->filters['group_id'])) {
            $query->where('group_id', $this->filters['group_id']);
        }
        // Kurator tanlangan bo'lsa
        elseif (!empty($this->filters['kurator_id'])) {
            $query->whereHas('group', function ($q) {
                $q->where('kurator_id', $this->filters['kurator_id']);
            });
        }
        // Kafedra tanlangan bo'lsa
        elseif (!empty($this->filters['kafedra_id'])) {
            $query->whereHas('group.kurator', function ($q) {
                $q->where('kafedra_id', $this->filters['kafedra_id']);
            });
        }
        // Dekan tanlangan bo'lsa
        elseif (!empty($this->filters['dekan_id'])) {
            $query->whereHas('group.kurator.kafedra', function ($q) {
                $q->where('dekan_id', $this->filters['dekan_id']);
            });
        }

        $count = $query->count();

        return [
            'datasets' => [
                [
                    'label' => 'Talabalar soni',
                    'data' => [$count],
                    'backgroundColor' => ['rgba(59, 130, 246, 0.8)'],
                    'borderColor' => ['rgb(59, 130, 246)'],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => ['Natija'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    public function getHeading(): string|Htmlable|null
    {
        $count = $this->getCachedData()['datasets'][0]['data'][0] ?? 0;
        return "Talabalar statistikasi: {$count} ta";
    }
}
