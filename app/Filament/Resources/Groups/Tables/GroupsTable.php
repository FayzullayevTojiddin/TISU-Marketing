<?php

namespace App\Filament\Resources\Groups\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;

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

                TextColumn::make('educationLevel.title')
                    ->label('Bosqich')
                    ->sortable(),

                TextColumn::make('studyForm.title')
                    ->label('Ta`lim turi')
                    ->sortable(),

                TextColumn::make('direction.title')
                    ->label('Yo`nalish')
                    ->sortable(),

                TextColumn::make('students_count')
                    ->label('Talabalarning soni')
                    ->counts('students')
                    ->alignCenter()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('education_level_id')
                    ->label('Bosqich')
                    ->relationship('educationLevel', 'title')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('study_form_id')
                    ->label('Taʼlim turi')
                    ->relationship('studyForm', 'title')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('direction_id')
                    ->label('Yoʻnalish')
                    ->relationship('direction', 'title')
                    ->searchable()
                    ->preload(),
            ])
            ->filtersLayout(FiltersLayout::AboveContent)
            ->filtersFormColumns(3)
            ->filtersApplyAction(fn ($action) => $action->hidden())
            ->recordActions([
                EditAction::make()
                    ->button(),
            ])
            ->toolbarActions([
                //
            ]);
    }
}
