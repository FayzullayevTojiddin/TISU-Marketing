<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Talaba maʼlumotlari')
                    ->schema([

                        TextInput::make('full_name')
                            ->label('F.I.Sh')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('JSHSHR')
                            ->label('JSHSHR')
                            ->required()
                            ->numeric()
                            ->length(14),

                        Select::make('status')
                            ->options([
                                true => 'Faol',
                                false => 'Nofaol',
                            ])
                            ->required(),
                    ])
                    ->columns(1),

                Section::make('Tashkiliy bog‘lanish')
                    ->schema([
                        Select::make('group_id')
                            ->label('Guruh')
                            ->relationship('group', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),
                    ]),
            ]);
    }
}
