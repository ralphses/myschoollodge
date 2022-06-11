<?php 

namespace src\models;

class Property extends Model {

    //Identity properties
    public int $propertyID;
    public int $agentID;
    public int $locationID;
    public string $code;
    
    //Property basic details
    public string $propertyName;
    public string $propertyType;
    public string $propertyPrice;

    //Propety location details
    public string $propertyAddressLine;
    public string $propertyLocationCity;
    public string $propertyLocationState;
    public string $propertyLocationArea;
    public string $propertyNearestBustop;

    //property images
    public string $propertyFeaturedImage;

    //Property other details
    public string $propertyDescription;
    public string $propertyTimeToGetToSchool;
    public string $propertyState;
    public string $userAgree ='';

    //Facilities found in this property
    public array $facilities;

    //images for this property
    public array $images;

    //Validation rules
    public array $rules = [

        'propertyName' =>[ self::RULE_REQUIRED],
        'propertyType' => [self::RULE_REQUIRED],
        'propertyPrice' => [self::RULE_REQUIRED],
        'propertyAddressLine' => [self::RULE_REQUIRED],
        'propertyLocationCity' => [self::RULE_REQUIRED],
        'propertyLocationState' => [self::RULE_REQUIRED],
        'propertyState' => [self::RULE_REQUIRED],
        'userAgree' => [self::RULE_REQUIRED]

    ];

    public array $labels = [

        'propertyName' => 'Lodge title',
        'propertyType' => 'Lodge type',
        'propertyPrice' => 'Rent cost',
        'propertyAddressLine' => 'Address line',
        'propertyLocationCity' => 'City',
        'propertyLocationState' => 'State',
        'propertyState' => 'Lodge status',
        'userAgree' => 'Agreement to T&C'

    ];

    public function rules(): array {
        return $this->rules;
    }

    public function labels(): array {
        return $this->labels;
    }

}