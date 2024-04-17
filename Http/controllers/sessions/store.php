<?php

use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];


// Validate form inputs
$form = new LoginForm();

if ($form->validate($email, $password)) {

    // Attempt to authenticate the user
    if ((new Authenticator)->attempt($email, $password)) {
        redirect('/');
    }

    $form->error('email', 'Email or password is incorrect. Please try again.');
}

Session::flash('errors', $form->errors());

return redirect('/login');

// return view('sessions/create.view.php', [
//     'errors' => $form->errors(),
// ]);
