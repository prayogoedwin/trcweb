<?php

namespace App\Filament\Resources\Wallets\Schemas;

use App\Models\Member;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class WalletForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('member_id')
                    ->label('Member')
                    ->options(Member::query()->pluck('name', 'id'))
                    ->searchable(),
                Select::make('type')
                    ->options(['topup' => 'Topup', 'withdraw' => 'Withdraw'])
                    ->required(),
                TextInput::make('nominal')
                    ->prefix('Rp.')
                    ->required(),
                Select::make('status')
                    ->options([
                        '0' => 'Tolak/Belum Verifikasi',
                        '1' => 'Terverifikasi',
                    ]),
                TextInput::make('metode_pembayaran'),
            ]);
    }
}
