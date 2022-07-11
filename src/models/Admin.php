<?php 

namespace src\models;

class Admin extends Model {

    public string $name;
    public string $emailAddress;
    public string $phoneNumber;
    public string $role;
    public int $roleCode;

    public function rules(): array {
        return [
            'name' => [self::RULE_REQUIRED],
            'emailAddress' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'role' => [self::RULE_REQUIRED],
            'phoneNumber' => [self::RULE_REQUIRED, self::RULE_PHONE_NUMBER]
        ];
    }

    public function labels(): array {
        return [
            'name' => 'Full name',
            'emailAddress' => 'Email Address',
            'role' => 'Role',
            'phoneNumber' => 'Phone number'
        ];
    }
}