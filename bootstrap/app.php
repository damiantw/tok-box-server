<?php

use Laravel\Lumen\Routing\Router;

require_once __DIR__.'/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__.'/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
}


$app = new Laravel\Lumen\Application(
    realpath(__DIR__.'/../')
);

$app->withEloquent();

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->register(App\Providers\AppServiceProvider::class);

$app->router->group(['namespace' => 'App\Http\Controllers'], function (Router $router) {

    $router->get('/tok-box-session', \App\Http\Controllers\TokBoxSessionController::class.'@index');

    $router->post('/tok-box-session', \App\Http\Controllers\TokBoxSessionController::class.'@store');

    $router->post('/guide-tok-box-token/{sessionId}', \App\Http\Controllers\GuideTokBoxTokenController::class.'@store');

    $router->post('/customer-tok-box-token/{sessionId}', \App\Http\Controllers\CustomerTokBoxTokenController::class.'@store');

});

return $app;