<?php

namespace App\Filament\Resources\Referals\Pages;

use App\Filament\Resources\Referals\ReferalResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditReferal extends EditRecord
{
    protected static string $resource = ReferalResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         DeleteAction::make(),
    //     ];
    // }
}
