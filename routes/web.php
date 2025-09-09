<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReadingController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomepageController;


// PŘIHLÁŠENÍ, REGISTRACE A ODHLAŠENÍ
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    
    // DASHBOARD (PO PŘIHLÁŠENÍ)
    Route::get('/', [HomepageController::class, 'index'])->name('homepage'); 
    
    // KNIHY
    Route::get('/knihy', [BookController::class, 'index'])->name('books.index');
    Route::post('/knihy', [BookController::class, 'store'])->name('books.store');

    // ČTENÍ
    Route::get('/cteni', [ReadingController::class, 'index'])->name('readings.index');
    Route::post('/cteni', [ReadingController::class, 'store'])->name('readings.store');

    // PŘEHLED
    Route::get('/prehled', [OverviewController::class, 'index'])->name('overview.index');
    Route::post('/prehled/update-user', [OverviewController::class, 'updateUser'])->name('overview.updateUser');

    // PROFIL
    Route::get('/profil', [ProfileController::class, 'index'])->name('profile.index');
    Route::delete('/profil/delete-data', [ProfileController::class, 'deleteData'])->name('profile.deleteData');
    Route::delete('/profil/delete-account', [ProfileController::class, 'deleteAccount'])->name('profile.deleteAccount');
});