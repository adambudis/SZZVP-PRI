<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OverviewController extends Controller
{
    /**
     * Zobrazí přehled s statistikami za aktuální týden.
     */
    public function index()
    {
        $user = Auth::user();

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $readings = $user->readings()
            ->with('book')
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->get();

        $totalPages = $readings->sum('pages_read');
        $totalMinutes = $readings->sum('duration_minutes');
        $avgDurationMin = $readings->count() ? round($totalMinutes / $readings->count()) : 0;

        $pagesPerDay = $readings
            ->groupBy('date')
            ->map->sum('pages_read')
            ->sortKeys();

        // průměrná rychlost z dat
        $readingSpeed = $totalMinutes > 0 ? round(($totalPages / $totalMinutes) * 60, 1) : 0;

        return view('overview.index', compact(
            'user','totalPages','avgDurationMin','pagesPerDay','readingSpeed'
        ));
    }

    /**
     * Aktualizuje údaje uživatele (jméno, oblíbený žánr).
     */
    public function updateUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'favorite_genre' => 'nullable|string|max:255',
        ]);

        Auth::user()->update($request->only('name','favorite_genre'));

        return back()->with('success','Údaje byly uloženy.');
    }
}
