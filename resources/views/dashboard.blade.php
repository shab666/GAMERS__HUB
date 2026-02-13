<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Dashboard') }}</h2>
    </x-slot>

    <div class="content">
        <div class="dashboard-grid max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="main-column">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="mb-4">
                        <h3 class="text-2xl font-bold">Bonjour, {{ $user->name }}</h3>
                        <p class="text-sm text-gray-500">Bienvenue sur ton tableau de bord — voici un aperçu rapide.</p>
                    </div>

                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-number">{{ $stats['users'] }}</div>
                            <div class="stat-label">Membres</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-number">{{ $stats['messages_unread'] }}</div>
                            <div class="stat-label">Messages non lus</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-number">{{ $stats['active_games'] }}</div>
                            <div class="stat-label">Parties actives</div>
                        </div>
                    </div>

                    <div class="news-section mt-6">
                        <h3 class="mb-2">Actualités</h3>
                        @foreach($news as $item)
                            <div class="news-card">
                                <span class="tag {{ $item['tag'] }}">{{ ucfirst($item['tag']) }}</span>
                                <h4>{{ $item['title'] }}</h4>
                                <p>{{ $item['excerpt'] }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="popular-games mt-6">
                        <h3 class="mb-2">Jeux populaires</h3>
                        @foreach($popularGames as $game)
                            <div class="game-mini">
                                <span>{{ $game['name'] }} — <small>{{ $game['players'] }} joueurs</small></span>
                                <button class="settings-button">Jouer</button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mt-6">
                    <h3 class="mb-3">Activité récente</h3>
                    @foreach($recentActivities as $act)
                        <div class="message">{{ $act['text'] }} <small style="display:block; color:#9a9acb">{{ $act['time'] }}</small></div>
                    @endforeach
                </div>
            </div>

            <aside class="side-column">
                <div class="settings-card">
                    <div style="display:flex; gap:12px; align-items:center; margin-bottom:12px">
                        <img src="{{ asset('images/logo.svg') }}" alt="avatar" class="profile-avatar">
                        <div>
                            <div style="font-weight:800">{{ $user->name }}</div>
                            <div style="font-size:13px; color:#cfcfff">{{ $user->email }}</div>
                        </div>
                    </div>

                    <div style="display:flex; gap:8px; flex-direction:column">
                        <a href="{{ route('profile.edit') }}" class="settings-button">Modifier le profil</a>
                        <a href="{{ route('settings') }}" class="settings-button">Paramètres</a>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="settings-button" style="background:linear-gradient(135deg,#ff9a6f,#ff616f)">Panneau admin</a>
                        @endif
                    </div>
                </div>

                <div class="settings-card mt-6">
                    <h4 style="margin-bottom:8px">Actions rapides</h4>
                    <div style="display:flex; flex-direction:column; gap:8px">
                        <button class="settings-button">Créer une partie</button>
                        <button class="settings-button">Envoyer un message</button>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</x-app-layout>
