<?php

namespace App\Filament\Resources\Students\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StatusesRelationManager extends RelationManager
{
    protected static string $relationship = 'statuses';

    protected static ?string $title = 'Holatlar';

    protected static ?string $emptyStateHeading = 'Talabaning holatlari mavjud emas';
    protected static ?string $emptyStateDescription = 'Boshlash uchun talaba holatini qo‘shing';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Textarea::make('description')
                ->label('Holat tavsifi')
                ->required()
                ->maxLength(1000)
                ->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('description')
                    ->label('Holat')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Yaratilgan vaqti')
                    ->dateTime('d.m.Y H:i'),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make()->button(),
                DeleteAction::make()->button(),
            ]);
    }
}
