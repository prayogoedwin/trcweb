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
        // total masuk
        $topup = Wallet::where('member_id', $member->id)
            ->where('type', 'topup')
            ->where('status', 1)
            ->sum('nominal');

        $profit = Wallet::where('member_id', $member->id)
            ->where('type', 'profit')
            ->where('status', 1)
            ->sum('nominal');

        // total keluar
        $withdraw = Wallet::where('member_id', $member->id)
            ->where('type', 'withdraw')
            ->where('status', 1)
            ->sum('nominal');

        // modal yang sedang dikunci
        $modalAktif = Trade::where('member_id', $member->id)
            ->where('status', 'active')
            ->sum('modal');

        return ($topup + $profit) - $withdraw - $modalAktif;
    }
}
