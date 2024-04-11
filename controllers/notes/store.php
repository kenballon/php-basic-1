<?php 

use Core\Validator;
use Core\Database;
use Core\App;


$db = App::resolve(Database::class);

$errors = [];

if (! Validator::string($_POST['title'], 1, 300)) {
    $errors['title'] = 'A title is required and cannot be empty*';
}

if (!Validator::string($_POST['synopsis'], 1, 1500)) {
    $errors['synopsis'] = 'A  description is required and cannot be empty*';
}

if(!empty(($errors)))
{
    return view('notes/create.view.php', [
        'errors' => $errors ?? [],
        'old' => $_POST ?? [],
    ]);
}

$db->query('INSERT INTO posts(title, author, synopsis) VALUES(:title, :author, :synopsis)', [
    'title' => $_POST['title'],
    'author' => 2,
    'synopsis' => $_POST['synopsis'],
]);
header('Location: /notes');
exit;