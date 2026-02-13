<?php
$php = json_decode(file_get_contents(base_path('vendor/laravel-lang/lang/locales/fr/php.json')), true) ?: [];
$translations = [];

foreach ($php as $key => $value) {
    $parts = explode('.', $key);
    $ref = &$translations;

    foreach ($parts as $part) {
        if (! isset($ref[$part]) || ! is_array($ref[$part])) {
            $ref[$part] = [];
        }

        $ref = &$ref[$part];
    }

    $ref = $value;
    unset($ref);
}

return $translations;
