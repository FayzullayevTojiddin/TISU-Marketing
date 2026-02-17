<?php

namespace App\Filament\Resources\Kafedras\RelationManagers;

use App\Filament\Resources\Kurators\KuratorResource;
use App\Models\Student;
use Filament\Actions\Action;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KuratorsRelationManager extends RelationManager
{
    protected static string $relationship = 'kurators';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([

                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('groups_count')
                    ->label('Guruhlar')
                    ->counts('groups')
                    ->alignCenter(),

                TextColumn::make('students_count')
                    ->label('Talabalar')
                    ->getStateUsing(fn ($record) =>
                        Student::whereHas('group', fn ($q) =>
                            $q->where('kurator_id', $record->id)
                        )->count()
                    )
                    ->alignCenter(),

                TextColumn::make('created_at')
                    ->label('Yaratilgan sana')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                Action::make('open_kurator')
                    ->label('Kuratorga o‘tish')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn ($record) => KuratorResource::getUrl('edit', [
                        'record' => $record,
                    ]))
                    ->openUrlInNewTab()
                    ->button(),
            ]);
    }
}
