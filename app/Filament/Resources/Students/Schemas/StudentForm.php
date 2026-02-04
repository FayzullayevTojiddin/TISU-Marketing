<?php

namespace App\Filament\Resources\Students\Schemas;

use App\Models\Group;
use Filament\Forms\Components\Placeholder;
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
                            ->maxLength(255)
                            ->columnSpan(3),

                        TextInput::make('JSHSHR')
                            ->label('JSHSHR')
                            ->required()
                            ->numeric()
                            ->length(14)
                            ->columnSpan(3),

                        Select::make('sex')
                            ->label('Jinsi')
                            ->options([
                                'male' => 'Erkak',
                                'female' => 'Ayol',
                            ])
                            ->required()
                            ->columnSpan(2),

                        TextInput::make('nationality')
                            ->label('Millati')
                            ->required()
                            ->columnSpan(2),

                        Select::make('status')
                            ->label('Holati')
                            ->options([
                                true => 'Faol',
                                false => 'Nofaol',
                            ])
                            ->required()
                            ->columnSpan(2),
                    ])
                    ->columns(6),

                Section::make('O‘qish maʼlumotlari')
                    ->schema([
                        Select::make('group_id')
                            ->label('Guruh')
                            ->relationship('group', 'title')
                            ->searchable()
                            ->preload()
                            ->reactive()
                            ->required(),

                        Placeholder::make('contract_price')
                            ->label('Kontrakt narxi')
                            ->content(function (callable $get) {
                                $groupId = $get('group_id');

                                if (! $groupId) {
                                    return '—';
                                }

                                return number_format(
                                    Group::find($groupId)?->contract_price ?? 0,
                                    0,
                                    '.',
                                    ' '
                                ) . " so'm";
                            })
                            ->visible(fn (callable $get) => filled($get('group_id')))
                            ->alignCenter(),
                    ])
                    ->columns(1),

                Section::make('additional')
                    ->label("Qo'shimcha Ma'lumotlar")
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        Section::make('Manzil maʼlumotlari')
                            ->schema([
                                TextInput::make('from.region')
                                    ->label('Tug‘ilgan viloyat'),

                                TextInput::make('from.city')
                                    ->label('Tug‘ilgan shahar/tuman'),

                                TextInput::make('lives.region')
                                    ->label('Yashash viloyati'),

                                TextInput::make('lives.address')
                                    ->label('Yashash manzili'),

                                TextInput::make('passport_address')
                                    ->label('Passport bo‘yicha manzil')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),
                    ])
            ]);
    }
}
