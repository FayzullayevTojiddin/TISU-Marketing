<?php

namespace App\Filament\Resources\StudentContracts\Schemas;

use App\Models\ContractType;
use App\Models\Student;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Arr;

class StudentContractForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('student_id')
                ->label('Talaba')
                ->relationship('student', 'full_name')
                ->searchable()
                ->required()
                ->live(),

            Select::make('contract_type_id')
                ->label('Shartnoma turi')
                ->options(
                    ContractType::query()
                        ->where('status', true)
                        ->pluck('title', 'id')
                )
                ->searchable()
                ->required()
                ->live()
                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        if (! $state) {
                            $set('data', []);
                            return;
                        }

                        $contractType = ContractType::find($state);

                        if (! $contractType) {
                            $set('data', []);
                            return;
                        }

                        $relations = collect($contractType->keys)
                            ->pluck('key')
                            ->filter(fn ($key) => str_contains($key, '.'))
                            ->map(fn ($key) => explode('.', $key)[0])
                            ->unique()
                            ->values()
                            ->toArray();

                        $student = Student::with($relations)->find($get('student_id'));

                        $items = [];

                        foreach ($contractType->keys as $item) {
                            $key = $item['key'];

                            $items[] = [
                                'label' => $item['label'],
                                'key' => $key,
                                'value' => self::resolveValue($student, $key),
                            ];
                        }

                        $set('data', $items);
                    }),

            TextInput::make('amount')
                ->label('Shartnoma summasi')
                ->numeric()
                ->required(),

            Repeater::make('data')
                ->label('Shartnoma maʼlumotlari')
                ->schema([
                    TextInput::make('label')
                        ->label('Nomi')
                        ->disabled()
                        ->dehydrated(),

                    TextInput::make('key')
                        ->label('Kalit')
                        ->disabled()
                        ->dehydrated(),

                    TextInput::make('value')
                        ->label('Qiymat')
                        ->required(),
                ])
                ->visible(fn (callable $get) => filled($get('contract_type_id')))
                ->columns(3)
                ->columnSpanFull(),
        ])
        ->columns(3);
    }

    private static function resolveValue(?object $model, string $key): mixed
    {
        if (! $model) {
            return null;
        }

        $segments = explode('.', $key);
        $value = $model;

        foreach ($segments as $segment) {
            if (! $value) {
                return null;
            }

            $value = $value->{$segment} ?? null;
        }

        return $value;
    }
}
