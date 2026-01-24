<?php

namespace App\Filament\Resources\Students\RelationManagers;

use App\Enums\PaymentType;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    protected static ?string $title = 'To‘lovlar';

    protected static ?string $emptyStateHeading = "Talabaning to'lovlari mavjud emas";
    protected static ?string $emptyStateDescription = "Boshlash uchun talaba to'lovini qo‘shing";

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('payment')
                    ->label("To'lash")
                    ->description("Talabaning kontrakt to'lovini kiritishi")
                    ->components([
                        FileUpload::make('image')
                            ->label('To‘lov rasmi')
                            ->image()
                            ->disk('public')
                            ->directory('student-payments')
                            ->imagePreviewHeight('150')
                            ->maxSize(2048)
                            ->columnSpan(3),

                        DatePicker::make('date')
                            ->label('To‘lov sanasi')
                            ->default(now())
                            ->required(),

                        TextInput::make('amount')
                            ->label('Summa')
                            ->numeric()
                            ->required(),

                        Select::make('type')
                            ->label('To‘lov turi')
                            ->options(
                                collect(PaymentType::cases())
                                    ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
                                    ->toArray()
                            )
                            ->required(),

                        Textarea::make('description')
                            ->label('To‘lov tavsifi')
                            ->required()
                            ->maxLength(1000)
                            ->columnSpan(3),
                    ])
                    ->columns(3)
                    ->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->paginated(false)
            ->recordTitleAttribute('id')
            ->columns([

                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                ImageColumn::make('image')
                    ->label('Rasm')
                    ->disk('public')
                    ->height(40)
                    ->width(40)
                    ->circular(),

                TextColumn::make('description')
                    ->label('Tavsif')
                    ->limit(50)
                    ->wrap(),

                TextColumn::make('date')
                    ->label("To'langan vaqti")
                    ->date('d.m.Y')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Yaratilingan vaqti')
                    ->date('d.m.Y')
                    ->sortable(),
            ])
            ->headerActions([
                CreateAction::make()->label('Yangi to‘lov qo‘shish'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
