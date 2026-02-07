<?php

namespace App\Filament\Resources\Dekans\RelationManagers;

use App\Filament\Resources\Kafedras\KafedraResource;
use App\Models\Student;
use Filament\Actions\Action;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KafedrasRelationManager extends RelationManager
{
    protected static string $relationship = 'kafedras';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Kafedra nomi')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([

                TextColumn::make('id')
                    ->label('ID'),

                TextColumn::make('title')
                    ->label('Kafedra')
                    ->searchable(),

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
            ->headerActions([
                //
            ])
            ->recordActions([
                Action::make('open_kafedra')
                    ->label('Kafedraga o\'tish')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn ($record) => KafedraResource::getUrl('edit', [
                        'record' => $record,
                    ]))
                    ->openUrlInNewTab()
                    ->iconButton(),
            ]);
    }
}
