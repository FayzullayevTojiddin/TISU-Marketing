<?php

namespace App\Filament\Resources\StudentContracts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class StudentContractsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('student.full_name')
                    ->label('Talaba')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('contractType.title')
                    ->label('Shartnoma turi')
                    ->sortable(),

                TextColumn::make('remaining_amount')
                    ->label('Qolgan')
                    ->money('UZS')
                    ->state(fn ($record) => $record->remaining_amount)
                    ->color(fn ($record) =>
                        $record->remaining_amount > 0 ? 'danger' : 'success'
                    ),

                IconColumn::make('is_completed')
                    ->label('Yakunlangan')
                    ->boolean(),

                TextColumn::make('completed_at')
                    ->label('Yakunlangan sana')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_completed')
                    ->label('Yakunlangan'),

                Filter::make('fully_paid')
                    ->label('To‘liq to‘langan')
                    ->query(fn ($query) =>
                        $query->whereHas('payments', function ($q) {
                            $q->selectRaw('student_contract_id, SUM(amount) as total')
                              ->groupBy('student_contract_id');
                        })
                    ),
            ])
            ->recordActions([
                EditAction::make()->button(),
            ])
            ->toolbarActions([
                //
            ])
            ->defaultSort('id', 'desc');
    }
}
