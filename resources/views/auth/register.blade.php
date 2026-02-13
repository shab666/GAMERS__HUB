<x-guest-layout>
    <div class="auth-container">
        <div>
            <div class="auth-card">
                <div class="auth-brand"><img src="{{ asset('images/logo.svg') }}" class="logo" alt="Gamers Hub"><div class="brand-text">Gamers Hub</div></div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div>
                        <x-text-input id="name" class="auth-input" type="text" name="name" :value="old('name')" placeholder="Nom" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div style="margin-top:10px">
                        <x-text-input id="email" class="auth-input" type="email" name="email" :value="old('email')" placeholder="Email" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div style="margin-top:10px">
                        <x-text-input id="password" class="auth-input" type="password" name="password" placeholder="Mot de passe" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div style="margin-top:10px">
                        <x-text-input id="password_confirmation" class="auth-input" type="password" name="password_confirmation" placeholder="Confirme le mot de passe" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <x-primary-button style="margin-top:12px">Inscription</x-primary-button>
                </form>
            </div>

            <div class="auth-card-mini">Tu as déjà un compte ? <a href="{{ route('login') }}" class="auth-link">Connexion</a></div>
        </div>
    </div>
</x-guest-layout>
