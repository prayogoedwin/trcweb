<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Trade;
use App\Models\TradeProfit;
use App\Services\TradeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfitController extends Controller
{
    public function index()
    {
        $totalProfit = TradeProfit::where('member_id', Auth::guard('member')->user()->id)->sum('amount');
        $week = TradeProfit::where('member_id', Auth::guard('member')->user()->id)->whereBetween(
            'profit_date',
            [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek(),
            ]
        )->sum('amount');
        $active = Trade::where('member_id', Auth::guard('member')->user()->id)->where('status', 'active')->sum('modal');
        $rows = TradeService::weeklyReportByUser(Auth::guard('member')->user()->id);
        return view('member.profit.index', compact('totalProfit', 'week', 'active', 'rows'));
    }
}
