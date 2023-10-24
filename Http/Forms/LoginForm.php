<?php


namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
  protected $errors = [];

  public function __construct(public array $attributes)
  {
    $this->attributes = $attributes;


    //validate email
    if (!Validator::validateEmail($attributes['log_email'])) {
      $this->errors['log_email'] = 'You must provide a valid Email';
    }


    // validate password
    if (!Validator::sanitizeText($attributes['log_password'])) {
      $this->errors['log_password'] = 'You must provide a password.';

    }
  }

  public static function validate($attributes)
  {
    $instance = new static($attributes);

    return $instance->failed() ? $instance->throw() : $instance;
  }

  public function throw ()
  {
    return ValidationException::throw($this->errors(), $this->attributes);
  }

  public function failed()
  {
    return count($this->errors);
  }

  public function errors()
  {
    return $this->errors;
  }
  public function passError($field, $message)
  {
    $this->errors[$field] = $message;
    return $this;
  }
}