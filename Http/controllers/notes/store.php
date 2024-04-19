<?php 

use Core\App;
use Core\Database;
use Core\Validator;


$db = App::resolve(Database::class);

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
    return view('notes/create.view.php', [
        'errors' => $errors ?? [],
    ]);
}

$userID = $_SESSION['user']['id'];

$db->query('INSERT INTO posts(title, author, synopsis) VALUES(:title, :author, :synopsis)', [
    'title' => $_POST['title'],
    'author' => $userID,
    'synopsis' => $_POST['synopsis'],
]);
header('Location: /notes');
exit;