<?php

namespace App\Filament\Resources\TradeConfigs\Pages;

use App\Filament\Resources\TradeConfigs\TradeConfigResource;
use App\Models\TradeConfig;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTradeConfigs extends ListRecords
{
    protected static string $resource = TradeConfigResource::class;

    protected function getHeaderActions(): array
    {
        if (TradeConfig::count() >= 1) {
            return [];
        }

        return [
            CreateAction::make(),
        ];
    }
}
