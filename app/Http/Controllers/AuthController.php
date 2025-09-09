<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Zobrazí formulář pro přihlášení.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Zpracuje přihlášení uživatele.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('homepage');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    /**
     * Zobrazí formulář pro registraci.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Zpracuje registraci nového uživatele.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',              // minimální délka 8 znaků
                'regex:/[a-z]/',      // alespoň jedno malé písmeno
                'regex:/[A-Z]/',      // alespoň jedno velké písmeno
                'regex:/[0-9]/',      // alespoň jedna číslice
                'regex:/[@$!%*#?&]/', // alespoň jeden speciální znak
                'confirmed',
            ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // uložení hashe hesla
        ]);

        Auth::login($user);

        return redirect()->route('homepage');
    }

    /**
     * Odhlášeni aktuálně přihlášeného uživatele.
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
