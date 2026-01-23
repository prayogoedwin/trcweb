<?php

namespace App\Filament\Resources\Referals;

use App\Filament\Resources\Referals\Pages\CreateReferal;
use App\Filament\Resources\Referals\Pages\EditReferal;
use App\Filament\Resources\Referals\Pages\ListReferals;
use App\Filament\Resources\Referals\Schemas\ReferalForm;
use App\Filament\Resources\Referals\Tables\ReferalsTable;
use App\Models\Referal;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ReferalResource extends Resource
{
    protected static ?string $model = Referal::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | \UnitEnum | null $navigationGroup = 'Member';

    protected static ?string $recordTitleAttribute = 'Referal';

    public static function form(Schema $schema): Schema
    {
        return ReferalForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReferalsTable::configure($table);
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
            'index' => ListReferals::route('/'),
            'create' => CreateReferal::route('/create'),
            'edit' => EditReferal::route('/{record}/edit'),
        ];
    }
}
