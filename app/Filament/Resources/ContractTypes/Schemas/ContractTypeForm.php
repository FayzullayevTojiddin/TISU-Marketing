<?php

namespace App\Filament\Resources\ContractTypes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ContractTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->label('Shartnoma turi nomi')
                ->required()
                ->maxLength(255),

            FileUpload::make('base_file_path')
                ->label('Shartnoma shabloni (WORD)')
                ->directory('contract-templates')
                ->disk('local')
                ->downloadable()
                ->acceptedFileTypes([
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                ])
                ->required(),

            Repeater::make('keys')
                ->label('O‘zgaruvchilar (keys)')
                ->schema([
                    TextInput::make('label')
                        ->label('Nomi (Label)')
                        ->placeholder('Masalan: F.I.SH')
                        ->required(),

                    TextInput::make('key')
                        ->label('Kalit (Key)')
                        ->placeholder('masalan: fish')
                        ->required()
                        ->regex('/^[a-z_.]+$/')
                        ->helperText('Faqat kichik harflar va "_" ishlating'),
                ])
                ->minItems(1)
                ->collapsible()
                ->columns(2)
                ->columnSpanFull(),

            Textarea::make('description')
                ->label('Izoh')
                ->rows(3)
                ->columnSpanFull(),

            Toggle::make('status')
                ->label('Faol')
                ->default(true),
        ]);
    }
}
