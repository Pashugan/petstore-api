<?php

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    $container['notFoundHandler'] = function ($c) {
        return function ($request, $response) use ($c) {
            return $response->withStatus(404)
                ->withHeader('Content-Type', 'application/json');
        }
    }
};
