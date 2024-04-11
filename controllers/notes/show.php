<?php

use Core\Database;

$pageTitle = 'Movie';
$currentUserID = 2;

$config = require base_path('config.php');
$db = new Database($config['database']);

$movieID = $_GET['id'];

$note = $db->query('select * from posts where id = :id', [':id' => $movieID])->findOrFail();

authorize($note['author'] === $currentUserID);

require view('notes/show.view.php', [
    'note' => $note,
]);