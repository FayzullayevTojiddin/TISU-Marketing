<?php

namespace App\Filament\Resources\Kurators\RelationManagers;

use App\Enums\GroupType;
use App\Filament\Resources\Groups\GroupResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
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

                TextInput::make('title')
                    ->label('Guruh nomi')
                    ->required()
                    ->maxLength(255),

                Select::make('type')
                    ->label('Taʼlim turi')
                    ->options(GroupType::options())
                    ->required(),

                TextInput::make('contract_price')
                    ->label('Kontrakt narxi')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([

                TextColumn::make('title')
                    ->label('Guruh')
                    ->searchable(),

                TextColumn::make('type')
                    ->label('Taʼlim turi')
                    ->formatStateUsing(fn ($state) => $state?->label()),

                TextColumn::make('students_count')
                    ->label('Talabalar')
                    ->counts('students')
                    ->alignCenter(),

                TextColumn::make('contract_price')
                    ->label('Kontrakt')
                    ->money('UZS'),

                TextColumn::make('created_at')
                    ->label('Yaratilgan sana')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
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
