<?php

namespace src\models;

class Agent extends Model{

    public string $agent_name;
    public string $agent_email;
    public string $agent_phone;
    public string $agency;
    public string $agent_agency_role;
    public string $agent_address;
    public string $agent_password;
    public string $agent_confirm_password;
    public string $agent_image = '';
    public string $agent_whatsapp;
    public string $agent_fb;
    public string $agent_twitter;
    public string $agent_id_no;
    public string $agent_id_type;
    public string $agent_id_image;
    public string $agent_agree = '';

    public array $rules = [
        'agent_name' => [self::RULE_REQUIRED],
        'agent_agree' => [self::RULE_REQUIRED],
        'agent_email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
        'agent_phone' => [self::RULE_REQUIRED, self::RULE_PHONE_NUMBER],
        'agent_password' => [self::RULE_REQUIRED, self::RULE_PASSWORD, [self::RULE_MIN, 'min' => 8]],
        'agent_confirm_password' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'agent_password']]
    ];

    public array $labels = [
        'agent_name' => 'Full Name',
        'agent_email' => 'Email address',
        'agent_phone' => 'Phone number',
        'agent_password' => 'Password',
        'agent_confirm_password' => 'Confirm Password',
        'agent_agree' => 'Agreement to terms and conditions'
    ];

    public array $socials = [];

    public function rules(): array {
        return $this->rules;
    }

    public function labels(): array {
        return $this->labels;
    }

}