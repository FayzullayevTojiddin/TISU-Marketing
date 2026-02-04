<?php

namespace App\Filament\Resources\StudentContracts;

use App\Filament\Resources\StudentContracts\Pages\CreateStudentContract;
use App\Filament\Resources\StudentContracts\Pages\EditStudentContract;
use App\Filament\Resources\StudentContracts\Pages\ListStudentContracts;
use App\Filament\Resources\StudentContracts\Schemas\StudentContractForm;
use App\Filament\Resources\StudentContracts\Tables\StudentContractsTable;
use App\Models\StudentContract;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class StudentContractResource extends Resource
{
    protected static ?string $model = StudentContract::class;

    protected static ?int $navigationSort = 1;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::DocumentText;

    protected static string | UnitEnum | null $navigationGroup = "Shartnomalar";

    protected static ?string $navigationLabel = 'Talablarning shartnomalari';

    protected static ?string $pluralModelLabel = 'Talablarning shartnomalari';

    protected static ?string $modelLabel = 'Talablarning shartnomasi';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withSum('payments', 'amount');
    }

    public static function form(Schema $schema): Schema
    {
        return StudentContractForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StudentContractsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStudentContracts::route('/'),
            'create' => CreateStudentContract::route('/create'),
            'edit' => EditStudentContract::route('/{record}/edit'),
        ];
    }
}
