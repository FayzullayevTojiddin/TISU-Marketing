<?php

namespace App\Filament\Resources\Groups\Schemas;

use App\Models\Dekan;
use App\Models\Direction;
use App\Models\EducationLevel;
use App\Models\Kafedra;
use App\Models\Kurator;
use App\Models\StudyForm;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;

class GroupForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Tashkiliy bog'lanish")
                    ->schema([
                        Select::make('dekan_id')
                            ->label('Dekan')
                            ->options(Dekan::pluck('title', 'id'))
                            ->reactive()
                            ->dehydrated(false)
                            ->afterStateHydrated(function (callable $set, $record) {
                                if (! $record?->kafedra) return;
                                $set('dekan_id', $record->kafedra->dekan_id);
                            }),

                        Select::make('kafedra_id')
                            ->label('Kafedra')
                            ->options(fn (callable $get) =>
                                $get('dekan_id')
                                    ? Kafedra::where('dekan_id', $get('dekan_id'))->pluck('title', 'id')
                                    : []
                            )
                            ->reactive()
                            ->required(),

                        Select::make('kurator_id')
                            ->label('Kurator')
                            ->relationship('kurator', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name)
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                Section::make("Guruh ma'lumotlari")
                    ->schema([
                        TextInput::make('title')
                            ->label('Guruh nomi')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('enrollment_year')
                            ->label('Qabul yili')
                            ->numeric()
                            ->minValue(2000)
                            ->maxValue(now()->year + 1)
                            ->required(),
                    ])
                    ->columns(2),

                Section::make("Ta'lim parametrlari")
                    ->schema([
                        Select::make('education_level_id')
                            ->label("Ta'lim darajasi")
                            ->options(EducationLevel::pluck('title', 'id'))
                            ->reactive()
                            ->dehydrated(false)
                            ->afterStateHydrated(function (callable $set, $record) {
                                if (! $record?->direction?->studyForm) return;
                                $set('education_level_id', $record->direction->studyForm->education_level_id);
                            }),

                        Select::make('study_form_id')
                            ->label("Ta'lim shakli")
                            ->options(fn (callable $get) =>
                                $get('education_level_id')
                                    ? StudyForm::where('education_level_id', $get('education_level_id'))->pluck('title', 'id')
                                    : []
                            )
                            ->reactive()
                            ->dehydrated(false)
                            ->afterStateHydrated(function (callable $set, $record) {
                                if (! $record?->direction) return;
                                $set('study_form_id', $record->direction->study_form_id);
                            }),

                        Select::make('direction_id')
                            ->label("Yo'nalish")
                            ->options(fn (callable $get) =>
                                $get('study_form_id')
                                    ? Direction::where('study_form_id', $get('study_form_id'))->pluck('title', 'id')
                                    : []
                            )
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])
                    ->columns(1),
            ])
            ->columns(2);
    }
}
