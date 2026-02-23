<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Referal;
use App\Models\TradeProfit;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MemberRegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register'); // View register khusus member
    }

    public function registerReferal($referal)
    {
        return view('auth.register_referal', compact('referal'));
    }

    public function register(Request $request)
    {

        if (env('RECAPTCHA_V2') == 1) {
            $credentials = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:members',
                'password' => 'required|min:8',
                'recaptcha_token' => 'required'
            ]);
            // Verifikasi token dengan Google
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $request->recaptcha_token,
                'remoteip' => $request->ip(),
            ]);

            $result = $response->json();

            if (!($result['success'] ?? false) || ($result['score'] ?? 0) < 0.5) {
                return back()->withErrors(['email' => 'Verifikasi keamanan gagal.']);
            }
        } else {

            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:members',
                'password' => 'required|min:8',
                'whatsapp' => 'required',
            ]);
        }

        $referal = null;
        if ($request->filled('referal')) {
            $referal = Member::where('no_referal', $request->referal)->first();

            if (!$referal) {
                return back()->withErrors([
                    'referal' => 'Kode referal tidak ditemukan!',
                ]);
            }
        }
        DB::transaction(function () use ($request, $referal) {
            $referrer = Member::where('no_referal', $request->referal)->first();
            $member = Member::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'whatsapp' => $request->whatsapp,
                'no_referal' => strtoupper(Str::random(8)),
                'referred_by' => $referrer?->id,
            ]);

            if ($referrer) {
                // $reward = Referal::first();
                $totalProfit = TradeProfit::where('member_id', $referrer->id)->sum('amount');
                // 10% from total profit
                $reward = $totalProfit * 0.1;
                $wallet = Wallet::create([
                    'member_id' => $referrer->id,
                    'nominal' => $reward,
                    'type' => 'topup',
                    'metode_pembayaran' => 'referal',
                    'status' => 1
                ]);
            }
        });

        return redirect('/member/login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function registerReferalStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:members',
            'password' => 'required|min:8',
            'whatsapp' => 'required',
        ]);

        try {
            $referal = $request->referal;
            $user = Member::where('no_referal', $referal)->first();
            if (!$user) {
                return back()->withErrors([
                    'referal' => 'Kode referal tidak ditemukan!',
                ]);
            } else {
                DB::transaction(function () use ($request, $referal, $user) {
                    $member = Member::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'whatsapp' => $request->whatsapp,
                        'no_referal' => strtoupper(Str::random(8)),
                        'referred_by' => $user?->id,
                    ]);

                    if ($user) {
                        $reward = Referal::first();
                        $wallet = Wallet::create([
                            'member_id' => $user->id,
                            'nominal' => $reward->nominal,
                            'type' => 'topup',
                            'metode_pembayaran' => 'referal',
                            'status' => 1
                        ]);
                    }
                });

                return redirect('/member/login')->with('success', 'Registrasi berhasil, silakan login.');
            }
        } catch (\Throwable $th) {
            return back()->withErrors([
                'message' => $th->getMessage(),
            ]);
        }
    }
}
