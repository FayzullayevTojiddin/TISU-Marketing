<?php

namespace App\Filament\Resources\Kafedras\Tables;

use App\Models\Student;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class KafedrasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Nomi'),

                TextColumn::make('kurators_count')
                    ->label('Kuratorlar')
                    ->getStateUsing(fn ($record) =>
                        $record->kurators()->count()
                    )
                    ->alignCenter(),

                TextColumn::make('groups_count')
                    ->label('Guruhlar')
                    ->counts('groups')
                    ->alignCenter(),

                TextColumn::make('students_count')
                    ->label('Talabalar')
                    ->getStateUsing(fn ($record) =>
                        Student::whereHas('group', fn ($q) =>
                            $q->where('kafedra_id', $record->id)
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
