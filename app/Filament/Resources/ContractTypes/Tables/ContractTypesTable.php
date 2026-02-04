<?php

namespace App\Filament\Resources\ContractTypes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContractTypesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("id")
                    ->label("ID"),

                TextColumn::make('title')
                    ->label('Shartnoma turi')
                    ->searchable()
                    ->sortable(),

                IconColumn::make('status')
                    ->label('Holati')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Yaratilgan')
                    ->dateTime()
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make()->button(),
            ])
            ->toolbarActions([
                //
            ]);
    }
}
