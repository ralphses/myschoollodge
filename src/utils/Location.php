<?php

namespace src\utils;

use src\models\ModelDAO\ModelDAO;
use src\models\ModelDAO\UtilDAO;

class Location {

    private string $address_line;
    private string $city;
    private string $state;
    private string $nearest_bustop = '';
    private string $area;

    private function __construct(string $address_line, string $city, string $state, string $nearest_bustop, string $area) {

        $this->address_line = $address_line;
        $this->city = $city;
        $this->state = $state;
        $this->nearest_bustop = $nearest_bustop ?? '';
        $this->area = $area ?? '';
    }

    public static function getLocationID(string $address_line, string $city, string $state, string $nearest_bustop, string $area, $location_id = false) {
        $location = new Location($address_line, $city, $state, $nearest_bustop, $area);
        
        return (!$location_id) ? $location->saveLocation() : $location->updateLocation($location_id);
    }

    private function updateLocation($locationID) {
        $sql = "UPDATE `location` 
                SET `address_line`= :address_line, `city`= :city,`state`= :state,`area`= :area, `nearest_bustop`= :nearest_bustop 
                WHERE location_id = :location_id;";

        $body = get_object_vars($this);
        $body['location_id'] = $locationID;
        
        return ModelDAO::getConnection()->executeQuery($sql, $body)['count'];
    }

    private function saveLocation() {

        $sql = 'INSERT INTO location (`address_line`, `city`, `state`, `area`, `nearest_bustop`) 
                VALUES (:address_line, :city, :state, :area, :nearest_bustop);';
        
        $body = get_object_vars($this);

        $single_data = ModelDAO::getConnection()->executeQuery($sql, $body);

        if($single_data) {
            return ModelDAO::getLastInsertedModel('location', 'location_id')[0]['location_id'];
        }
    }

    public static function getFullLocation(int $locationID) {
        
        $location = UtilDAO::getFullLocation($locationID);

        $addressLine = $location[0]['address_line'] ?? false;
        $city = $location[0]['city'] ?? false;
        $state = $location[0]['state'] ?? false;
        $area = $location[0]['area'] ?? false;

        return "$addressLine $area $city $state State";
    }
    
}

                //    echo '<pre>'; var_dump($single_data); echo '</pre>';
