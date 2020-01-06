<?php
namespace Classes\Helpers\Validation;

use Zend\Validator\EmailAddress;
use Zend\I18n\Validator\Alpha;

class Form
{

    public $errors = array();

    private $name, $value;

    public function name($name)
    {
        $this->name = $name;
        return $this;
    }

    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    public function alpha(bool $space = false): Form
    {
        $validator = new \Zend\I18n\Validator\Alpha();
        $error_msg = "This field must only consist of alphabets.";
        if ($space) {
            $error_msg = "This field must only consist of alphabets and white spaces.";
            $validator->setAllowWhiteSpace(true);
        }

        if (! $validator->isValid($this->value)) {
            // value contains only allowed chars

            $this->errors[$this->name]['alpha_not_valid'] = true;
            $this->errors[$this->name]['message'] = $error_msg;
        }

        unset($validator);

        return $this;
    }

    public function alnum(bool $space = false): Form
    {
        $validator = new \Zend\I18n\Validator\Alnum();
        $error_msg = "This field must only consist of alphabets and numbers";

        if ($space) {
            $error_msg = "This field must only consist of alphabets, numbers, and white spaces.";
            $validator->setAllowWhiteSpace(true);
        }

        if ($validator->isValid($this->value) == flase) {
            // value contains only allowed chars

            $this->errors[$this->name]['alnum_not_valid'] = true;
            $this->errors[$this->name]['message'] = $error_msg;
        }

        unset($validator);
        return $this;
    }

    public function email(): Form
    {
        $error_msg = "Please type a valid email.";

        $validator = new EmailAddress();

        if (! $validator->isValid($this->value)) {
            $this->errors[$this->name]['email_not_valid'] = true;
            $this->errors[$this->name]['message'] = $error_msg;

            foreach ($validator->getMessages() as $message) {
                $this->errors[$this->name][] = $message;
            }
        }
        unset($validator);
        
        return $this;
    }

    public function required()
    {
        $valid = new \Zend\Validator\NotEmpty();
        $result = $valid->isValid($this->value);

        if (! $result) {
            $this->errors[$this->name]['required'] = true;
            $this->errors[$this->name]['message'] = "This field is required.";
        }
        unset($valid);
        return $this;
    }

    public function min($length)
    {
        if (is_string($this->value)) {

            if (strlen($this->value) < $length) {
                $this->errors[$this->name]['min_not_valid'] = true;
                $this->errors[$this->name]['message'] = "Must be at least {$length} characters long.";
            }
        } else {

            if ($this->value < $length) {
                $this->errors[$this->name]['min_not_valid'] = true;
                $this->errors[$this->name]['message'] = "Minimum length must be {$length}.";
            }
        }
        
        return $this;
    }

    public function phone_number()
    {
        if (! $this->validatePhone()) {
            $this->errors[$this->name]['phone_not_valid'] = true;
            $this->errors[$this->name]['message'] = "please type in a valid phone number.";
        }
        return $this;
    }

    public function max($length)
    {
        if (is_string($this->value)) {

            if (strlen($this->value) > $length) {
                $this->errors[$this->name]['max_not_valid'] = true;
                $this->errors[$this->name]['message'] = "Maximum length must be {$length}.";
            }
        } else {

            if ($this->value > $length) {
                $this->errors[$this->name]['max_not_valid'] = true;
                $this->errors[$this->name]['message'] = "Maximum length must be {$length}.";
            }
        }
        return $this;
    }

    public function has_uppercase()
    {
        if (! preg_match('/[A-Z]/', $this->value)) {
            $this->errors[$this->name]['uppercase_not_valid'] = true;
            $this->errors[$this->name]['message'] = "Must have at least one uppercase letter.";
        }

        return $this;
    }

    public function has_lowercase()
    {
        if (! preg_match('/[a-z]/', $this->value)) {
            $this->errors[$this->name]['lowercase_not_valid'] = true;
            $this->errors[$this->name]['message'] = "Must have at least one lowercase letter.";
        }

        return $this;
    }

    public function has_digit()
    {
        if (! preg_match('/\d/', $this->value)) {
            $this->errors[$this->name]['hasdigit_not_valid'] = true;
            $this->errors[$this->name]['message'] = "Must have at least one digit.";
        }

        return $this;
    }

    public function equal($value): Form
    {
        if ($this->value != $value) {
            $this->errors[$this->name]['equals_invalid'] = true;
        }
        return $this;
    }
    
    public function isfloat()
    {
        $validator = new \Zend\I18n\Validator\IsFloat();
        
        if(!$validator->isValid($this->value))
        {
            $this->errors[$this->name]['float_invalid'] = true;
            $this->errors[$this->name]['message'] = 'Number must be a float';
            
            
        }
       return $this;
    }

    public function isSuccess(): bool
    {
        if (empty($this->errors))
            return true;
        else
            return false;
    }

    public function getErrors()
    {
        if (! $this->isSuccess())
            return $this->errors;
    }

	
	//country code is taken separately, not from here.
    private function validatePhone()
    {
        $correctLength = 10;
        $pattern = '[0-9]+';

        // Check phone number length.
        if (strlen($this->value) != $correctLength) {
            return false;
        }

        $regex = '/^(' . $pattern . ')$/u';
        if ( $this->value != '' && ! preg_match($regex, $this->value)) {
            return false;
        }

        return true;
    }
}
