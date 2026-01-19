<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaldoController extends Controller
{
    public function __construct()
    {
        if (!Auth::guard('member')->check()) {
            return view('member.index');
        }

        return redirect()->route('member.login')->with('error', 'Silakan login terlebih dahulu.');
    }

    public function index()
    {
        return view('member.saldo.index');
    }
}
