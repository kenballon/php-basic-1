<?php

namespace Core;

class ValidationException extends \Exception
{
    public readonly array $errors;
    public readonly array $old;

    public static function throw($errors, $old)
    {
        $exception = new static();
        $exception->errors = $errors;
        $exception->old = $old;

        throw $exception;
    }
}
