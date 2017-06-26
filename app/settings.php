<?php
return [
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails' => true,

        // monolog settings
        'logger' => [
            'name' => 'app',
            'path' => __DIR__ . '/../log/app.log',
        ],

        //session
        'session' => [
            'name' => 'SlimFramework3',
            'lifetime' => 7200,
            'path' => null,
            'domain' => null,
            'secure' => true,
            'httponly' => true,
            'cache_limiter' => 'nocache',
        ],

        // View settings
        'view' => [
            'template_path' => __DIR__ . '/src/View',
            'twig' => [
                'cache' => __DIR__ . '/../cache/twig',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],

        'path-templates' => __DIR__ . '/../templates',

        'photo' => [
            'extension-save' => ".png",
            'save-path' => __DIR__ . "/../public/save"
        ]
    ],
];
