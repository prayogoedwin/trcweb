<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\User;
use App\Models\Wallet;
use App\Services\SaldoService;
use Filament\Actions\Action;
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

    private function cekSaldo()
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
        return $saldo;
    }

    public function index()
    {
        $memberId = Auth::guard('member')->user()->id;
        $bank = Bank::where('member_id', $memberId)->get();
        $saldo = SaldoService::getSaldo(Auth::guard('member')->user());
        $riwayat = Wallet::where('member_id', $memberId)->orderBy('created_at', 'desc')->limit(5)->get();
        return view('member.saldo.index', compact('saldo', 'riwayat', 'bank'));
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

            $data = Wallet::create([
                'member_id' => Auth::guard('member')->user()->id,
                'type' => 'topup',
                'nominal' => $amount,
                'status' => 0,
                'metode_pembayaran' => 'qris'
            ]);

            $recipient = User::where('email', 'superadmin@filament.com')->first();

            Notification::make()
                ->title('Topup Saldo')
                ->body('Topup sebesar ' . $amount)
                ->actions([
                    Action::make('edit')
                        ->label('Lihat Detail')
                        ->url(route('filament.backend.resources.wallets.edit', $data->id))
                        ->markAsRead(),
                ])
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

    public function withdrawSaldo(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'bank_id' => 'required',
        ]);
        try {
            $sisaSaldo = $this->cekSaldo();
            if ($sisaSaldo < $request->amount) {
                return response()->json([
                    'success' => false,
                    'message' => 'Saldo tidak mencukupi',
                ]);
            } else {
                $bank = Bank::where('id', $request->bank_id)->first();
                $data = Wallet::create([
                    'member_id' => Auth::guard('member')->user()->id,
                    'type' => 'withdraw',
                    'nominal' => $request->amount,
                    'status' => 0,
                    'rekening_tujuan' => $bank->no_rekening,
                ]);
                $recipient = User::where('email', 'superadmin@filament.com')->first();
                Notification::make()
                    ->title('Withdraw Saldo')
                    ->body('Withdraw sebesar ' . $request->amount)
                    ->actions([
                        Action::make('edit')
                            ->label('Lihat Detail')
                            ->url(route('filament.backend.resources.wallets.edit', $data->id))
                            ->markAsRead(),
                    ])
                    ->sendToDatabase($recipient);

                return response()->json([
                    'success' => true,
                    'message' => 'Withdraw berhasil',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
