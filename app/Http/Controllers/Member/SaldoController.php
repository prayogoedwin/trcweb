<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaldoController extends Controller
{
    // public function __construct()
    // {
    //     if (!Auth::guard('member')->check()) {
    //         return view('member.index');
    //     }

    //     return redirect()->route('member.login')->with('error', 'Silakan login terlebih dahulu.');
    // }

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
        $riwayat = Wallet::where('member_id', $memberId)->orderBy('created_at', 'desc')->limit(5)->get();
        return view('member.saldo.index', compact('saldo', 'riwayat'));
    }

    public function topupSaldo(Request $request)
    {
        $request->validate([
            'amount' => 'required',
        ]);
        try {
            $rawAmount = $request->amount;

            // Hapus semua selain angka
            $amount = (int) preg_replace('/[^0-9]/', '', $rawAmount);

            // Validasi setelah dibersihkan
            if ($amount <= 0) {
                return response()->json([
                    'message' => 'Nominal tidak valid'
                ], 422);
            }

            Wallet::create([
                'member_id' => Auth::guard('member')->user()->id,
                'type' => 'topup',
                'nominal' => $amount,
                'status' => 0,
                'metode_pembayaran' => 'qris'
            ]);

            $recipient = User::where('email', 'superadmin@filament.com')->first();

            Notification::make()
                ->title('Saved successfully')
                ->sendToDatabase($recipient);

            return response()->json([
                'message' => 'Topup berhasil',
                'amount'  => $amount
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
