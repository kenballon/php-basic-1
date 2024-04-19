<?php

use Core\App;
use Core\Database;
use Core\Authenticator;

$pageTitle = 'Movie';

$db = App::resolve(Database::class);

$movieID = $_GET['id'];

// $authenticator = App::resolve(Authenticator::class);
// $userID = $authenticator->getUserIdByEmail($_SESSION['user']['email']);

$userID = $_SESSION['user']['id'];

$note = $db->query('select * from posts where id = :id', [':id' => $movieID])->findOrFail();

authorize($note['author'] === $userID);

view('notes/show.view.php', [
    'note' => $note,
]);
