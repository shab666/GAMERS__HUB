<x-app-layout>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-brand">
                <div class="brand-text">Tableau de bord administrateur</div>
            </div>

            @if(session('status'))
                <div class="message" style="margin-bottom:12px">{{ session('status') }}</div>
            @endif
            @if(session('error'))
                <div class="message" style="margin-bottom:12px; border-left:3px solid #ff5252;">{{ session('error') }}</div>
            @endif

            <h3 style="margin-bottom:12px">Gestion des utilisateurs</h3>

            <div style="overflow:auto; max-height:420px;">
                <table style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr style="text-align:left; color:#cfcfff;">
                            <th style="padding:8px 6px;">#</th>
                            <th style="padding:8px 6px;">Nom</th>
                            <th style="padding:8px 6px;">Email</th>
                            <th style="padding:8px 6px;">Admin</th>
                            <th style="padding:8px 6px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr style="border-top:1px solid rgba(255,255,255,0.03)">
                                <td style="padding:8px 6px;">{{ $user->id }}</td>
                                <td style="padding:8px 6px;">{{ $user->name }}</td>
                                <td style="padding:8px 6px;">{{ $user->email }}</td>
                                <td style="padding:8px 6px;">{{ $user->is_admin ? 'Oui' : 'Non' }}</td>
                                <td style="padding:8px 6px; display:flex; gap:6px; align-items:center;">
                                    @if(auth()->id() !== $user->id)
                                        @if(! $user->is_admin)
                                            <form method="POST" action="{{ route('admin.users.promote', $user) }}" style="display:inline">
                                                @csrf
                                                @method('PATCH')
                                                <button class="primary-btn" type="submit" style="padding:6px 10px; font-size:13px">Promouvoir</button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('admin.users.demote', $user) }}" style="display:inline">
                                                @csrf
                                                @method('PATCH')
                                                <button class="primary-btn" type="submit" style="padding:6px 10px; font-size:13px">Démouvoir</button>
                                            </form>
                                        @endif

                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline" onsubmit="return confirm('Supprimer cet utilisateur ? Cette action est irréversible.');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="primary-btn" type="submit" style="padding:6px 10px; font-size:13px; background:linear-gradient(135deg,#ff616f,#ff8a80);">Supprimer</button>
                                        </form>
                                    @else
                                        <span style="color:#9a9acb; font-size:13px">(Vous)</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="margin-top:12px">{{ $users->links() }}</div>
        </div>
    </div>
</x-app-layout>
