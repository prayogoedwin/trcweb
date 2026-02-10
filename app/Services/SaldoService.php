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
    public static function getSaldo(?Member $member = null): float
    {
        $masuk = Wallet::where('status', 1)
            ->whereIn('type', ['topup', 'profit'])
            ->when($member, function ($q) use ($member) {
                $q->where('member_id', $member->id);
            })
            ->sum('nominal');

        $keluar = Wallet::where('status', 1)
            ->where('type', 'withdraw')
            ->when($member, function ($q) use ($member) {
                $q->where('member_id', $member->id);
            })
            ->sum('nominal');

        return $masuk - $keluar;
    }
    public static function getSaldoWd(?Member $member = null): float
    {
        $keluar = Wallet::where('status', 1)
            ->where('type', 'withdraw')
            ->when($member, function ($q) use ($member) {
                $q->where('member_id', $member->id);
            })
            ->sum('nominal');

        return $keluar;
    }
}
