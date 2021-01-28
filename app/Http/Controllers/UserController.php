<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserLogin;
use App\Http\Requests\StoreUserRegister;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function store(StoreUserRegister $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        session()->flash('success', 'Registration successful!');
        Auth::login($user);
        return redirect()->home();
    }

    public function loginForm()
    {
        return view('user.login');
    }

    public function login(StoreUserLogin $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            session()->flash('success', 'You are logged!');

            if (Auth::user()->is_admin) {
                return redirect()->route('admin.index');
            } else {
                return redirect()->home();
            }
        }

        return redirect()->back()->with('error', 'Incorrect login or password!');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login.create');
    }
}
