<?php
define('DEBUG', getenv('DEBUG') == 'true');
define('REDBEAN_MODEL_PREFIX', '\\');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/rb-mysql.php';

session_start();

$settings = require '/run/secrets/store-settings.php';
$app = new \Slim\App($settings);

// Set up the database connection
$db_settings = $settings['settings']['db'];
R::setup('mysql:host=' . $db_settings['host'] . ';dbname=' . $db_settings['dbname'], $db_settings['user'], $db_settings['pass']);
R::useExportCase('camel');

R::freeze(true); // disable modifying the structure
R::ext('validate', function($bean) {
    return Filisko\RedBeanPHP\Plugin\ModelValidation::validate($bean);
});

$middleware = require __DIR__ . '/../src/middleware.php';
$middleware($app);

$routes = require __DIR__ . '/../src/routes_v2.php';
$routes($app);

$app->run();

R::close();
