<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

        'paths' => ['api/*'], // Cible toutes les routes d'API
        'allowed_methods' => ['*'], // Autoriser toutes les méthodes HTTP (GET, POST, PUT, etc.)
        'allowed_origins' => ['http://localhost:4200'], // Autoriser votre origine front-end Angular (http://localhost:4200)
        'allowed_origins_patterns' => [],
        'allowed_headers' => ['*'], // Autoriser tous les en-têtes
        'exposed_headers' => [],
        'max_age' => 0,
        'supports_credentials' => true, // Si vous utilisez des cookies ou des sessions
    ];


// 'paths' => ['api/', 'login', 'logout', 'refresh'],
// 'allowed_methods' => [''],
// 'allowed_origins' => [
//     'https://admirable-macaron-cbfcb1.netlify.app/',
//     'http://localhost:4200/',
// ],
// 'allowed_origins_patterns' => [],
// 'allowed_headers' => ['Content-Type', 'X-Requested-With', 'Authorization', 'Accept'],
// 'exposed_headers' => ['Authorization'],
// 'max_age' => 0,
// 'supports_credentials' => true,
// ];




