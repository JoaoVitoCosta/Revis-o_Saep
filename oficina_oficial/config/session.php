<?php

return [
    'driver' => env('SESSION_DRIVER', 'file'),
    // Expiração da sessão em minutos conforme regra de negócio do gestor
    'lifetime' => (int) env('SESSION_LIFETIME', 15),
    'expire_on_close' => true,
    'encrypt' => true,
    'files' => storage_path('framework/sessions'),
    'cookie' => env('SESSION_COOKIE', 'oficina_session'),
    'path' => '/',
    'domain' => env('SESSION_DOMAIN'),
    'secure' => env('SESSION_SECURE_COOKIE'),
    'http_only' => true,
    'same_site' => 'lax',
];
