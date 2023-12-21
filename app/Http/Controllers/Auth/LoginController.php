<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\HTTP\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        $this->redirectTo = auth()->check() && auth()->user()->is_admin ? route('adminPage') : route('home');
    }

    protected function authenticated(Request $request, $user)
    {
        \Log::info('Authenticated method called. Is Admin: ' . $user->is_admin);
        if ($user->is_admin == 1) {
            return redirect()->route('adminPage');
        }

        return redirect()->route('home');
    }
}