<?php

use Core\App;
use Core\Database;

$pageTitle = 'Movies';

$db = App::resolve(Database::class);

$userID = $_SESSION['user']['id'];

$notes = $db->query('select * from posts where author = :id', [
    'id' => $userID,
])->get();

view('notes/index.view.php', [
    'notes' => $notes,
]);