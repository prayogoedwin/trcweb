<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Trade;
use App\Models\TradeProfit;
use App\Models\Wallet;
use App\Services\SaldoService;
use App\Services\TradeService;
use Carbon\Carbon;
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

        $saldo = SaldoService::getSaldo(Auth::guard('member')->user());
        $allTransaction = Wallet::where('member_id', Auth::guard('member')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('member.riwayat.saldo', compact('saldo', 'totalTopup', 'totalWithdraw', 'allTransaction'));
    }

    public function riwayatModal()
    {
        $rows = TradeService::listByUser(Auth::guard('member')->user()->id);
        $tradeAktif = TradeService::getTradeAktif(Auth::guard('member')->user());
        $totalModal =  Trade::where('member_id', Auth::guard('member')->user()->id)->sum('modal');
        return view('member.riwayat.modal', compact('rows', 'tradeAktif', 'totalModal'));
    }

    public function riwayatProfit()
    {
        $listProfit = TradeService::listProfitByUser(Auth::guard('member')->user()->id);
        $totalProfit = TradeProfit::where('member_id', Auth::guard('member')->user()->id)->sum('amount');
        $month = TradeProfit::where('member_id', Auth::guard('member')->user()->id)->whereBetween(
            'profit_date',
            [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth(),
            ]
        )->sum('amount');
        return view('member.riwayat.profit', compact('listProfit', 'totalProfit', 'month'));
    }
}
