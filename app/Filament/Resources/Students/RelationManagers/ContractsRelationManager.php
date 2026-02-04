<?php

namespace App\Filament\Resources\Students\RelationManagers;

use App\Models\ContractType;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContractsRelationManager extends RelationManager
{
    protected static string $relationship = 'contracts';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('contract_type_id')
                ->label('Contract Type')
                ->relationship('contractType', 'title')
                ->searchable()
                ->preload()
                ->required(),

            TextInput::make('amount')
                ->label('Amount')
                ->numeric()
                ->required(),

            Toggle::make('is_completed')
                ->label('Completed')
                ->default(false)
                ->reactive(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('contractType.title')
                    ->label('Contract Type')
                    ->searchable(),

                TextColumn::make('amount')
                    ->label('Amount')
                    ->money('UZS'),

                IconColumn::make('is_completed')
                    ->label('Completed')
                    ->boolean(),

                TextColumn::make('completed_at')
                    ->label('Completed At')
                    ->dateTime(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
