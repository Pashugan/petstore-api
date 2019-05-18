<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    // Return the pet inventory
    $app->get('/v2/store/inventory', function (Request $request, Response $response, array $args) use ($container) {
        $response = $response->withHeader('Content-Type', 'application/json');

        // Should make a call to the Pets microservice to collect the inventory
        $api_response = new ApiResponse(501, 'Not implemented because of the dependency on external API (see the code)');

        return $response->withStatus($api_response->code)
            ->write(json_encode($api_response->toArray()));
    });

    // Create an order
    $app->post('/v2/store/order', function (Request $request, Response $response, array $args) use ($container) {
        $response = $response->withHeader('Content-Type', 'application/json');

        // Parse body JSON
        $data = $request->getParsedBody();

        // Populate a model
        $order = R::dispense('order');
        $order->id       = isset($data['id'])       ? $data['id']       : null;
        $order->petId    = isset($data['petId'])    ? $data['petId']    : null;
        $order->quantity = isset($data['quantity']) ? $data['quantity'] : null;
        $order->shipDate = isset($data['shipDate']) ? $data['shipDate'] : null;
        $order->status   = isset($data['status'])   ? $data['status']   : null;
        $order->complete = isset($data['complete']) ? $data['complete'] : null;

        // Validate the model
        $validation = R::validate($order);
        if ($validation !== true) {
            $parts = [];
            foreach ($validation as $msg) {
                $parts[] = $msg;
            }
            $api_response = new ApiResponse(400, implode(', ', $parts));
            return $response->withStatus($api_response->code)
                ->write(json_encode($api_response->toArray()));
        }

        // Save the model
        R::store($order);

        // Return status
        $api_response = new ApiOk;
        return $response->withStatus($api_response->code)
            ->write(json_encode($api_response->toArray()));
    });

    // Return an order by ID
    $app->get('/v2/store/order/{id:[0-9]+}', function (Request $request, Response $response, array $args) use ($container) {
        $response = $response->withHeader('Content-Type', 'application/json');

        // Load the order
        $order = R::load('order', $args['id']);
        if ($order->id === 0) {
            $api_response = new ApiOrderNotFound;
            return $response->withStatus($api_response->code)
                ->write(json_encode($api_response->toArray()));
        }

        // Serialize and return the order data
        return $response->getBody()
            ->write(json_encode(R::exportAll($order)[0]));
    });

    // Delete an order by ID
    $app->delete('/v2/store/order/{id:[0-9]+}', function (Request $request, Response $response, array $args) use ($container) {
        $response = $response->withHeader('Content-Type', 'application/json');

        // Try to load the order
        $order = R::load('order', $args['id']);
        if ($order->id === 0) {
            $api_response = new ApiOrderNotFound;
            return $response->withStatus($api_response->code)
                ->write(json_encode($api_response->toArray()));
        }

        // Delete the order
        R::trash($order);

        $api_response = new ApiOk;
        return $response->withStatus($api_response->code)
            ->write(json_encode($api_response->toArray()));
    });
};
