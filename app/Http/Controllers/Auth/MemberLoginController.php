<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class MemberLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // View login khusus member
    }

    // public function login(Request $request) {
    //   $credentials = $request->validate([
    //     'email' => 'required|email',
    //     'password' => 'required',
    //   ]);

    //   if (Auth::guard('member')->attempt($credentials)) {
    //     return redirect()->intended('/'); // Redirect setelah login
    //   }

    //   return back()->withErrors(['email' => 'Kredensial tidak valid']);
    // }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            // 'recaptcha_token' => 'required'
        ]);

        // Autentikasi pengguna
        if (Auth::guard('member')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return redirect()->intended('/member/dashboard');
        }

        return back()->withErrors(['email' => 'Kredensial tidak valid']);
    }

    public function logout()
    {
        Auth::guard('member')->logout();
        return redirect('/member/login');
    }

    public function dashboard()
    {
        return view('publik.member.dashboard');
    }
}
