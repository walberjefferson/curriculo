<?php

return [
    'name' => 'Authentication',
    'user_default' => [
        'name' => env('USER_NAME', 'Administrador'),
        'cpf' => env('USER_PASSWORD', '00000000000'),
        'email' => env('USER_EMAIL', 'admin@user.com'),
        'password' => env('USER_PASSWORD', '123456'),
    ],
    'acl' => [
        'role_admin' => env('ROLE_ADMIN', 'Admin'),
        'controller_annotations' => [
            __DIR__ . '/../Http/Controllers',
            base_path('app/Http/Controllers/Admin'),
        ]
    ]
];
