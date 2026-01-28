<?php

namespace App\Filament\Resources\Students\Tables;

use App\Enums\PaymentType;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('full_name')
                    ->label('F.I.Sh')
                    ->searchable(),

                TextColumn::make('JSHSHR')
                    ->label('JSHSHR')
                    ->searchable(),

                TextColumn::make('group.title')
                    ->label('Guruh')
                    ->searchable(),

                TextColumn::make('contract_percent')
                    ->label("Kontrakt (%)")
                    ->state(function ($record) {
                        $contractPrice = $record->group?->contract_price ?? 0;

                        if ($contractPrice == 0) {
                            return '0%';
                        }

                        $paid = $record->payments->sum(function ($payment) {
                            return $payment->type === PaymentType::PLUS
                                ? $payment->amount
                                : -$payment->amount;
                        });
                        $percent = ($paid / $contractPrice) * 100;
                        return number_format(max($percent, 0), 1) . '%';
                    })
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('created_at')
                    ->label('Yaratilgan sana')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()->button(),
            ])
            ->toolbarActions([
                //
            ]);
    }
}
