<?php

namespace App\Filament\Resources\Groups\Tables;

use App\Models\EducationLevel;
use App\Models\StudyForm;
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

                TextColumn::make('kurator.user.name')
                    ->label('Kurator')
                    ->sortable(),

                TextColumn::make('students_count')
                    ->label('Talabalar')
                    ->counts('students')
                    ->alignCenter()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('education_level')
                    ->label('Bosqich')
                    ->options(EducationLevel::pluck('title', 'id'))
                    ->query(fn ($query, array $data) =>
                        $data['value']
                            ? $query->whereHas('direction.studyForm', fn ($q) =>
                                $q->where('education_level_id', $data['value'])
                            )
                            : $query
                    )
                    ->searchable()
                    ->preload(),

                SelectFilter::make('study_form')
                    ->label('Ta\'lim shakli')
                    ->options(StudyForm::pluck('title', 'id'))
                    ->query(fn ($query, array $data) =>
                        $data['value']
                            ? $query->whereHas('direction', fn ($q) =>
                                $q->where('study_form_id', $data['value'])
                            )
                            : $query
                    )
                    ->searchable()
                    ->preload(),

                SelectFilter::make('direction_id')
                    ->label('Yo\'nalish')
                    ->relationship('direction', 'title')
                    ->searchable()
                    ->preload(),
            ])
            ->filtersLayout(FiltersLayout::AboveContent)
            ->filtersFormColumns(3)
            ->filtersApplyAction(fn ($action) => $action->hidden())
            ->recordActions([
                EditAction::make()
                    ->iconButton(),
            ])
            ->toolbarActions([
                //
            ]);
    }
}
