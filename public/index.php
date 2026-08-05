<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Baris ini diubah: ditambah ../
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Baris ini diubah: ditambah ../
require __DIR__.'/../vendor/autoload.php';

/** @var Application $app */

// Baris ini diubah: ditambah ../
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
