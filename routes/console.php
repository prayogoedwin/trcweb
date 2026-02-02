<?php

use App\Models\TradeConfig;
use App\Services\TradeService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote');

// Schedule::call(function () {
//     TradeService::processDailyProfit();
//     Log::info('Scheduler dipanggil', ['time' => now()]);
// })->everyMinute();

Schedule::call(function () {

    $now = now();

    // 1️⃣ hanya Senin (1) & Jumat (5)
    if (!in_array($now->dayOfWeekIso, [1, 5])) {
        return;
    }

    // 2️⃣ ambil config
    $config = TradeConfig::first();
    if (!$config || !$config->profit_time) {
        return;
    }

    // 3️⃣ cek jam profit
    $profitTime = Carbon\Carbon::createFromFormat(
        'H:i:s',
        $config->profit_time,
        config('app.timezone')
    )->setDate(
        $now->year,
        $now->month,
        $now->day
    );

    if (!$now->between(
        $profitTime->copy()->startOfMinute(),
        $profitTime->copy()->endOfMinute()
    )) {
        return;
    }

    // 4️⃣ cegah double run hari yg sama
    $cacheKey = 'profit_ran_' . $now->toDateString();

    if (cache()->has($cacheKey)) {
        return;
    }

    // 5️⃣ jalankan profit
    TradeService::processDailyProfit();

    // 6️⃣ tandai sudah jalan hari ini
    cache()->put(
        $cacheKey,
        true,
        $now->endOfDay()
    );
})->everyMinute();

// Schedule::call(function () {
//     // skip weekend
//     if (now()->isWeekend()) {
//         return;
//     }

//     $config = TradeConfig::first();
//     if (!$config || !$config->profit_time) {
//         return;
//     }

//     $now = now();

//     $profitTime = Carbon\Carbon::createFromFormat(
//         'H:i:s',
//         $config->profit_time,
//         config('app.timezone')
//     );

//     if (!$now->between(
//         $profitTime->copy()->startOfMinute(),
//         $profitTime->copy()->endOfMinute()
//     )) {
//         return;
//     }

//     $today = now()->toDateString();

//     if (cache()->get('profit_ran_' . $today)) {
//         return;
//     }

//     TradeService::processDailyProfit();

//     cache()->put(
//         'profit_ran_' . $today,
//         true,
//         now()->endOfDay()
//     );
// })->everyMinute();
