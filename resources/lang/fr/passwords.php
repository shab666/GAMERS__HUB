<?php
$php = json_decode(file_get_contents(base_path('vendor/laravel-lang/lang/locales/fr/php.json')), true) ?: [];

return [
    'password' => $php['password'] ?? 'Les mots de passe doivent comporter au moins six caractères et correspondre à la confirmation.',
    'reset' => $php['reset'] ?? 'Votre mot de passe a été réinitialisé !',
    'sent' => $php['sent'] ?? 'Nous vous avons envoyé par email le lien de réinitialisation du mot de passe !',
    'token' => $php['token'] ?? 'Ce jeton de réinitialisation du mot de passe n\'est pas valide.',
    'throttled' => $php['throttled'] ?? 'Veuillez patienter avant de réessayer.',
    'user' => $php['user'] ?? 'Aucun utilisateur n\'a été trouvé avec cette adresse email.',
];
