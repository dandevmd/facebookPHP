<?php


namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class RegistrationForm
{
  protected $errors = [];

  public function __construct(public array $attributes)
  {
    $this->attributes = $attributes;
    //validate first 
    if (!Validator::sanitizeText($attributes['reg_fname'])) {
      $this->errors['reg_fname'] = 'You must provide  first name';
    }

    //and last name 
    if (!Validator::sanitizeText($attributes['reg_lname'])) {
      $this->errors['reg_lname'] = 'You must provide last name';
    }

    //validate email
    if (!Validator::validateEmail($attributes['reg_email'])) {
      $this->errors['reg_email'] = 'You must provide a valid Email';


      if (!Validator::confirmEmail($attributes['reg_email'], $attributes['reg_confirm_email'])) {
        $this->errors['reg_confirm_email'] = 'Email does not match with confirm email field';
      }
    }


    // validate password
    if (!Validator::sanitizeText($attributes['reg_password'])) {
      $this->errors['reg_password'] = 'You must provide a password.';

      if (!Validator::confirmPassword($attributes['reg_password'], $attributes['reg_confirm_password'])) {
        $this->errors['reg_confirm_password'] = 'password does not match with confirm password field';
      }
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