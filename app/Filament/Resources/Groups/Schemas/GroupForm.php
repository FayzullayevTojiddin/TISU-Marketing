<?php

namespace App\Filament\Resources\Groups\Schemas;

use App\Enums\GroupType;
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
                            ->relationship('kurator.kafedra.dekan', 'title')
                            ->searchable()
                            ->preload()
                            ->reactive()
                            ->required(),

                        Select::make('kafedra_id')
                            ->label('Kafedra')
                            ->relationship(
                                'kurator.kafedra',
                                'title',
                                fn ($query, callable $get) =>
                                    $query->where('dekan_id', $get('dekan_id'))
                            )
                            ->searchable()
                            ->preload()
                            ->reactive()
                            ->required(),

                        Select::make('kurator_id')
                            ->label('Kurator')
                            ->relationship(
                                'kurator',
                                'id',
                                fn ($query, callable $get) =>
                                    $query->where('kafedra_id', $get('kafedra_id'))
                            )
                            ->getOptionLabelFromRecordUsing(
                                fn ($record) => $record->user->name
                            )
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])
                    ->columns(1),
            ]);
    }
}
