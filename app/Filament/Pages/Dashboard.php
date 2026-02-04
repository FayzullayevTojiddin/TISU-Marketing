<?php

namespace App\Filament\Pages;

use App\Models\Dekan;
use App\Models\Group;
use App\Models\Kafedra;
use App\Models\Kurator;
use App\Models\Student;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class Dashboard extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationLabel = 'Statistika';
    protected static ?string $title = 'Statistika';
    protected static ?int $navigationSort = 1;
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
                        $set('student_id', null);
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
                        $set('student_id', null);
                    }),

                Select::make('kurator_id')
                    ->label('Kurator')
                    ->options(fn (Get $get) =>
                        Kurator::query()
                            ->join('users', 'users.id', '=', 'kurators.user_id')
                            ->where('kurators.kafedra_id', $get('kafedra_id'))
                            ->pluck('users.name', 'kurators.id')
                    )
                    ->disabled(fn (Get $get): bool => blank($get('kafedra_id')))
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('group_id', null);
                        $set('student_id', null);
                    }),

                Select::make('group_id')
                    ->label('Guruh')
                    ->options(fn (Get $get) =>
                        Group::query()
                            ->where('kurator_id', $get('kurator_id'))
                            ->pluck('title', 'id')
                    )
                    ->disabled(fn (Get $get): bool => blank($get('kurator_id')))
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('student_id', null);
                    }),

                Select::make('student_id')
                    ->label('Talaba')
                    ->options(fn (Get $get) =>
                        Student::query()
                            ->where('group_id', $get('group_id'))
                            ->pluck('full_name', 'id')
                    )
                    ->disabled(fn (Get $get): bool => blank($get('group_id')))
                    ->searchable(),
            ])
            ->columns(5)
            ->statePath('filters');
    }

    /**
     * Filterlar bo'yicha studentlar sonini hisoblash
     */
    public function getStudentCount(): int
    {
        $query = Student::query();

        // Aniq talaba tanlangan
        if (!empty($this->filters['student_id'])) {
            return 1;
        }

        // Guruh tanlangan
        if (!empty($this->filters['group_id'])) {
            return $query->where('group_id', $this->filters['group_id'])->count();
        }

        // Kurator tanlangan
        if (!empty($this->filters['kurator_id'])) {
            return $query->whereHas('group', function ($q) {
                $q->where('kurator_id', $this->filters['kurator_id']);
            })->count();
        }

        // Kafedra tanlangan
        if (!empty($this->filters['kafedra_id'])) {
            return $query->whereHas('group.kurator', function ($q) {
                $q->where('kafedra_id', $this->filters['kafedra_id']);
            })->count();
        }

        // Dekan tanlangan
        if (!empty($this->filters['dekan_id'])) {
            return $query->whereHas('group.kurator.kafedra', function ($q) {
                $q->where('dekan_id', $this->filters['dekan_id']);
            })->count();
        }

        // Hech narsa tanlanmagan - barcha talabalar
        return $query->count();
    }

    /**
     * Qaysi daraja tanlangan
     */
    public function getFilterLevel(): string
    {
        if (!empty($this->filters['student_id'])) {
            return 'Tanlangan talaba';
        }
        if (!empty($this->filters['group_id'])) {
            return 'Guruhdagi talabalar';
        }
        if (!empty($this->filters['kurator_id'])) {
            return 'Kurator talabalari';
        }
        if (!empty($this->filters['kafedra_id'])) {
            return 'Kafedra talabalari';
        }
        if (!empty($this->filters['dekan_id'])) {
            return 'Fakultet talabalari';
        }
        return 'Barcha talabalar';
    }
}
