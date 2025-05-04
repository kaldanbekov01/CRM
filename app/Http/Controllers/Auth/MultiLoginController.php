<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MultiLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // make sure this matches your Blade view
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // 1. Try logging in as user
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->intended('/home');
        }

        // 2. Try logging in as employee
        if (Auth::guard('employee')->attempt($credentials)) {
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'email' => 'Invalid login credentials.',
        ]);
    }



    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        } elseif (Auth::guard('employee')->check()) {
            Auth::guard('employee')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}

