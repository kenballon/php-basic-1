<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Core\Authenticator;

$pageTitle = 'Movie';

$db = App::resolve(Database::class);

$movieID = $_POST['id'];

//get the note from the database
$note = $db->query('select * from posts where id = :id', [':id' => $movieID])->findOrFail();

//authorized user can update the note
authorize($note['author'] === 1);

//validate the input
$errors = validateInput(['title' => [1, 300], 'synopsis' => [1, 1500]]);
function validateInput($fields) {
    $errors = [];
    foreach ($fields as $field => $limits) {
        if (! Validator::string($_POST[$field], $limits[0], $limits[1])) {
            $errors[$field] = ucfirst($field) . ' is required and cannot be empty*';
        }
    }
    return $errors;
}

if(!empty(($errors)))
{
    return view('notes/edit.view.php', [
        'errors' => $errors,
        'note' => $note,
    ]);
}

// $authenticator = App::resolve(Authenticator::class);
// $userID = $authenticator->getUserIdByEmail($_SESSION['user']['email']);

$userID = $_SESSION['user']['id'];

//update the note in the database
$db->query('UPDATE posts SET title = :title, synopsis = :synopsis WHERE id = :id AND author = :author', [
    'title' => $_POST['title'],
    'synopsis' => $_POST['synopsis'],
    'id' => $movieID,
    'author' => $userID,
]);

//redirect to the notes page
header('Location: /notes');
exit;

