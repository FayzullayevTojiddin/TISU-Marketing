<?php

namespace App\Filament\Resources\Kurators\Schemas;

use App\Models\User;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;

class KuratorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Kurator foydalanuvchisi')
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
                            ->default('kurator'),
                    ])
                    ->columns(2),

                Section::make('Tashkiliy bog‘lanish')
                    ->schema([
                        Select::make('dekan_id')
                            ->label('Dekan')
                            ->relationship('kafedra.dekan', 'title')
                            ->searchable()
                            ->preload()
                            ->reactive()
                            ->required(),

                        Select::make('kafedra_id')
                            ->label('Kafedra')
                            ->relationship(
                                'kafedra',
                                'title',
                                fn ($query, callable $get) =>
                                    $query->where('dekan_id', $get('dekan_id'))
                            )
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }
}
