<?php

$pageTitle = 'Add List';
require base_path('Validator.php');

$config = require base_path('config.php');
$db = new Database($config['database']);

$dbname = "myapp";
$dbtablename = "posts";
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {    

    if (! Validator::string($_POST['title'], 1, 300)) {
        $errors['title'] = 'A title is required and cannot be empty*';
    }

    if (!Validator::string($_POST['synopsis'], 1, 1500)) {
        $errors['synopsis'] = 'A  description is required and cannot be empty*';
    }

    if (empty($errors)) {
        $db->query('INSERT INTO posts(title, author, synopsis) VALUES(:title, :author, :synopsis)', [
            'title' => $_POST['title'],
            'author' => 2,
            'synopsis' => $_POST['synopsis'],
        ]);
        header('Location: /notes');
        exit;
    }

}

require view('notes/create.view.php', [
    'errors' => $errors ?? [],
    'old' => $_POST ?? [],
]);