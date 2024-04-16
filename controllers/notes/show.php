<?php

use Core\App;
use Core\Database;

$pageTitle = 'Movie';

$db = App::resolve(Database::class);

$currentUserID = 5;
$movieID = $_GET['id'];

$note = $db->query('select * from posts where id = :id', [':id' => $movieID])->findOrFail();

authorize($note['author'] === $currentUserID);


require view('notes/show.view.php', [
    'note' => $note,
]);
