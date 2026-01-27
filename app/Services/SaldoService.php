<?php

namespace App\Services;

use App\Models\Wallet;
use App\Models\Trade;
use App\Models\Member;

class SaldoService
{
    /**
     * Saldo REAL yang bisa dipakai user
     */
    public static function getSaldo(Member $member): float
    {
        $masuk = Wallet::where('member_id', $member->id)
            ->where('status', 1)
            ->whereIn('type', ['topup', 'profit'])
            ->sum('nominal');

        $keluar = Wallet::where('member_id', $member->id)
            ->where('status', 1)
            ->where('type', 'withdraw')
            ->sum('nominal');

        return $masuk - $keluar;
    }
}
