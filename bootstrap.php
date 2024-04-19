<?php

use Core\App;
use Core\Database;
use Core\Container;
use Core\Middleware\Middleware;

$container = new Container;

$container->bind('Core\Database', function () {

    $config = require base_path('config.php');
    return new Database($config['database']);

});

$container->bind('Core\Authenticator', function () {
    return new \Core\Authenticator;
});

App::setContainer($container);
Middleware::resolve('userID');