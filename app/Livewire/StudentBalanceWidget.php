<?php

namespace App\Livewire;

use App\Enums\PaymentType;
use App\Models\StudentPayment;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StudentBalanceWidget extends StatsOverviewWidget
{
    use InteractsWithRecord;

    protected int | string | array $columnSpan = 'full';

    protected function getColumns(): int
    {
        return 2;
    }

    protected function getStats(): array
    {
        if (! $this->record) {
            return [];
        }

        $studentId = $this->record->id;

        $plusTotal = StudentPayment::where('student_id', $studentId)
            ->where('type', PaymentType::PLUS)
            ->sum('amount');

        $paidTotal = StudentPayment::where('student_id', $studentId)
            ->sum(DB::raw("
                CASE
                    WHEN type = '" . PaymentType::PLUS->value . "'
                    THEN amount
                    ELSE -amount
                END
            "));

        return [
            Stat::make(
                'Hozirgi balans',
                number_format($plusTotal, 0, '.', ' ') . " so'm"
            )
                ->icon('heroicon-o-wallet')
                ->color('success'),

            Stat::make(
                'Umumiy to‘langan summa',
                number_format(max($paidTotal, 0), 0, '.', ' ') . " so'm"
            )
                ->icon('heroicon-o-credit-card')
                ->color('primary'),
        ];
    }
}
