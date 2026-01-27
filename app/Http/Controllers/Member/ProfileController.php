<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Member;
use App\Models\Trade;
use App\Models\TradeProfit;
use App\Services\SaldoService;
use App\Services\TradeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $data = Auth::guard('member')->user();
        $bank = Bank::where('member_id', $data->id)->get();
        $saldo = SaldoService::getSaldo(Auth::guard('member')->user());
        $tradeAktif = TradeService::getTradeAktif(Auth::guard('member')->user());
        $totalProfit = TradeProfit::where('member_id', Auth::guard('member')->user()->id)->sum('amount');
        $totalTrade = Trade::where('member_id', Auth::guard('member')->user()->id)->count();
        return view('member.profile.index', compact('data', 'bank', 'saldo', 'tradeAktif', 'totalProfit', 'totalTrade'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:5',
            'whatsapp' => 'nullable|string|max:20',
        ]);

        $member_auth = Auth::guard('member')->user();
        $member = Member::findOrFail($member_auth->id);

        // Update hanya jika user sesuai dengan yang login
        if ($member_auth->id != $request->id) {
            abort(403, 'Akses tidak sah');
        }

        $member->name = $request->name;
        $member->whatsapp = $request->whatsapp;
        $member->alamat = $request->alamat;
        $member->save();

        return redirect()->route('member.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:5',
            'password_confirmation' => 'required|string|min:5|same:password',
        ]);

        $member = Auth::guard('member')->user();

        // Cek password lama
        if (! Hash::check($request->current_password, $member->password)) {
            return back()->withErrors([
                'current_password' => 'Password lama tidak sesuai.',
            ]);
        }
        $member->password = Hash::make($request->password);
        $member->save();

        return redirect()->route('member.profile')->with('success', 'Password berhasil diperbarui.');
    }

    public function addBank(Request $request)
    {
        $memberId = Auth::guard('member')->id();
        $request->validate([
            'nama_bank' => 'required',
            'no_rekening' => 'required',
            'atas_nama' => 'required',
        ]);
        if ($request->filled('utama')) {
            $exists = Bank::where('member_id', $memberId)
                ->where('utama', 1)
                ->exists();

            if ($exists) {
                return back()
                    ->withErrors(['utama' => 'Sudah ada rekening utama.'])
                    ->withInput();
            }
        }

        Bank::create([
            'member_id'   => $memberId,
            'nama_bank'   => $request->nama_bank,
            'no_rekening' => $request->no_rekening,
            'atas_nama'   => $request->atas_nama,
            'utama'       => $request->filled('utama') ? 1 : 0,
        ]);
        return redirect()->route('member.profile')->with('success', 'Bank berhasil ditambahkan.');
    }

    public function deleteBank(Bank $bank)
    {
        try {
            $bank->delete();
            return redirect()->route('member.profile')->with('success', 'Bank berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->route('member.profile')->with('error', $th->getMessage());
        }
    }
}
