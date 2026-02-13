<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('home');

// Game routes
use App\Http\Controllers\GameController;

Route::get('/games', [GameController::class, 'index'])->name('games');
Route::get('/games/snake', [GameController::class, 'snake'])->name('games.snake');
Route::get('/games/tictactoe', [GameController::class, 'tictactoe'])->name('games.tictactoe');
Route::get('/games/memory', [GameController::class, 'memory'])->name('games.memory');
Route::get('/games/2048', [GameController::class, 'game2048'])->name('games.2048');

Route::view('/messages', 'messages')->name('messages');

Route::middleware('auth')->group(function () {
    Route::view('/settings', 'settings')->name('settings');
});

// Admin routes
Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    // User management actions
    Route::patch('/users/{user}/promote', [\App\Http\Controllers\AdminController::class, 'promote'])->name('users.promote');
    Route::patch('/users/{user}/demote', [\App\Http\Controllers\AdminController::class, 'demote'])->name('users.demote');
    Route::delete('/users/{user}', [\App\Http\Controllers\AdminController::class, 'destroy'])->name('users.destroy');
});

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
