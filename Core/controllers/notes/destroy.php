<?php

use Core\App;
use Core\Database;

$pageTitle = 'Movie';

$db = App::resolve(Database::class);

$userID = $_SESSION['user']['id'] ?? false;

$movieID = $_POST['id'];

$note = $db->query('select * from posts where id = :id', [':id' => $movieID])->findOrFail();

authorize($note['author'] === 1);

$db->query('delete from posts where id = :id', [':id' => $movieID]);
header('Location: /notes');
exit;

