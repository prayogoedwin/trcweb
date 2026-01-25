<?php

namespace App\Filament\Resources\Trades\Schemas;

use App\Models\Member;
use App\Services\SaldoService;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;

class TradeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('member_id')
                    ->label('Member')
                    ->options(Member::query()->pluck('name', 'id'))
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(function ($state, Set $set) {
                        if (!$state) {
                            $set('saldo', null);
                            return;
                        }
                        $member = Member::find($state);
                        $saldo = SaldoService::getSaldo($member);
                        $set('saldo', $saldo);
                    })
                    ->required(),

                // 🔥 SALDO TAMPIL (READ ONLY)
                TextInput::make('saldo')
                    ->label('Saldo Tersedia')
                    ->disabled()
                    ->numeric()
                    ->dehydrated(false)
                    ->formatStateUsing(fn(Get $get) => 'Rp ' . number_format($get('saldo'), 0))
                    ->prefix('Rp'),
                TextInput::make('modal')
                    ->label('Modal Trade')
                    ->required()
                    ->numeric()
                    ->minValue(10000)
                    ->rule(function (Get $get) {
                        return function ($attribute, $value, $fail) use ($get) {
                            $saldo = $get('saldo');

                            if ($saldo !== null && $value > $saldo) {
                                $fail('Modal tidak boleh melebihi saldo tersedia');
                            }
                        };
                    }),
                Select::make('status')
                    ->options(['active' => 'Active', 'cancelled' => 'Cancelled', 'completed' => 'Completed'])
                    ->default('active')
                    ->required(),
            ]);
    }
}
