<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.stats');
            }
            return redirect()->route('colocations.index');
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ])->onlyInput('email');
    }

    public function showRegister(Request $request)
    {
        $email = $request->query('email');
        return view('auth.register', compact('email'));
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $isFirstUser = User::count() === 0;

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $isFirstUser ? 'admin' : 'member',
        ]);

        Auth::login($user);

        if (Auth::user()->role === "admin") {
            return redirect()->route('admin.stats');
        }
        return redirect()->route('colocations.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
