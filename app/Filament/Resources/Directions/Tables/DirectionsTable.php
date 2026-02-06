<?php

namespace App\Filament\Resources\Directions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DirectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Nomi')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('code')
                    ->label('Kod')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('contract_price')
                    ->label('Kontrakt narxi')
                    ->sortable(),

                TextColumn::make('groups_count')
                    ->label('Guruhlar soni')
                    ->counts('groups')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Yaratilgan')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()->iconButton(),
                DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
