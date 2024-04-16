<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

// Check if account already exists
$db = App::resolve(Database::class);

// Validate form inputs
$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Your email address is invalid. Please try again.';
}

if (!Validator::string($password)) {
    $errors['password'] = 'Your password did not match. Please try again.';
}

if (!empty($errors)) {
    return view('sessions/create.view.php', ['errors' => $errors]);
}

$user = $db->query('SELECT * FROM users WHERE email = :email', ['email' => $email])->find();

if ($user && password_verify($password, $user['password'])) {

    login([
        'email' => $user['email'],
    ]);

    header('Location: /notes');
    exit();
}

return view('sessions/create.view.php', [
    'errors' => [
        'email' => 'Your email or password is incorrect. Please try again.',
    ]
]);
