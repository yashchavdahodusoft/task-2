<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;

class AuthEmployeeController extends Controller
{
    public function handleLogin(Request $request)
    {

        if (Auth::guard('employees')->attempt($request->only(['email', 'password'], $request->boolean('remember')))) {
            $request->session()->regenerate();
            //return redirect()->route('dashboard');
            return true;
        }
        return false;
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('employees')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
