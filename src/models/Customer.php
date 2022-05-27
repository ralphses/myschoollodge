<?php 

namespace src\models;

class Customer extends Model {

    public int $customerID;

    public string $firstName;
    public string $lastName;
    public string $phoneNumber;
    public string $emailAddress;
    public string $messages;

    public array $rules = [

        'firstName' => [self::RULE_REQUIRED],
        'phoneNumber' => [self::RULE_REQUIRED, self::RULE_PHONE_NUMBER],
        'emailAddress' => [self::RULE_REQUIRED, self::RULE_EMAIL],
    ];

    public array $labels = [

        'firstName' => 'First name',
        'phoneNumber' => 'Phone number',
        'emailAddress' => 'Email address',
        'messages' => 'Enquiry message'

    ];

    public function rules(): array {
        return $this->rules;
    }

    public function labels(): array {
        return $this->labels;
    }

}