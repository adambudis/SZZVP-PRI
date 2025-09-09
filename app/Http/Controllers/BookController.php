<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{
    /**
     * Zobrazí seznam knih.
     */
    public function index()
    {
        $books = Auth::user()->books;
        return view('books.index', compact('books'));
    }

    /**
     * Uloží novou knihu.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => 'required|integer|min:0|max:' . date('Y'),
            'genre' => 'required|string|max:255',
            'pages' => 'required|integer|min:1',
        ]);

        Auth::user()->books()->create($request->all());

        return redirect()->route('books.index')->with('success', 'Kniha byla přidána.');
    }
}
