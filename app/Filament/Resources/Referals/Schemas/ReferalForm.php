<?php

namespace App\Filament\Resources\Referals\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ReferalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nominal')
                    ->required()
                    ->numeric()
                    ->prefix('Rp.'),
            ]);
    }
}
