<?php

namespace App\Filament\Resources\Kurators\Tables;

use App\Models\Student;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class KuratorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('F.I.SH')
                    ->searchable(),

                TextColumn::make('groups_count')
                    ->label('Guruhlar')
                    ->counts('groups')
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('students_count')
                    ->label('Talabalar')
                    ->getStateUsing(fn ($record) =>
                        Student::whereHas('group', fn ($q) =>
                            $q->where('kurator_id', $record->id)
                        )->count()
                    )
                    ->alignCenter(),

                ToggleColumn::make('user.status')
                    ->label('Status')
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
                EditAction::make()
                    ->iconButton(),
            ])
            ->toolbarActions([
                //
            ]);
    }
}
