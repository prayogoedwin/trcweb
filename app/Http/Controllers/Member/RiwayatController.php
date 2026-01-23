<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $memberId = Auth::guard('member')->user()->id;

        $totalTopup = Wallet::where('member_id', $memberId)
            ->where('type', 'topup')
            ->where('status', 1)
            ->sum('nominal');

        $totalWithdraw = Wallet::where('member_id', $memberId)
            ->where('type', 'withdraw')
            ->sum('nominal');

        $saldo = $totalTopup - $totalWithdraw;
        $allTransaction = Wallet::where('member_id', Auth::guard('member')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('member.riwayat.saldo', compact('saldo', 'totalTopup', 'totalWithdraw', 'allTransaction'));
    }

    public function riwayatModal()
    {
        return view('member.riwayat.modal');
    }

    public function riwayatProfit()
    {
        return view('member.riwayat.profit');
    }
}
