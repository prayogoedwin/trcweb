<?php

namespace App\Filament\Resources\RiwayatMembers\Pages;

use App\Filament\Resources\RiwayatMembers\RiwayatMemberResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRiwayatMember extends EditRecord
{
    protected static string $resource = RiwayatMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
