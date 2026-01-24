<?php

namespace App\Filament\Resources\TradeConfigs\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class TradeConfigForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('min_modal')->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->prefix('Rp')->required(),
                TextInput::make('max_modal')->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->prefix('Rp')->required(),
                TextInput::make('profit_percent')->required(),
                TextInput::make('cancel_fee_percent')->required(),
                TimePicker::make('profit_time')->required(),
                Toggle::make('is_active')->required(),
            ]);
    }
}
