<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(\App\Http\Middleware\IsAdmin::class);
    }

    public function dashboard()
    {
        $users = User::paginate(15);

        return view('admin.dashboard', compact('users'));
    }

    /**
     * Promote a user to admin.
     */
    public function promote(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas promouvoir/démouvoir votre propre compte.');
        }

        $user->is_admin = true;
        $user->save();

        return back()->with('status', "{$user->name} est maintenant administrateur.");
    }

    /**
     * Demote a user from admin.
     */
    public function demote(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas promouvoir/démouvoir votre propre compte.');
        }

        $user->is_admin = false;
        $user->save();

        return back()->with('status', "{$user->name} n'est plus administrateur.");
    }

    /**
     * Delete a user.
     */
    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $name = $user->name;
        $user->delete();

        return back()->with('status', "Utilisateur {$name} supprimé.");
    }
}
