<?php

return [
    'database' => [
        'name' => 'gezinshuis',
        'username' => 'root',
        'password' => 'toor',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
        ]
    ]
];
