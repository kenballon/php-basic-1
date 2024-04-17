<?php

use Core\Session;

$pageTitle = 'Login your account';

view('sessions/create.view.php', [
    'errors' => Session::get('errors'),
]);