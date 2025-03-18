<?php
return [
    'app' => [
        'name' => 'Web Scheduling',
        'debug' => true,
        'timezone' => 'UTC',
    ],
    'security' => [
        'csrf_timeout' => 7200,
        'session_timeout' => 3600,
    ],
    'pagination' => [
        'items_per_page' => 10
    ]
];