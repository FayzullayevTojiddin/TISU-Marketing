<?php

namespace App\Filament\Resources\Kafedras;

use App\Filament\Resources\Kafedras\Pages\CreateKafedra;
use App\Filament\Resources\Kafedras\Pages\EditKafedra;
use App\Filament\Resources\Kafedras\Pages\ListKafedras;
use App\Filament\Resources\Kafedras\RelationManagers\KuratorsRelationManager;
use App\Filament\Resources\Kafedras\Schemas\KafedraForm;
use App\Filament\Resources\Kafedras\Tables\KafedrasTable;
use App\Models\Kafedra;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class KafedraResource extends Resource
{
    protected static ?string $model = Kafedra::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingOffice2;

    protected static ?int $navigationSort = 3;

    protected static string | UnitEnum | null $navigationGroup = "Tizim";

    protected static ?string $navigationLabel = 'Kafedralar';

    protected static ?string $pluralModelLabel = 'Kafedralar';

    protected static ?string $modelLabel = 'Kafedra';

    public static function form(Schema $schema): Schema
    {
        return KafedraForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KafedrasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            KuratorsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListKafedras::route('/'),
            'create' => CreateKafedra::route('/create'),
            'edit' => EditKafedra::route('/{record}/edit'),
        ];
    }
}
