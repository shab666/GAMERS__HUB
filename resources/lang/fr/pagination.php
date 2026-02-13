<?php
$php = json_decode(file_get_contents(base_path('vendor/laravel-lang/lang/locales/fr/php.json')), true) ?: [];

return [
    'previous' => $php['previous'] ?? '&laquo; Précédent',
    'next' => $php['next'] ?? 'Suivant &raquo;',
];
