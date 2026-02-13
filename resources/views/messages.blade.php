<x-app-layout>
    <div>
        <a href="{{ route('home') }}" class="back-btn"><span class="arrow">←</span>Retour</a>
        <h2>Messages</h2>

        <!-- Message list visible to everyone -->
        <div class="message">Alice: Salut ! Tu joues à quel jeu aujourd'hui ?</div>
        <div class="message">Bob: Je teste le nouveau jeu de stratégie !</div>
        <div class="message">Charlie: On se retrouve pour une partie en ligne ?</div>

        @guest
            <div class="auth-card" style="margin-top:14px; text-align:center;">
                <p style="color:#cfcfff; margin-bottom:8px">Tu dois être connecté pour poster des messages.</p>
                <a href="{{ route('login') }}" class="auth-link">Connexion</a>
            </div>
        @else
            <form id="message-form" style="margin-top:12px">
                <input type="text" id="message-input" class="auth-input" placeholder="Écris un message..." />
                <button type="submit" class="primary-btn" style="margin-top:8px">Envoyer</button>
            </form>
        @endguest

        <script>
            // Petit script local pour ajouter des messages côté client (temporaire)
            const form = document.getElementById('message-form');
            form?.addEventListener('submit', e => {
                e.preventDefault();
                const input = document.getElementById('message-input');
                if (!input || !input.value.trim()) return;
                const div = document.createElement('div');
                div.className = 'message';
                div.textContent = `Vous: ${input.value.trim()}`;
                form.parentNode.insertBefore(div, form);
                input.value = '';
            });
        </script>
    </div>
</x-app-layout>