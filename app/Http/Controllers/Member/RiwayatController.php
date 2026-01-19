<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        return view('member.riwayat.saldo');
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
