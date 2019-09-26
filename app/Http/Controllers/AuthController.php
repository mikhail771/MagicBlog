<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginUser;
use App\Http\Requests\Auth\RegisterUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('pages.register');
    }

    public function register(RegisterUser $request)
    {
        $user = User::add($request->all());
        $user->generatePassword($request->get('password'));

        return redirect('/');
    }

    public function loginForm()
    {
        return view('pages.login');
    }

    public function login(LoginUser $request)
    {
        if (Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ])){
            return redirect('/');
        }

        return redirect()->back()->with('status', 'Wrong email or password');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}
