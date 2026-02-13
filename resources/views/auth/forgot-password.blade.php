<x-guest-layout>
    <div class="auth-container">
        <div>
            <div class="auth-card">
                <div class="auth-brand"><img src="{{ asset('images/logo.svg') }}" class="logo" alt="Gamers Hub"><div class="brand-text">Réinitialiser le mot de passe</div></div>

                <p style="color:#cfcfff; margin-bottom:10px">Indique ton email et nous t'enverrons un lien pour réinitialiser ton mot de passe.</p>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div>
                        <x-text-input id="email" class="auth-input" type="email" name="email" :value="old('email')" placeholder="Email" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <x-primary-button style="margin-top:12px">Envoyer le lien</x-primary-button>
                </form>
            </div>

            <div class="auth-card-mini">Retour à la <a href="{{ route('login') }}" class="auth-link">connexion</a></div>
        </div>
    </div>
</x-guest-layout>
