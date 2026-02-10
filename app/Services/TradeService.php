<?php

namespace App\Services;

use App\Models\Trade;
use App\Models\TradeConfig;
use App\Models\TradeProfit;
use App\Models\Wallet;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;

class TradeService
{
    /**
     * Trade Aktif
     */
    public static function getTradeAktif(?Member $member = null): float
    {
        return Trade::where('status', 'active')
            ->when($member, function ($query) use ($member) {
                $query->where('member_id', $member->id);
            })
            ->sum('modal');
    }

    /**
     * Membuat trade baru
     */
    public static function createTrade(Member $member, float $modal): Trade
    {
        $config = TradeConfig::where('is_active', true)->firstOrFail();

        $saldo = SaldoService::getSaldo($member);

        if ($modal < $config->min_modal || $modal > $config->max_modal) {
            throw new Exception('Nominal trade tidak valid');
        }

        if ($saldo < $modal) {
            throw new Exception('Saldo tidak mencukupi');
        }

        return DB::transaction(function () use ($member, $modal, $config) {

            // 1️⃣ kunci saldo ke wallet
            Wallet::create([
                'member_id' => $member->id,
                'type' => 'withdraw', // saldo keluar
                'nominal' => $modal,
                'status' => 1,
                'metode_pembayaran' => 'trade_lock',
            ]);

            // 2️⃣ buat trade
            return Trade::create([
                'member_id' => $member->id,
                'modal' => $modal,

                // snapshot config
                'profit_percent' => $config->profit_percent,
                'cancel_fee_percent' => $config->cancel_fee_percent,

                'status' => 'active',
                'started_at' => now(),
            ]);
        });
    }

    /**
     * Batalkan trade
     */
    public static function cancelTrade(Trade $trade): void
    {
        if ($trade->status !== 'active') {
            throw new Exception('Trade tidak bisa dibatalkan');
        }

        $fee = $trade->modal * ($trade->cancel_fee_percent / 100);
        $refund = $trade->modal - $fee;

        DB::transaction(function () use ($trade, $fee, $refund) {

            $trade->update([
                'status' => 'cancelled',
                'cancel_fee_amount' => $fee,
                'cancelled_at' => now(),
            ]);

            // potongan dicatat ke wallet
            Wallet::create([
                'member_id' => $trade->member_id,
                'type' => 'topup',
                'nominal' => $refund,
                'status' => 1,
                'metode_pembayaran' => 'trade_refund',
            ]);
        });
    }

    /**
     * Profit harian
     */
    public static function processDailyProfit(): void
    {
        $trades = Trade::where('status', 'active')->get();

        foreach ($trades as $trade) {

            $today = now()->toDateString();

            $already = TradeProfit::where('trade_id', $trade->id)
                ->whereDate('profit_date', $today)
                ->exists();

            if ($already) {
                continue;
            }

            $profit = $trade->modal * ($trade->profit_percent / 100);

            try {
                DB::transaction(function () use ($trade, $profit, $today) {

                    TradeProfit::create([
                        'trade_id' => $trade->id,
                        'member_id' => $trade->member_id,
                        'percent' => $trade->profit_percent,
                        'amount' => $profit,
                        'profit_date' => $today,
                    ]);

                    Wallet::create([
                        'member_id' => $trade->member_id,
                        'type' => 'profit',
                        'nominal' => $profit,
                        'status' => 1,
                        'metode_pembayaran' => 'trade_profit',
                    ]);

                    $trade->update([
                        'last_profit_at' => now(),
                    ]);
                });
            } catch (\Throwable $th) {
                Log::error('Profit gagal', [
                    'trade_id' => $trade->id,
                    'error' => $th->getMessage(),
                ]);
            }
        }
    }


    public static function weeklyReportByUser(int $memberId)
    {
        return TradeProfit::select([
            DB::raw('YEAR(profit_date) as year'),
            DB::raw('MONTH(profit_date) as month'),
            DB::raw('WEEK(profit_date, 1) as week'),
            DB::raw('SUM(amount) as total_profit'),
        ])
            ->where('member_id', $memberId)
            ->groupBy('year', 'month', 'week')
            ->orderByDesc('year')
            ->orderByDesc('week')
            ->get()
            ->map(function ($row) use ($memberId) {

                // 🔥 modal dari trade yang PERNAH menghasilkan profit
                $modal = Trade::where('member_id', $memberId)
                    ->whereIn(
                        'id',
                        TradeProfit::where('member_id', $memberId)
                            ->pluck('trade_id')
                    )
                    ->sum('modal');

                $roi = $modal > 0
                    ? round(($row->total_profit / $modal) * 100, 2)
                    : 0;

                $date = Carbon::now()
                    ->setISODate($row->year, $row->week);

                return [
                    'label' => sprintf(
                        'Minggu ke-%d %s %d',
                        $date->weekOfMonth,
                        $date->translatedFormat('M'),
                        $row->year
                    ),
                    'profit' => $row->total_profit,
                    'modal' => $modal,
                    'roi' => $roi,
                ];
            });
    }

    public static function listByUser(int $memberId)
    {
        return Trade::query()
            ->where('trades.member_id', $memberId)
            ->leftJoin('trade_profits', 'trades.id', '=', 'trade_profits.trade_id')
            ->select(
                'trades.id',
                'trades.created_at',
                'trades.modal',
                'trades.status',
                DB::raw('COUNT(trade_profits.id) as periode'),
                DB::raw('COALESCE(SUM(trade_profits.amount), 0) as total_profit')
            )
            ->groupBy(
                'trades.id',
                'trades.created_at',
                'trades.modal',
                'trades.status'
            )
            ->orderByDesc('trades.created_at')
            ->get()
            ->map(function ($trade) {

                $date = Carbon::parse($trade->created_at);

                return [
                    'id' => $trade->id,
                    'tanggal_masuk' => $date->format('d-m-Y'),

                    // 🔥 FORMAT PERIODE SEPERTI PROFIT
                    'periode_label' => sprintf(
                        'Minggu ke-%d %s %d',
                        $date->weekOfMonth,
                        $date->translatedFormat('M'),
                        $date->year
                    ),

                    'modal' => $trade->modal,
                    'periode' => $trade->periode,
                    'profit' => $trade->total_profit,
                    'status' => $trade->status,
                ];
            });
    }

    public static function listProfitByUser(int $memberId, int $perPage = 10)
    {
        $paginator = TradeProfit::query()
            ->where('trade_profits.member_id', $memberId)
            ->join('trades', 'trades.id', '=', 'trade_profits.trade_id')
            ->select(
                'trade_profits.id',
                'trade_profits.profit_date',
                'trade_profits.amount',
                'trades.modal'
            )
            ->orderByDesc('trade_profits.profit_date')
            ->paginate($perPage);

        // transform collection TANPA merusak paginator
        $paginator->getCollection()->transform(function ($row) {

            $roi = $row->modal > 0
                ? round(($row->amount / $row->modal) * 100, 2)
                : 0;

            return [
                'id' => $row->id,
                'tanggal' => Carbon::parse($row->profit_date)->format('d M Y'),
                'tipe' => 'Profit',
                'nominal' => $row->amount,
                'modal' => $row->modal,
                'roi' => $roi,
            ];
        });

        return $paginator;
    }
}
