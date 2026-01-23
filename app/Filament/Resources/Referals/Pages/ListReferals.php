<?php

namespace App\Filament\Resources\Referals\Pages;

use App\Filament\Resources\Referals\ReferalResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReferals extends ListRecords
{
    protected static string $resource = ReferalResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         CreateAction::make(),
    //     ];
    // }
}
