<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

// Check if account already exists
$db = App::resolve(Database::class);

// Validate form inputs
$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Please enter a valid email address';
}

if (!Validator::string($password, 6, 255)) {
    $errors['password'] = 'Please provide a password with at least 6 characters';
}

if (!empty($errors)) {
    return view('registration/create.view.php', ['errors' => $errors]);
}

$user = $db->query('SELECT * FROM users WHERE email = :email', ['email' => $email])->find();

// If yes, redirect back to login page with error message
if($user){
    header('Location: /login');
    exit();
}else{
    $db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

   (new Authenticator)->login($user);

    header('Location: /');
    exit();
}
