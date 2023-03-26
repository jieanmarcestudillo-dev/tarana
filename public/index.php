<?php

// use Illuminate\Contracts\Http\Kernel;
// use Illuminate\Http\Request;

// define('LARAVEL_START', microtime(true));

// if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
//     require $maintenance;
// }

// require __DIR__.'/../vendor/autoload.php';

// $app = require_once __DIR__.'/../bootstrap/app.php';

// $kernel = $app->make(Kernel::class);

// $response = $kernel->handle(
//     $request = Request::capture()
// )->send();

// $kernel->terminate($request, $response);



define('LARAVEL_START', microtime(true));

require __DIR__.'/../laravel/vendor/autoload.php';

$app = require_once __DIR__.'/../laravel/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
$response->send();
$kernel->terminate($request, $response);
