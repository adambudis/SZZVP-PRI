<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Zobrazí stránku profilu s možnostmi smazání dat nebo účtu.
     */
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    /**
     * Smaže pouze data uživatele (knihy + čtení), účet zůstane.
     */
    public function deleteData(Request $request)
    {
        $user = Auth::user();

        DB::transaction(function () use ($user) {
            // mažeme pouze data, ne samotný účet
            $user->readings()->delete();
            $user->books()->delete();
        });

        return back()->with('success', 'Všechna vaše data byla smazána. Váš účet zůstal zachován.');
    }

    /**
     * Smaže účet včetně všech dat.
     */
    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        DB::transaction(function () use ($user) {
            //$user->readings()->delete();
            //$user->books()->delete();
            // smaže i všechna data díky CASCADE
            $user->delete(); 
        });

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Váš účet a všechna data byly smazány.');
    }
}
