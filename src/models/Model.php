<?php 

namespace src\models;

abstract class Model {

    public array $errors = [];

    /**
     * Rules for user input authenttication
     */
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_PHONE_NUMBER = 'phone';
    public const RULE_MAX = 'max';
    public const RULE_MIN = 'min';
    public const RULE_MATCH = 'match';
    public const RULE_PASSWORD = 'password';
    public const RULE_CHECKED = 'checked';


    /**
     * Abstract methods to be defined by child classes
     */
    public abstract function rules(): array;
    public abstract function labels(): array;

    /**
     * Initialize this object with user inputs
     */
     public function loadData($data) {
         $body = [];
        foreach($data as $key => $value) {
            if(property_exists($this, $key)) {
                $this->$key = $value;
                $body[$key] = $value;
            }
        }
        return $body;
     }

     /**
      * Error messages to be displayed to user
      */
      public function errorMessage() {
          return [
            self::RULE_EMAIL => '{attribute} must be valid email address',
            self::RULE_MATCH => '{attribute} must be the same as {match}',
            self::RULE_MAX => '{attribute} must not exceed {max}',
            self::RULE_MIN => '{attribute} length must not be less than {min}',
            self::RULE_PHONE_NUMBER => '{attribute} must be a valid Nigerian phone number',
            self::RULE_REQUIRED => '{attribute} is required',
            self::RULE_PASSWORD => '{attribute} must contain at least a lower and an upper case and a number',
            self::RULE_CHECKED => '{attribute} must be checked',
          ];
      }

      public function addRules($rules) {
        foreach($rules as $attribute => $rule) {
            $this->rules[$attribute] = $rule;
        }
    }

    public function addLabels($labels) {
        foreach($labels as $attribute => $label) {
            $this->labels[$attribute] = $label;
        }
    }

      /**
       * Add errors as they come
       */
      public function addError($attribute, $errorType, $params = []) {
          $errorMessage = $this->errorMessage()[$errorType] ?? '';
          $errorMessage = str_replace('{attribute}', $this->labels()[$attribute], $errorMessage);

          foreach($params as $key => $value) {
              $errorMessage = str_replace("{{$key}}", $value, $errorMessage);
          }
          $this->errors[$attribute][] = $errorMessage;
      }

      /**
       * Function to validate user inputs
       */
       public function validate() {
        foreach($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach($rules as $rule) {
                $ruleName = $rule;
                if(!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }

                //Make real validations
                if($ruleName === self::RULE_CHECKED and $value == '') {
                    $this->addError($attribute, self::RULE_CHECKED);
                } 
                if($ruleName === self::RULE_EMAIL and !filter_var($value, FILTER_SANITIZE_EMAIL)){
                    $this->addError($attribute, self::RULE_EMAIL);
                }
                else if($ruleName === self::RULE_EMAIL and !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }

                if($ruleName === self::RULE_MIN and strlen($value) < strlen($rule['min'])) {
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }

                if($ruleName === self::RULE_MAX and strlen($value) > strlen($rule['max'])) {
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }

                if($ruleName === self::RULE_MATCH and $value !== $this->{$rule['match']}) {
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }
                if($ruleName === self::RULE_PHONE_NUMBER and preg_match('/[^0-9]/', $value)) {
                    $this->addError($attribute, self::RULE_PHONE_NUMBER);
                }
                if($ruleName === self::RULE_REQUIRED and !$value) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                } 
                if($ruleName === self::RULE_PASSWORD and !preg_match('@[0-9]@', $value) and !preg_match('@[A-Z]@', $value) and !preg_match('@[a-z]@', $value)) {
                    $this->addError($attribute, self::RULE_PASSWORD);
                }
                
                

            }
        }
        return empty($this->errors);
    }
}

