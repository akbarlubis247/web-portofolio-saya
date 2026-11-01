<?php

// Ensure writable directories exist in /tmp
$dirs = [
    '/tmp/views',
    '/tmp/cache',
    '/tmp/sessions',
    '/tmp/logs',
];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Copy sqlite database to /tmp if present
$dbSource = __DIR__ . '/../database/database.sqlite';
$dbTarget = '/tmp/database.sqlite';
if (file_exists($dbSource) && !file_exists($dbTarget)) {
    @copy($dbSource, $dbTarget);
}

// Forward Vercel requests to Laravel's entry point
require __DIR__ . '/../public/index.php';
