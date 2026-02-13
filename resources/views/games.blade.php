<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jeux Disponibles') }}
        </h2>
    </x-slot>

    <div class="content">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Header Section -->
                <div class="mb-6">
                    <h3 class="text-2xl font-bold mb-2">🎮 Jeux hors ligne</h3>
                    <p class="text-sm text-gray-500">Tous nos jeux fonctionnent 100% hors ligne. Pas besoin de connexion internet pour jouer.</p>
                </div>

                <!-- Games Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    @foreach($games as $game)
                        <div class="game-card">
                            <!-- Game Icon/Logo -->
                            <div class="game-icon" style="background: linear-gradient(135deg, {{ $game['gradient'] === 'from-green-400 to-emerald-600' ? '#4ade80, #059669' : ($game['gradient'] === 'from-purple-400 to-pink-600' ? '#c084fc, #db2777' : ($game['gradient'] === 'from-blue-400 to-indigo-600' ? '#60a5fa, #4f46e5' : '#facc15, #ea580c')) }});">
                                {!! $game['logo'] !!}
                            </div>
                            
                            <!-- Game Content -->
                            <div class="game-content">
                                <h4 class="game-title">{{ $game['name'] }}</h4>
                                <p class="game-description">{{ $game['description'] }}</p>
                                
                                <!-- Tags -->
                                <div class="game-tags">
                                    <span class="tag">{{ $game['difficulty'] }}</span>
                                    <span class="tag">{{ $game['players'] }}</span>
                                </div>

                                <!-- Play Button -->
                                <a href="{{ route('games.' . $game['slug']) }}" class="settings-button" style="text-align: center; display: block; margin-top: 12px; text-decoration: none;">
                                    ▶ Jouer
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Info Section -->
                <div class="settings-card">
                    <h4 style="margin-bottom: 12px;">💡 Le saviez-vous ?</h4>
                    <p style="color: #6b7280; font-size: 14px; line-height: 1.6; margin-bottom: 16px;">
                        Tous ces jeux fonctionnent <strong>100% hors ligne</strong> ! Pas besoin de connexion internet pour jouer. 
                        Parfait pour les moments sans réseau ou pour économiser votre forfait data.
                    </p>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-number">⚡</div>
                            <div class="stat-label">Ultra rapide</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">🎯</div>
                            <div class="stat-label">Sans publicité</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">💾</div>
                            <div class="stat-label">Scores sauvegardés</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .game-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: all 0.2s;
        }
        
        .game-card:hover {
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        
        .game-icon {
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }
        
        /* Logos CSS redimensionnés */
        .game-icon > div {
            transform: scale(0.65);
        }
        
        .game-content {
            padding: 16px;
        }
        
        .game-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #1f2937;
        }
        
        .game-description {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 12px;
            line-height: 1.4;
            min-height: 50px;
        }
        
        .game-tags {
            display: flex;
            gap: 6px;
            margin-bottom: 4px;
            flex-wrap: wrap;
        }
        
        .game-tags .tag {
            background: #f3f4f6;
            color: #6b7280;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }
    </style>
</x-app-layout>