<?php

namespace App\Filament\Resources\Dekans\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Components\Section;

class DekanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Foydalanuvchi')
                    ->schema([
                        TextInput::make('user.name')
                            ->label('Ism familiya')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('user.email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),

                        TextInput::make('user.password')
                            ->label('Parol')
                            ->password()
                            ->required()
                            ->dehydrateStateUsing(fn ($state) => bcrypt($state))
                            ->hiddenOn('edit')
                            ->columnSpanFull(),

                        Hidden::make('user.role')
                            ->default('dekan'),
                    ])
                    ->columns(2),

                Section::make('Dekan maʼlumotlari')
                    ->schema([
                        TextInput::make('title')
                            ->label("Sarlavha"),
                        Hidden::make('details'),
                    ]),
            ]);
    }
}
