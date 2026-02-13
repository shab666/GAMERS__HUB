<x-app-layout>
    <div class="settings-container">
        <a href="{{ route('home') }}" class="back-btn"><span class="arrow">←</span>Retour</a>
        
        <div class="settings-card">
            <div class="settings-header">
                <h2 class="settings-title">Paramètres</h2>
                <p class="settings-subtitle">Personnalisez votre profil et vos préférences</p>
            </div>

            <form id="settings-form" class="settings-form">
                <div class="form-group">
                    <label for="username" class="form-label">Nom d'utilisateur</label>
                    <input id="username" name="username" type="text" class="settings-input" placeholder="Ton pseudo">
                    <span class="form-hint">Visible par les autres joueurs</span>
                </div>

                <div class="form-group">
                    <label for="notifications" class="form-label">Préférences de notifications</label>
                    <input id="notifications" name="notifications" type="text" class="settings-input" placeholder="Ex: Mentions, messages privés...">
                    <span class="form-hint">Séparées par des virgules</span>
                </div>

                <button type="submit" class="settings-button">
                    <span>Sauvegarder les paramètres</span>
                </button>
            </form>

            <div id="success-message" class="success-message" style="display: none;">
                ✓ Paramètres sauvegardés avec succès
            </div>
        </div>

        <script>
            const form = document.getElementById('settings-form');
            const successMsg = document.getElementById('success-message');

            form?.addEventListener('submit', e => {
                e.preventDefault();
                localStorage.setItem('username', document.getElementById('username').value);
                localStorage.setItem('notifications', document.getElementById('notifications').value);
                
                // Show success message
                successMsg.style.display = 'block';
                setTimeout(() => {
                    successMsg.style.display = 'none';
                }, 3000);
            });

            // Prefill
            document.getElementById('username').value = localStorage.getItem('username') || '';
            document.getElementById('notifications').value = localStorage.getItem('notifications') || '';
        </script>
    </div>
</x-app-layout>