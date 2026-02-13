<x-app-layout>
    <div>
        <h2>🎮 Gamers Hub</h2>
        <p>La plateforme sociale pour discuter, jouer et suivre l’actualité gaming.</p>

        <section class="news-section">
            <h3>📰 Actualités Gaming</h3>

            <div class="news-card">
                <span class="tag update">UPDATE</span>
                <h4>🔥 Mise à jour Valorant 8.01</h4>
                <p>Nouveaux agents, équilibrage des armes et corrections de bugs.</p>
                <small>Il y a 2 heures</small>
            </div>

            <div class="news-card">
                <span class="tag event">EVENT</span>
                <h4>🎉 Événement Minecraft Survival</h4>
                <p>Un serveur communautaire ouvre ce week-end. Rejoins-nous !</p>
                <small>Hier</small>
            </div>

            <div class="news-card">
                <span class="tag esport">ESPORT</span>
                <h4>🏆 Tournoi LoL – Inscriptions ouvertes</h4>
                <p>Forme ton équipe et participe au tournoi régional.</p>
                <small>Il y a 3 jours</small>
            </div>
        </section>

        <section class="popular-games">
            <h3>⭐ Jeux populaires</h3>

            <div class="game-mini">
                <span>Valorant</span>
                <button data-play="Valorant">Jouer</button>
            </div>

            <div class="game-mini">
                <span>League of Legends</span>
                <button data-play="League of Legends">Jouer</button>
            </div>

            <div class="game-mini">
                <span>Minecraft</span>
                <button data-play="Minecraft">Jouer</button>
            </div>
        </section>
    </div>
</x-app-layout>