<?php
$php = json_decode(file_get_contents(base_path('vendor/laravel-lang/lang/locales/fr/php.json')), true) ?: [];

return [
    'failed' => $php['failed'] ?? 'Ces identifiants ne correspondent pas à nos enregistrements.',
    'throttle' => $php['throttle'] ?? 'Tentatives de connexion trop nombreuses. Veuillez essayer de nouveau dans :seconds secondes.',
];
