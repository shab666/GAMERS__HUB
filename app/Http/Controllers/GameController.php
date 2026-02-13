<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of available games.
     */
    public function index()
    {
        $games = [
            [
                'name' => 'Snake',
                'slug' => 'snake',
                'description' => 'Le jeu classique du serpent. Mangez des pommes et grandissez sans vous mordre la queue !',
                'icon' => '🐍',
                'logo' => '<div class="text-7xl">🐍</div>',
                'gradient' => 'from-green-400 to-emerald-600',
                'difficulty' => 'Facile',
                'players' => '1 joueur'
            ],
            [
                'name' => 'Tic-Tac-Toe',
                'slug' => 'tictactoe',
                'description' => 'Affrontez l\'ordinateur dans ce jeu de stratégie classique. Alignez 3 symboles pour gagner !',
                'icon' => '⭕',
                'logo' => '<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:4px;width:80px;height:80px;margin:auto"><div style="background:#8b5cf6;border-radius:8px"></div><div style="background:#ec4899;border-radius:8px;display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;font-size:24px">X</div><div style="background:#8b5cf6;border-radius:8px"></div><div style="background:#ec4899;border-radius:8px;display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;font-size:24px">O</div><div style="background:#8b5cf6;border-radius:8px"></div><div style="background:#ec4899;border-radius:8px;display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;font-size:24px">X</div><div style="background:#8b5cf6;border-radius:8px"></div><div style="background:#ec4899;border-radius:8px;display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;font-size:24px">O</div><div style="background:#8b5cf6;border-radius:8px"></div></div>',
                'gradient' => 'from-purple-400 to-pink-600',
                'difficulty' => 'Facile',
                'players' => '1 joueur vs AI'
            ],
            [
                'name' => 'Memory Cards',
                'slug' => 'memory',
                'description' => 'Testez votre mémoire ! Trouvez toutes les paires de cartes identiques.',
                'icon' => '🎴',
                'logo' => '<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:3px;width:90px;margin:auto"><div style="background:white;border-radius:6px;height:20px;display:flex;align-items:center;justify-content:center">🎮</div><div style="background:#6366f1;border-radius:6px;height:20px;display:flex;align-items:center;justify-content:center;color:white;font-size:12px">?</div><div style="background:white;border-radius:6px;height:20px;display:flex;align-items:center;justify-content:center">🎯</div><div style="background:#6366f1;border-radius:6px;height:20px;display:flex;align-items:center;justify-content:center;color:white;font-size:12px">?</div><div style="background:#6366f1;border-radius:6px;height:20px;display:flex;align-items:center;justify-content:center;color:white;font-size:12px">?</div><div style="background:white;border-radius:6px;height:20px;display:flex;align-items:center;justify-content:center">🎨</div><div style="background:#6366f1;border-radius:6px;height:20px;display:flex;align-items:center;justify-content:center;color:white;font-size:12px">?</div><div style="background:white;border-radius:6px;height:20px;display:flex;align-items:center;justify-content:center">🎭</div></div>',
                'gradient' => 'from-blue-400 to-indigo-600',
                'difficulty' => 'Moyen',
                'players' => '1 joueur'
            ],
            [
                'name' => '2048',
                'slug' => '2048',
                'description' => 'Fusionnez les tuiles pour atteindre 2048. Un puzzle addictif et stratégique !',
                'icon' => '🎯',
                'logo' => '<div style="display:grid;grid-template-columns:repeat(2,1fr);gap:4px;width:80px;margin:auto"><div style="background:#eee4da;border-radius:8px;height:35px;display:flex;align-items:center;justify-content:center;color:#776e65;font-weight:bold;font-size:18px">2</div><div style="background:#ede0c8;border-radius:8px;height:35px;display:flex;align-items:center;justify-content:center;color:#776e65;font-weight:bold;font-size:18px">4</div><div style="background:#f2b179;border-radius:8px;height:35px;display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;font-size:18px">8</div><div style="background:#f59563;border-radius:8px;height:35px;display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;font-size:16px">16</div></div>',
                'gradient' => 'from-yellow-400 to-orange-600',
                'difficulty' => 'Difficile',
                'players' => '1 joueur'
            ],
        ];

        return view('games', compact('games'));
    }

    /**
     * Display the Snake game.
     */
    public function snake()
    {
        return view('games.snake');
    }

    /**
     * Display the Tic-Tac-Toe game.
     */
    public function tictactoe()
    {
        return view('games.tictactoe');
    }

    /**
     * Display the Memory Cards game.
     */
    public function memory()
    {
        return view('games.memory');
    }

    /**
     * Display the 2048 game.
     */
    public function game2048()
    {
        return view('games.2048');
    }
}
