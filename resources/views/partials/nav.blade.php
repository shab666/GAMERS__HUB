<nav>
    <div class="nav-left">
        <a href="{{ route('home') }}" class="nav-brand {{ request()->routeIs('home') ? 'active' : '' }}">
            <img src="{{ asset('images/logo.svg') }}" class="nav-logo" alt="Gamers Hub">
            <span class="brand-text">Gamers Hub</span>
        </a>
    </div>

    <div class="nav-links">
        <a href="{{ route('messages') }}" class="{{ request()->routeIs('messages') ? 'active' : '' }}">Messages</a>
        <a href="{{ route('games') }}" class="{{ request()->routeIs('games') ? 'active' : '' }}">Jeux</a>
        <a href="{{ route('settings') }}" class="{{ request()->routeIs('settings') ? 'active' : '' }}">Paramètres</a>
        @if(auth()->check() && auth()->user()->is_admin)
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.*') ? 'active' : '' }}">Administration</a>
        @endif
    </div>

    <div class="nav-auth">
        @guest
            <a href="{{ route('login') }}">Connexion</a>
            <a href="{{ route('register') }}">Inscription</a>
        @else
            <form method="POST" action="{{ route('logout') }}" style="display:inline">@csrf <button class="logout-btn">Déconnexion</button></form>
        @endguest
    </div>
</nav>