<?php

use App\Models\TradeConfig;
use App\Services\TradeService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote');

// Schedule::call(function () {
//     TradeService::processDailyProfit();
// })->everyMinute();

Schedule::call(function () {
    // skip weekend
    if (now()->isWeekend()) {
        return;
    }

    $config = TradeConfig::first();
    if (!$config || !$config->profit_time) {
        return;
    }

    $now = now();

    $profitTime = Carbon\Carbon::createFromFormat(
        'H:i:s',
        $config->profit_time,
        config('app.timezone')
    );

    if (!$now->between(
        $profitTime->copy()->startOfMinute(),
        $profitTime->copy()->endOfMinute()
    )) {
        return;
    }

    $today = now()->toDateString();

    if (cache()->get('profit_ran_' . $today)) {
        return;
    }

    TradeService::processDailyProfit();

    cache()->put(
        'profit_ran_' . $today,
        true,
        now()->endOfDay()
    );
})->everyMinute();
