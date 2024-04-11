<?php

use Core\Database;

$pageTitle = 'Movie';

$config = require base_path('config.php');
$db = new Database($config['database']);

$currentUserID = 2;
$movieID = $_POST['id'];

$note = $db->query('select * from posts where id = :id', [':id' => $movieID])->findOrFail();

authorize($note['author'] === $currentUserID);

$db->query('delete from posts where id = :id', [':id' => $movieID]);
header('Location: /notes');
exit;


