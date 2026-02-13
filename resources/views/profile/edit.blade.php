<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="auth-container">
        <div style="width:100%;max-width:820px;display:flex;flex-direction:column;gap:18px;padding:24px">
            <div class="auth-card">
                <h2 style="margin-top:0">Informations du profil</h2>
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="auth-card">
                <h2 style="margin-top:0">Sécurité</h2>
                @include('profile.partials.update-password-form')
            </div>

            <div class="auth-card">
                <h2 style="margin-top:0">Suppression du compte</h2>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
