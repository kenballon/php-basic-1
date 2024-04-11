<?php

function dd($val)
{
    echo "<pre>";
    var_dump($val);
    echo "</pre>";

    die();
}

function urlIs($pageURL)
{
    // Extract the path from the current URL
    $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // Extract the path from the provided page URL
    $pagePath = parse_url($pageURL, PHP_URL_PATH);

    // Compare the paths
    return ($currentPath === $pagePath) ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white';
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }
}

function base_path($path = '')
{
    return BASE_PATH . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}