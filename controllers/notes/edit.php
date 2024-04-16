<?php

use Core\App;
use Core\Database;

$pageTitle = 'Edit List';

$db = App::resolve(Database::class);

$currentUserID = 5;
$movieID = $_GET['id'];

$note = $db->query('select * from posts where id = :id', [':id' => $movieID])->findOrFail();

authorize($note['author'] === $currentUserID);

require view('notes/edit.view.php', [
    'note' => $note,
    'errors' => $errors ?? [],
]);