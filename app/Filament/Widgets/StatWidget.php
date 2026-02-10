<?php

namespace App\Filament\Widgets;

use App\Services\SaldoService;
use App\Services\TradeService;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Saldo Lisensi EA', 'Rp ' . number_format(TradeService::getTradeAktif(), 0)),
            Stat::make('Total Saldo Akun', 'Rp ' . number_format(SaldoService::getSaldo(), 0)),
            Stat::make('Total Saldo WD', 'Rp ' . number_format(SaldoService::getSaldoWd(), 0)),
        ];
    }
}
