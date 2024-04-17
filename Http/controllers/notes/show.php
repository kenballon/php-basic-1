<?php

use Core\App;
use Core\Database;

$pageTitle = 'Movie';

$db = App::resolve(Database::class);

$movieID = $_GET['id'];

$note = $db->query('select * from posts where id = :id', [':id' => $movieID])->findOrFail();

authorize($note['author'] === 1);

view('notes/show.view.php', [
    'note' => $note,
]);
