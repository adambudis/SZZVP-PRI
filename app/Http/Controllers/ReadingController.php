<?php

namespace App\Http\Controllers;

use App\Models\Reading;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReadingController extends Controller
{
    /**
     * Zobrazí přehled čtenářských záznamů za aktuální týden.
     */
    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $readings = Reading::with('book')
            ->where('user_id', Auth::id())
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->orderBy('date', 'desc')
            ->get();

        $books = Auth::user()->books;

        return view('readings.index', compact('readings', 'books'));
    }

    /**
     * Uloží nový čtenářský záznam.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'book_id' => 'required|exists:books,id',
            'from_page' => 'required|integer|min:1',
            'to_page' => 'required|integer|gt:from_page',
            'duration_minutes' => 'required|integer|min:1',
        ]);

        Reading::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'date' => $request->date,
            'from_page' => $request->from_page,
            'to_page' => $request->to_page,
            'pages_read' => $request->to_page - $request->from_page + 1,
            'duration_minutes' => $request->duration_minutes,
        ]);

        return redirect()->route('readings.index')->with('success', 'Záznam byl uložen.');
    }
}
