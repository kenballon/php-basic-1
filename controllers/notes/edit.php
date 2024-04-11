<?php

use Core\Database;

$pageTitle = 'Add List';

$config = require base_path('config.php');
$db = new Database($config['database']);

$dbname = "myapp";
$dbtablename = "posts";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $db->query('INSERT INTO posts(title, author, synopsis) VALUES(:title, :author, :synopsis)', [
        'title' => $_POST['title'],
        'author' => 4,
        'synopsis' => $_POST['synopsis'],
    ]);

}

require view('notes/edit.view.php', [
    'errors' => $errors ?? [],
    'old' => $_POST ?? [],
]);