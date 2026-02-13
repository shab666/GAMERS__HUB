<x-guest-layout>
    <div class="auth-container">
        <div>
            <div class="auth-card">
                <div class="auth-brand"><img src="{{ asset('images/logo.svg') }}" class="logo" alt="Gamers Hub"><div class="brand-text">Gamers Hub</div></div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-text-input id="email" class="auth-input" type="email" name="email" :value="old('email')" placeholder="Email" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-text-input id="password" class="auth-input" type="password" name="password" placeholder="Mot de passe" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <x-primary-button>Connexion</x-primary-button>

                    <div class="auth-or">OU</div>

                    <div class="auth-social"><a href="#">Se connecter avec Discord</a></div>

                    <div class="auth-footer">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" name="remember">
                            <span style="margin-left:8px">Se souvenir de moi</span>
                        </label>

                        <div>
                            @if (Route::has('password.request'))
                                <a class="auth-link" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <div class="auth-card-mini">Tu n'as pas de compte ? <a href="{{ route('register') }}" class="auth-link">Inscription</a></div>
        </div>
    </div>
</x-guest-layout>
