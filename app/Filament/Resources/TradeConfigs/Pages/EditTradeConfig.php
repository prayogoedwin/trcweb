<?php

namespace App\Filament\Resources\TradeConfigs\Pages;

use App\Filament\Resources\TradeConfigs\TradeConfigResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTradeConfig extends EditRecord
{
    protected static string $resource = TradeConfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
