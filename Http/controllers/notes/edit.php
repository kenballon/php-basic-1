<?php

use Core\App;
use Core\Database;
use Core\Authenticator;

$pageTitle = 'Edit List';

$db = App::resolve(Database::class);

$userID = $_SESSION['user']['id'];

$movieID = $_GET['id'];

$note = $db->query('select * from posts where id = :id', [':id' => $movieID])->findOrFail();

authorize($note['author'] === $userID);

view('notes/edit.view.php', [
    'note' => $note,
    'errors' => $errors ?? [],
]);