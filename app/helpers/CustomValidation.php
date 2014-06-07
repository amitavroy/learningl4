<?php

class CustomValidation extends Illuminate\Validation\Validator {

  public function validateMatchpass($attribute, $value, $parameters)
  {
    $cPassword = $parameters[0];
    if ($cPassword == $value)
      return $value == $cPassword;
  }
}