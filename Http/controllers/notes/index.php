<?php

use Core\App;
use Core\Database;
use Core\Authenticator;

$pageTitle = 'Movies';

$db = App::resolve(Database::class);

// $authenticator = App::resolve(Authenticator::class);
// $userID = $authenticator->getUserIdByEmail($_SESSION['user']['email']);

$userID = $_SESSION['user']['id'];

$notes = $db->query('select * from posts where author = :id', [
    'id' => $userID,
])->get();

view('notes/index.view.php', [
    'notes' => $notes,
]);