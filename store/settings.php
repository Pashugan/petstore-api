<?php
return [
    'settings' => [
        'displayErrorDetails' => DEBUG,
        'routerCacheFile' => DEBUG ? false : '../data/route_cache',

        'db' => [
            'host' => 'store-mysql',
            'user' => 'root',
            'pass' => DEBUG ? '' : 'roma7Wai',
            'dbname' => 'store',
        ],
    ],
];
