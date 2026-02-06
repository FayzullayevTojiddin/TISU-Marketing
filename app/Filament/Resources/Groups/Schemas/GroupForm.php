<?php

namespace App\Filament\Resources\Groups\Schemas;

use App\Enums\GroupType;
use App\Models\Dekan;
use App\Models\Direction;
use App\Models\EducationLevel;
use App\Models\Kafedra;
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
                Section::make('Tashkiliy bog‘lanish')
                    ->schema([
                        Select::make('dekan_id')
                            ->label('Dekan')
                            ->options(Dekan::pluck('title', 'id'))
                            ->reactive()
                            ->required(),

                        Select::make('kafedra_id')
                            ->label('Kafedra')
                            ->options(fn (callable $get) =>
                                $get('dekan_id') ? Kafedra::where('dekan_id', $get('dekan_id'))->pluck('title', 'id') : []
                            )
                            ->reactive()
                            ->required(),

                        Select::make('kurator_id')
                            ->label('Kurator')
                            ->relationship('kurator', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name)
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
                Section::make('Guruh maʼlumotlari')
                    ->schema([
                        Section::make('Guruh maʼlumotlari')
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
                            ]),
                    ])
                    ->columns(1),

                Section::make('Taʼlim parametrlari')
                    ->schema([
                        Select::make('education_level_id')
                            ->label('Taʼlim darajasi')
                            ->options(EducationLevel::pluck('title', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('study_form_id')
                            ->label('Taʼlim shakli')
                            ->options(StudyForm::pluck('title', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('direction_id')
                            ->label('Yo‘nalish')
                            ->options(Direction::pluck('title', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])
                    ->columns(1),
            ])
            ->columns(2);
    }
}
