<?php
use Slim\App;

return function (App $app) {
    //$app->add(new \Slim\Csrf\Guard);
    $app->add(new Tuupola\Middleware\CorsMiddleware);
};
