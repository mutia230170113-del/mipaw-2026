<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Cek status maintenance
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Registrasi Auto Loader Vendor
require __DIR__.'/../vendor/autoload.php';

// Jalankan Aplikasi Laravel
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());