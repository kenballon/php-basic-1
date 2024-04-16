<?php

use Core\Response;

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

function abort($status = Response::NOT_FOUND)
{
    http_response_code($status);
    require base_path("views/{$status}.view.php");
    die();
}

function base_path($path = '')
{
    return BASE_PATH . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}

function view($path, $attr = [])
{
    extract($attr);
    return require base_path('views/' . $path);
}

function login($user)
{
    $_SESSION['user'] = [    
        'email' => $user['email']
    ];

    session_regenerate_id(true);
}

function logout()
{
    $_SESSION = [];
    session_destroy();

    $params = session_get_cookie_params();

    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

    header('Location: /');
    exit();
}