<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;


class LoginForm
{
    protected $errors = [];

    public function __construct(public array $attributes)
    {
        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Your email address is invalid. Please try again.';
        }

        if (!Validator::string($attributes['password'])) {
            $this->errors['password'] = 'Your password did not match. Please try again.';
        }        
    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);

        if($instance->hasErrors()) {
           ValidationException::throw($instance->errors(), $instance->attributes);
        }

        return $instance;
    }

    public function hasErrors()
    {
        return count($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function error($field, $message)
    {
        $this->errors[$field] = $message;
    }
}
