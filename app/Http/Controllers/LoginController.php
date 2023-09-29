<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }
    public function store(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password', 'active'))) {
            $user = Auth::user();

            $username = $user->name;

            if ($user->isActive()) {

                if ($user->isAdmin()) {
                    logActivity("ENTER ADMIN: $user->name");
                    return redirect()->route('table');
                } else {
                    logActivity("ENTER USER: $user->name ");
                    return redirect()->to('blog');
                }
            } else {
                Auth::logout();
                return redirect()->back()->withErrors('Your user is blocked');
            }
        }
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->to('home');
    }
}
