<?php

namespace App\Filament\Resources\Directions\Schemas;

use App\Models\EducationLevel;
use App\Models\StudyForm;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class DirectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('education_level_id')
                ->label("Ta'lim darajasi")
                ->options(EducationLevel::where('status', true)->pluck('title', 'id'))
                ->searchable()
                ->preload()
                ->required()
                ->live()
                ->afterStateUpdated(function (Set $set) {
                    $set('study_form_id', null);
                })
                ->createOptionForm([
                    TextInput::make('title')
                        ->label('Nomi')
                        ->required()
                        ->maxLength(255),
                ])
                ->createOptionUsing(function (array $data): int {
                    return EducationLevel::create([
                        'title' => $data['title'],
                        'status' => true,
                    ])->id;
                })
                ->columnSpan(3),

            Select::make('study_form_id')
                ->label("Ta'lim shakli")
                ->options(function (Get $get) {
                    $educationLevelId = $get('education_level_id');
                    if (! $educationLevelId) {
                        return [];
                    }
                    return StudyForm::where('education_level_id', $educationLevelId)
                        ->where('status', true)
                        ->pluck('title', 'id');
                })
                ->searchable()
                ->preload()
                ->required()
                ->live()
                ->disabled(fn (Get $get) => ! $get('education_level_id'))
                ->createOptionForm([
                    TextInput::make('title')
                        ->label('Nomi')
                        ->required()
                        ->maxLength(255),
                ])
                ->createOptionUsing(function (array $data, Get $get): int {
                    return StudyForm::create([
                        'title' => $data['title'],
                        'education_level_id' => $get('education_level_id'),
                        'status' => true,
                    ])->id;
                })
                ->columnSpan(3),

            TextInput::make('code')
                ->label('Kod')
                ->required()
                ->maxLength(50)
                ->unique(ignoreRecord: true)
                ->columnSpan(1),

            TextInput::make('title')
                ->label("Yo'nalish nomi")
                ->required()
                ->maxLength(255)
                ->columnSpan(3),

            TextInput::make('contract_price')
                ->label('Kontrakt narxi')
                ->required()
                ->numeric()
                ->prefix('UZS')
                ->columnSpan(2),
        ])->columns(6);
    }
}
