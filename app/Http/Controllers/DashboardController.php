<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Statistiques de base
        $stats = [
            'users' => User::count(),
            'messages_unread' => 0, // à remplacer par la logique réelle si tu ajoutes un modèle Message
            'active_games' => 3,
        ];

        // Contenu factice (remplaçable plus tard par des données réelles)
        $news = [
            ['title' => "Tournoi ce week-end", 'excerpt' => "Inscris-toi pour gagner des récompenses.", 'tag' => 'event'],
            ['title' => "Mise à jour du site", 'excerpt' => "Nouvelles fonctionnalités ajoutées.", 'tag' => 'update'],
        ];

        $popularGames = [
            ['name' => 'Valorant', 'players' => 1240],
            ['name' => 'Fortnite', 'players' => 980],
            ['name' => 'League of Legends', 'players' => 1567],
        ];

        $recentActivities = [
            ['text' => 'Paul a rejoint la communauté', 'time' => '2h'],
            ['text' => 'Mise à jour du profil de Marie', 'time' => '5h'],
            ['text' => 'Nouvelle partie créée : Soirée FPS', 'time' => '1j'],
        ];

        return view('dashboard', compact('user', 'stats', 'news', 'popularGames', 'recentActivities'));
    }
}
