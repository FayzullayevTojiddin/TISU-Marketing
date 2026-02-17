<?php

namespace App\Filament\Resources\Kurators\RelationManagers;

use App\Enums\GroupType;
use App\Filament\Resources\Groups\GroupResource;
use Filament\Actions\Action;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GroupsRelationManager extends RelationManager
{
    protected static string $relationship = 'groups';

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
            ->recordTitleAttribute('title')
            ->columns([

                TextColumn::make('title')
                    ->label('Guruh')
                    ->alignCenter()
                    ->searchable(),

                TextColumn::make('kurator.user.name')
                    ->label("Kurator F.I.SH")
                    ->alignCenter(),

                TextColumn::make('students_count')
                    ->label('Talabalar')
                    ->counts('students')
                    ->alignCenter(),
            ])
            ->headerActions([

            ])
            ->recordActions([
                Action::make('open_group')
                    ->label('Guruhga o‘tish')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn ($record) => GroupResource::getUrl('edit', [
                        'record' => $record->getKey(),
                    ]))
                    ->button()
                    ->openUrlInNewTab()
            ]);
    }
}
