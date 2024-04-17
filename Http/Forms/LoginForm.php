<?php

namespace Http\Forms;

use Core\Validator;


class LoginForm
{
    protected $errors = [];
    public function validate($email, $password)
    {

        if (!Validator::email($email)) {
            $this->errors['email'] = 'Your email address is invalid. Please try again.';
        }

        if (!Validator::string($password)) {
            $this->errors['password'] = 'Your password did not match. Please try again.';
        }

        return empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }
}
