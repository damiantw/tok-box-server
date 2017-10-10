<?php

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

$app->configure('cors');

$app->register(Barryvdh\Cors\ServiceProvider::class);

$app->middleware([
    \Barryvdh\Cors\HandleCors::class,
]);

$app->register(App\Providers\AppServiceProvider::class);

$app->router->group(['namespace' => 'App\Http\Controllers'], function (Laravel\Lumen\Routing\Router $router) {

    $router->get('tok-box-session', 'TokBoxSessionController@index');

    $router->post('tok-box-session', 'TokBoxSessionController@store');

    $router->post('guide-tok-box-token/{sessionId}', 'GuideTokBoxTokenController@store');

    $router->post('customer-tok-box-token/{sessionId}', 'CustomerTokBoxTokenController@store');

});

return $app;