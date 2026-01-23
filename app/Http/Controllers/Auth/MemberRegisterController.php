<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Referal;
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
                $reward = Referal::first();
                $wallet = Wallet::create([
                    'member_id' => $referrer->id,
                    'nominal' => $reward->nominal,
                    'type' => 'topup',
                    'metode_pembayaran' => 'referal',
                    'status' => 1
                ]);
            }
        });

        return redirect('/member/login')->with('success', 'Registrasi berhasil, silakan login.');
    }
}
