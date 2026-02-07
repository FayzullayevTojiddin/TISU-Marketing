<?php

namespace App\Filament\Pages;

use App\Models\ContractType;
use App\Models\Dekan;
use App\Models\Group;
use App\Models\Kafedra;
use App\Models\Kurator;
use App\Models\StudentContract;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Cache;

class Dashboard extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationLabel = 'Statistika';
    protected static ?string $title = 'Statistika';
    protected static ?int $navigationSort = 1;

    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-chart-pie';
    }
    protected string $view = 'filament.pages.dashboard';

    public ?array $filters = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('dekan_id')
                    ->label('Dekan')
                    ->options(Dekan::pluck('title', 'id'))
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('kafedra_id', null);
                        $set('kurator_id', null);
                        $set('group_id', null);
                    }),

                Select::make('kafedra_id')
                    ->label('Kafedra')
                    ->options(fn (Get $get) =>
                        Kafedra::query()
                            ->where('dekan_id', $get('dekan_id'))
                            ->pluck('title', 'id')
                    )
                    ->disabled(fn (Get $get): bool => blank($get('dekan_id')))
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('kurator_id', null);
                        $set('group_id', null);
                    }),

                Select::make('kurator_id')
                    ->label('Kurator')
                    ->options(fn (Get $get) =>
                        Kafedra::find($get('kafedra_id'))
                            ?->kurators()
                            ->join('users', 'users.id', '=', 'kurators.user_id')
                            ->pluck('users.name', 'kurators.id')
                            ?? []
                    )
                    ->disabled(fn (Get $get): bool => blank($get('kafedra_id')))
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('group_id', null);
                    }),

                Select::make('group_id')
                    ->label('Guruh')
                    ->options(fn (Get $get) =>
                        Group::query()
                            ->where('kurator_id', $get('kurator_id'))
                            ->where('kafedra_id', $get('kafedra_id'))
                            ->pluck('title', 'id')
                    )
                    ->disabled(fn (Get $get): bool => blank($get('kurator_id')))
                    ->live(),

                Select::make('contract_type_id')
                    ->label('Shartnoma turi')
                    ->options(ContractType::pluck('title', 'id'))
                    ->live(),
            ])
            ->columns(3)
            ->statePath('filters');
    }

    public function getPaymentStats(): array
    {
        $cacheKey = 'dashboard_stats_' . md5(json_encode($this->filters));

        return Cache::remember($cacheKey, now()->addDay(), function () {
            $query = StudentContract::query();

            if (!empty($this->filters['contract_type_id'])) {
                $query->where('contract_type_id', $this->filters['contract_type_id']);
            }

            if (!empty($this->filters['group_id'])) {
                $query->whereHas('student', fn ($q) => $q->where('group_id', $this->filters['group_id']));
            } elseif (!empty($this->filters['kurator_id'])) {
                $query->whereHas('student.group', fn ($q) =>
                    $q->where('kurator_id', $this->filters['kurator_id'])
                    ->where('kafedra_id', $this->filters['kafedra_id'])
                );
            } elseif (!empty($this->filters['kafedra_id'])) {
                $query->whereHas('student.group', fn ($q) => $q->where('kafedra_id', $this->filters['kafedra_id']));
            } elseif (!empty($this->filters['dekan_id'])) {
                $query->whereHas('student.group.kafedra', fn ($q) => $q->where('dekan_id', $this->filters['dekan_id']));
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
