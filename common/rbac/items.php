<?php
return [
    'guest' => [
        'type' => 1,
        'description' => 'Nobody',
    ],
    'user' => [
        'type' => 1,
        'description' => 'Can use the query UI',
        'children' => [
            'guest',
        ],
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Can do anything including managing users',
        'children' => [
            'user',
        ],
    ],
];