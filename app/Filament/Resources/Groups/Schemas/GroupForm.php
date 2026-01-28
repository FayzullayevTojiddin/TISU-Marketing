<?php

namespace App\Filament\Resources\Groups\Schemas;

use App\Enums\GroupType;
use App\Models\Dekan;
use App\Models\Kafedra;
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
                Section::make('Guruh maʼlumotlari')
                    ->schema([

                        TextInput::make('title')
                            ->label('Guruh nomi')
                            ->required()
                            ->maxLength(255),

                        Select::make('type')
                            ->label('Taʼlim turi')
                            ->options(GroupType::options())
                            ->required()
                            ->searchable(),

                        TextInput::make('contract_price')
                            ->label('Kontrakt narxi')
                            ->numeric()
                            ->required()
                            ->default(0),
                    ])
                    ->columns(1),

                Section::make('Tashkiliy bog‘lanish')
                    ->schema([
                        Select::make('dekan_id')
                            ->label('Dekan')
                            ->options(Dekan::pluck('title', 'id'))
                            ->reactive()
                            ->required()
                            ->afterStateHydrated(function (callable $set, $record) {
                                if (!$record?->kurator) return;
                                $set('dekan_id', $record->kurator->kafedra->dekan_id);
                            }),

                        Select::make('kafedra_id')
                            ->label('Kafedra')
                            ->options(fn (callable $get) =>
                                $get('dekan_id') ? Kafedra::where('dekan_id', $get('dekan_id'))->pluck('title', 'id') : []
                            )
                            ->reactive()
                            ->required()
                            ->afterStateHydrated(function (callable $set, $record) {
                                if (!$record?->kurator) return;
                                $set('kafedra_id', $record->kurator->kafedra_id);
                            }),

                        Select::make('kurator_id')
                            ->label('Kurator')
                            ->relationship(
                                'kurator',
                                'id',
                                fn ($query, callable $get) =>
                                    $get('kafedra_id') ? $query->where('kafedra_id', $get('kafedra_id')) : $query
                            )
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name)
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])
                    ->columns(1),
            ]);
    }
}
