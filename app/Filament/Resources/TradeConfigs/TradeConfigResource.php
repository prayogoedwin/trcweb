<?php

namespace App\Filament\Resources\TradeConfigs;

use App\Filament\Resources\TradeConfigs\Pages\CreateTradeConfig;
use App\Filament\Resources\TradeConfigs\Pages\EditTradeConfig;
use App\Filament\Resources\TradeConfigs\Pages\ListTradeConfigs;
use App\Filament\Resources\TradeConfigs\Schemas\TradeConfigForm;
use App\Filament\Resources\TradeConfigs\Tables\TradeConfigsTable;
use App\Models\TradeConfig;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TradeConfigResource extends Resource
{
    protected static ?string $model = TradeConfig::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | \UnitEnum | null $navigationGroup = 'Trade';
    protected static ?string $recordTitleAttribute = 'TradeConfig';

    public static function form(Schema $schema): Schema
    {
        return TradeConfigForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TradeConfigsTable::configure($table);
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
            'index' => ListTradeConfigs::route('/'),
            'create' => CreateTradeConfig::route('/create'),
            'edit' => EditTradeConfig::route('/{record}/edit'),
        ];
    }
}
