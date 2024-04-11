<?php

$routes = require('routes.php');

function routeToController($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        abort();
    }
}

function abort($code = 404)
{
    http_response_code($code);

    require "views/{$code}.view.php";

    die();
}


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
routeToController($uri, $routes);