<?php

namespace App\Filament\Resources\Groups\Tables;

use App\Enums\GroupType;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class GroupsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Guruh nomi')
                    ->searchable(),

                TextColumn::make('type')
                    ->label('Taʼlim turi')
                    ->formatStateUsing(fn ($state) => $state?->label())
                    ->sortable(),

                TextColumn::make('kurator.user.name')
                    ->label('Kurator')
                    ->searchable(),

                TextColumn::make('students_count')
                    ->label('Talabalar')
                    ->counts('students')
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('contract_price')
                    ->label('Kontrakt narxi')
                    ->money('UZS')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Yaratilgan sana')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->button(),
            ])
            ->toolbarActions([
                //
            ]);
    }
}
