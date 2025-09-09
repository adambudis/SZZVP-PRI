<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomepageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // měsíční statistiky
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();

        $monthly = $user->readings()
            ->with('book')
            ->whereBetween('date', [$monthStart, $monthEnd])
            ->get();

        // celkem stranek
        $monthlyPages = $monthly->sum('pages_read');
        // celkem minut
        $monthlyMinutes = $monthly->sum('duration_minutes');
        // průměrná rychlost (stran za minutu)
        $monthlySpeed = $monthlyMinutes > 0 ? round(($monthlyPages / $monthlyMinutes), 1) : 0;
        // stranek za den
        $monthlyPagesPerDay = $monthly
            ->groupBy('date')
            ->map->sum('pages_read')
            ->sortKeys();
        // počet čtených knih (unikátní book_id v měsíci)
        $monthlyBooksCount = $monthly->pluck('book_id')->unique()->count();
        // počet čtení (záznamů)
        $monthlyReadingsCount = $monthly->count();
        // rychlost čtení pro každý záznam a min/max
        $sessionSpeeds = $monthly->map(function ($r) {
            if (($r->duration_minutes ?? 0) <= 0) {
                return null; // ignorovat záznamy bez času
            }
            return ($r->pages_read / $r->duration_minutes);
        })->filter(); // odfiltruje null

        $fastestMonthlySpeed = $sessionSpeeds->isNotEmpty() ? round($sessionSpeeds->max(), 1) : 0;
        $slowestMonthlySpeed = $sessionSpeeds->isNotEmpty() ? round($sessionSpeeds->min(), 1) : 0;


        // týdenní statistiky
        $weekStart = Carbon::now()->startOfWeek();
        $weekEnd = Carbon::now()->endOfWeek();

        $weekly = $user->readings()
            ->with('book')
            ->whereBetween('date', [$weekStart, $weekEnd])
            ->get();

        $weeklyPages = $weekly->sum('pages_read');
        $weeklyMinutes = $weekly->sum('duration_minutes');
        $weeklyBooksCount = $weekly->pluck('book_id')->unique()->count();
        $weeklyReadingsCount = $weekly->count();
        // průměrná rychlost
        $weeklySpeed = $weeklyMinutes > 0 ? round($weeklyPages / $weeklyMinutes, 2) : 0;
        // extrémy rychlosti
        $weeklySessionSpeeds = $weekly->map(function ($r) {
            $mins = (int) ($r->duration_minutes ?? 0);
            if ($mins <= 0) return null;
            return $r->pages_read / $mins;
        })->filter();

        $fastestWeeklySpeed = $weeklySessionSpeeds->isNotEmpty() ? round($weeklySessionSpeeds->max(), 2) : 0;
        $slowestWeeklySpeed = $weeklySessionSpeeds->isNotEmpty() ? round($weeklySessionSpeeds->min(), 2) : 0;

        return view('homepage', compact(
            // měsíc
            'monthlyPages','monthlySpeed','monthlyPagesPerDay',
            'monthlyBooksCount','monthlyReadingsCount','fastestMonthlySpeed','slowestMonthlySpeed',
            // týden
            'weeklyPages','weeklySpeed', 'weeklyBooksCount', 'weeklyReadingsCount','fastestWeeklySpeed','slowestWeeklySpeed'
        ));
    }
}
