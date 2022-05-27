<?php

namespace src\utils;

use src\models\ModelDAO\ModelDAO;

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

    public static function getLocationID(string $address_line, string $city, string $state, string $nearest_bustop, string $area) {
        $location = new Location($address_line, $city, $state, $nearest_bustop, $area);
        return $location->saveLocation();
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
}

                //    echo '<pre>'; var_dump($single_data); echo '</pre>';
