<?php

namespace App\Filament\Resources\Dekans\Tables;

use App\Models\Student;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class DekansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Fakultet')
                    ->default('-'),

                TextColumn::make('kafedras_count')
                    ->label('Kafedralar')
                    ->counts('kafedras')
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('kurators_count')
                    ->label('Kuratorlar')
                    ->getStateUsing(fn ($record) =>
                        $record->kafedras()
                            ->withCount('kurators')
                            ->get()
                            ->sum('kurators_count')
                    )
                    ->alignCenter(),

                TextColumn::make('groups_count')
                    ->label('Guruhlar')
                    ->getStateUsing(fn ($record) =>
                        $record->kafedras()
                            ->withCount('groups')
                            ->get()
                            ->sum('groups_count')
                    )
                    ->alignCenter(),

                TextColumn::make('students_count')
                    ->label('Talabalar')
                    ->getStateUsing(fn ($record) =>
                        Student::whereHas('group.kafedra', fn ($q) =>
                            $q->where('dekan_id', $record->id)
                        )->count()
                    )
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
