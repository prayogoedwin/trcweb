<?php

namespace App\Filament\Resources\RiwayatMembers\Pages;

use App\Filament\Resources\RiwayatMembers\RiwayatMemberResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRiwayatMembers extends ListRecords
{
    protected static string $resource = RiwayatMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
