<?php

$pageName = 'Add List';
require 'Validator.php';

$config = require 'config.php';
$db = new Database($config['database']);

$dbname = "myapp";
$dbtablename = "posts";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {    
    $errors = [];

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
    }

}

require 'views/notes/create.view.php';