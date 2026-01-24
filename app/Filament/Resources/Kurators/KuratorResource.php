<?php

namespace App\Filament\Resources\Kurators;

use App\Filament\Resources\Kurators\Pages\CreateKurator;
use App\Filament\Resources\Kurators\Pages\EditKurator;
use App\Filament\Resources\Kurators\Pages\ListKurators;
use App\Filament\Resources\Kurators\RelationManagers\GroupsRelationManager;
use App\Filament\Resources\Kurators\Schemas\KuratorForm;
use App\Filament\Resources\Kurators\Tables\KuratorsTable;
use App\Models\Kurator;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class KuratorResource extends Resource
{
    protected static ?string $model = Kurator::class;

    protected static ?int $navigationSort = 4;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::UserGroup;

    protected static string | UnitEnum | null $navigationGroup = "Tizim";

    protected static ?string $navigationLabel = 'Kuratorlar';

    protected static ?string $pluralModelLabel = 'Kuratorlar';

    protected static ?string $modelLabel = 'Kurator';

    public static function form(Schema $schema): Schema
    {
        return KuratorForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KuratorsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            GroupsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListKurators::route('/'),
            'create' => CreateKurator::route('/create'),
            'edit' => EditKurator::route('/{record}/edit'),
        ];
    }
}
