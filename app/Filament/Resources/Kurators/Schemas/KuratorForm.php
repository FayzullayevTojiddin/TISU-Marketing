<?php

namespace App\Filament\Resources\Kurators\Schemas;

use App\Models\Dekan;
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
                            ->required()
                            ->maxLength(255)
                            ->afterStateHydrated(function (callable $set, $record) {
                                if (!$record?->user) return;

                                $set('user.name', $record->user->name);
                            }),

                        TextInput::make('user.email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->afterStateHydrated(function (callable $set, $record) {
                                if (!$record?->user) return;

                                $set('user.email', $record->user->email);
                            })
                            ->unique(
                                table: 'users',
                                column: 'email',
                                ignorable: fn ($record) => $record?->user
                            ),

                        TextInput::make('user.password')
                            ->label('Parol')
                            ->password()
                            ->required()
                            ->dehydrateStateUsing(fn ($state) => bcrypt($state))
                            ->columnSpanFull()
                            ->hiddenOn('edit'),

                        Hidden::make('user.role')
                            ->default('kurator'),
                    ])
                    ->columns(2),

                Section::make('Tashkiliy bog‘lanish')
                    ->schema([
                        Select::make('dekan_id')
                            ->label('Dekan')
                            ->options(Dekan::pluck('title', 'id'))
                            ->reactive()
                            ->required()
                            ->afterStateHydrated(function (callable $set, $record) {
                                if (!$record?->kafedra) return;
                                $set('dekan_id', $record->kafedra->dekan_id);
                            })
                            ->afterStateUpdated(fn (callable $set) => $set('kafedra_id', null)),

                        Select::make('kafedra_id')
                            ->label('Kafedra')
                            ->relationship(
                                'kafedra',
                                'title',
                                fn ($query, callable $get) =>
                                    $get('dekan_id')
                                        ? $query->where('dekan_id', $get('dekan_id'))
                                        : $query
                            )
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }
}
