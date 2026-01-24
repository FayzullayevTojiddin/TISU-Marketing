<?php

namespace App\Filament\Resources\Dekans;

use App\Filament\Resources\Dekans\Pages\CreateDekan;
use App\Filament\Resources\Dekans\Pages\EditDekan;
use App\Filament\Resources\Dekans\Pages\ListDekans;
use App\Filament\Resources\Dekans\RelationManagers\KafedrasRelationManager;
use App\Filament\Resources\Dekans\Schemas\DekanForm;
use App\Filament\Resources\Dekans\Tables\DekansTable;
use App\Models\Dekan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DekanResource extends Resource
{
    protected static ?string $model = Dekan::class;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::AcademicCap;
    protected static ?int $navigationSort = 2;

    protected static string | UnitEnum | null $navigationGroup = "Tizim";

    protected static ?string $navigationLabel = 'Dekanlar';

    protected static ?string $pluralModelLabel = 'Dekanlar';

    protected static ?string $modelLabel = 'Dekan';

    public static function form(Schema $schema): Schema
    {
        return DekanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DekansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            KafedrasRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDekans::route('/'),
            'create' => CreateDekan::route('/create'),
            'edit' => EditDekan::route('/{record}/edit'),
        ];
    }
}
