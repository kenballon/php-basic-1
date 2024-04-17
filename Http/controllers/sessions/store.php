<?php

use Core\Authenticator;
use Core\Session;
use Core\ValidationException;
use Http\Forms\LoginForm;

// Validate form inputs
try {
    $form = LoginForm::validate($attributes = [
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ]);

} catch (ValidationException $exception) {
    
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    return redirect('/login');
}

// Attempt to authenticate the user
if ((new Authenticator)->attempt($attributes['email'], $attributes['password'])) {
    redirect('/notes');
} else {
    Session::flash('errors', ['email' => 'Your email does not exist in our database. Kindly register an account.']);
    return redirect('/login');
}