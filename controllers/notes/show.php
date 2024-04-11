<?php

$pageName = 'Movie';
$currentUserID = 2;

$config = require 'config.php';
$db = new Database($config['database']);

$movieID = $_GET['id'];

$note = $db->query('select * from posts where id = :id', [':id' => $movieID])->findOrFail();

authorize($note['author'] === $currentUserID);

require 'views/notes/show.view.php';