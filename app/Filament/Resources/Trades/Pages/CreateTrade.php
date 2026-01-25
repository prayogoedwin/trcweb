<?php

namespace App\Filament\Resources\Trades\Pages;

use App\Filament\Resources\Trades\TradeResource;
use App\Models\Member;
use App\Services\TradeService;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateTrade extends CreateRecord
{
    protected static string $resource = TradeResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $member = Member::find($data['member_id']);
        return TradeService::createTrade($member, $data['modal']);
    }
}
