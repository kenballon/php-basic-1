<?php

use Core\App;
use Core\Database;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

// Check if account already exists
$db = App::resolve(Database::class);

// Validate form inputs
$form = new LoginForm();

if(!$form->validate($email, $password)) {
    return view('sessions/create.view.php', [
        'errors' => $form->errors()
    ]);
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
