<?php

use Core\App;
use Core\Database;

$pageTitle = 'Movies';

$db = App::resolve(Database::class);

// $userId = $_SESSION['user']['password'];
// $userEmail = $_SESSION['user']['email'];

// dd("{$userId} {$userEmail}");

$notes = $db->query('select * from posts where author = :id', [
    'id' => 1
])->get();

view('notes/index.view.php', [
    'notes' => $notes,
]);