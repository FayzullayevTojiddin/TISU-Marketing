<?php

namespace App\Filament\Resources\Kafedras\Schemas;

use App\Models\User;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;

class KafedraForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Kafedra foydalanuvchisi')
                    ->schema([
                        TextInput::make('user.name')
                            ->label('Ism familiya')
                            ->required(),

                        TextInput::make('user.email')
                            ->label('Email')
                            ->email()
                            ->required(),

                        TextInput::make('user.password')
                            ->label('Parol')
                            ->password()
                            ->required()
                            ->dehydrateStateUsing(fn ($state) => bcrypt($state))
                            ->columnSpanFull(),

                        Hidden::make('user.role')
                            ->default('kafedra'),
                    ])
                    ->columns(2),

                Section::make('Kafedra maʼlumotlari')
                    ->schema([
                        Select::make('dekan_id')
                            ->label('Dekan')
                            ->relationship('dekan', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('title')
                            ->label('Kafedra nomi')
                            ->required(),
                    ])
                    ->columns(1),
            ]);
    }
}
