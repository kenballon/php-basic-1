<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

// Validate form inputs
$errors = [];

if(!Validator::email($email)){
    $errors['email'] = 'Please enter a valid email address';
}

if(!Validator::string($password, 7, 255)){
    $errors['password'] = 'Please provide a password with at least 7 characters';
}

if(!empty($errors)){
    return view('registration/create.view.php', ['errors' => $errors]);
}

// Check if account already exists
$db = App::resolve(Database::class);

$user = $db->query('SELECT * FROM users WHERE email = :email', ['email' => $email])->find();

// If yes, redirect back to login page with error message
if($user){
    header('Location: /');
    exit;
}else{
    $db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    $_SESSION['user'] = [    
        'email' => $email
    ];

    header('Location: /notes');
    exit;
}
