<?php

use Core\App;
use Core\Database;
use Core\Validator;

$pageTitle = 'Movie';

$db = App::resolve(Database::class);

$currentUserID = 2;
$movieID = $_POST['id'];

//get the note from the database
$note = $db->query('select * from posts where id = :id', [':id' => $movieID])->findOrFail();

//authorized user can update the note
authorize($note['author'] === $currentUserID);

//validate the input
$errors = [];

if (! Validator::string($_POST['title'], 1, 300)) {
    $errors['title'] = 'A title is required and cannot be empty*';
}

if (!Validator::string($_POST['synopsis'], 1, 1500)) {
    $errors['synopsis'] = 'A  description is required and cannot be empty*';
}

if(!empty(($errors)))
{
    return view('notes/edit.view.php', [
        'errors' => $errors ?? [],
        'note' => $note,
    ]);
}

//update the note in the database
$db->query('UPDATE posts SET title = :title, synopsis = :synopsis WHERE id = :id AND author = :author', [
    'title' => $_POST['title'],
    'synopsis' => $_POST['synopsis'],
    'id' => $movieID,
    'author' => $currentUserID,
]);

//redirect to the notes page
header('Location: /notes');
exit;

