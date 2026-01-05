<?php
return [
    // Set to 'gmail' (app password required) or 'mailtrap' (for testing)
    'provider' => 'gmail',

    'gmail' => [
        'host' => 'smtp.gmail.com',
        'port' => 587,
        'encryption' => 'tls', // or 'ssl' for port 465
        'username' => 'eventy.industries@gmail.com',
        // App password must be entered WITHOUT spaces; shown grouped by Google UI
        'password' => 'nxubvkdzmuxwabxh',
        'from' => [
            'address' => 'eventy.industries@gmail.com',
            'name' => 'Eventy Verification',
        ],
    ],

    // Mailtrap (recommended for testing HTML rendering)
    'mailtrap' => [
        'host' => 'smtp.mailtrap.io', // or 'smtp.mailtrap.cloud' depending on account
        'port' => 2525, // 2525 or 587
        'encryption' => 'tls',
        'username' => 'YOUR_MAILTRAP_USERNAME',
        'password' => 'YOUR_MAILTRAP_PASSWORD',
        'from' => [
            'address' => 'no-reply@example.com',
            'name' => 'Eventy Verification',
        ],
    ],
];
