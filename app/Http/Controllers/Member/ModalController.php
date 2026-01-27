<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Trade;
use App\Services\SaldoService;
use App\Services\TradeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModalController extends Controller
{
    public function index()
    {
        $saldo = SaldoService::getSaldo(Auth::guard('member')->user());
        $tradeAktif = TradeService::getTradeAktif(Auth::guard('member')->user());
        $riwayat = Trade::where('member_id', Auth::guard('member')->user()->id)->orderBy('created_at', 'desc')->limit(5)->get();
        return view('member.modal.index', compact('saldo', 'tradeAktif', 'riwayat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'modal' => ['required', 'numeric', 'min:10000'],
        ]);

        try {
            $member = Auth::guard('member')->user();

            $trade = TradeService::createTrade($member, $request->modal);

            return response()->json([
                'success' => true,
                'message' => 'Trade berhasil dibuat',
                'data' => [
                    'trade_id' => $trade->id,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function cancelModal(Trade $trade)
    {
        if ((int) $trade->member_id !== (int) Auth::guard('member')->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak'
            ], 403);
        }

        try {
            TradeService::cancelTrade($trade);
            return response()->json([
                'success' => true,
                'message' => 'Trading berhasil dibatalkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
