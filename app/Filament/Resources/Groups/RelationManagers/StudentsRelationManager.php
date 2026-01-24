<?php

namespace App\Filament\Resources\Groups\RelationManagers;

use App\Filament\Resources\Students\StudentResource;
use Filament\Actions\Action;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class StudentsRelationManager extends RelationManager
{
    protected static string $relationship = 'students';

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
            ->recordTitleAttribute('full_name')
            ->columns([

                TextColumn::make('full_name')
                    ->label('F.I.Sh')
                    ->searchable(),

                TextColumn::make('JSHSHR')
                    ->label('JSHSHR'),

                IconColumn::make('status')
                    ->label('Holati')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),

                TextColumn::make('created_at')
                    ->label('Yaratilgan sana')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                Action::make('open_student')
                    ->label('Talabaga o‘tish')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn ($record) => StudentResource::getUrl('edit', [
                        'record' => $record->getKey(),
                    ]))
                    ->openUrlInNewTab()
                    ->button(),
            ])
            ->paginated(false);
    }
}
