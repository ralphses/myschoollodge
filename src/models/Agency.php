<?php

namespace src\models;

class Agency extends Model {

    public string $name;
    public string $phone;
    public string $email;
    public string $agency_password;
    public string $confirm_agency_password;
    public string $description;
    public string $speciality;
    public string $certification_status;
    public string $certification_firm;
    public string $certificate_no;
    public string $cover_image;
    public string $feature_image;
    public string $address_line;
    public string $nearest_bustop;
    public string $area;
    public string $city;
    public string $state;

    public array $rules = [

        'name' => [self::RULE_REQUIRED],
        'phone' => [self::RULE_REQUIRED, self::RULE_PHONE_NUMBER],
        'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
        'agency_password' => [self::RULE_REQUIRED, self::RULE_PASSWORD, [self::RULE_MIN, 'min' => 8]],
        'confirm_agency_password' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'agency_password']],
        'certification_status' => [self::RULE_REQUIRED],
        'address_line' => [self::RULE_REQUIRED],
        'city' => [self::RULE_REQUIRED],
        'state' => [self::RULE_REQUIRED]
    ];

    public array $labels = [

        'name' => 'Agency title',
        'phone' => 'Phone number',
        'email' => 'Email address',
        'agency_password' => 'Password',
        'confirm_agency_password' => 'Confirm password',
        'certification_status' => 'Certification status',
        'address_line' => 'Address line',
        'city' => 'Office location city',
        'state' => 'Office location state'

    ];
    
    public function rules(): array {
        return $this->rules;
    }

    public function labels(): array {
        return $this->labels;
    }

}