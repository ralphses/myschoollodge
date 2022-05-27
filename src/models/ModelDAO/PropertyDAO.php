<?php

namespace src\models\ModelDAO;

use src\models\Property;
use src\utils\ImageHandler;

class PropertyDAO extends ModelDAO {

    public function __construct(Property $property) {

        $this->model = $property;
        $this->imageHandler = new ImageHandler();
    }


    public function saveBasicDetails() {

        $sql = 'INSERT INTO `property`(`title`, `price`, `type`, `code`, `location_id`) 
                VALUES (:title, :price, :type, :code, :location_id)';

        $this->modelBody = [

            'title' => $this->model->propertyName,
            'type' => $this->model->propertyType,
            'price' => $this->model->propertyPrice,
            'location_id' => $this->model->locationID,
            'code' => $this->model->code
        ];

        return self::getConnection()->executeQuery($sql, $this->modelBody)['count'];
    }


    public function saveOtherDetails() {

        $sql = 'INSERT INTO `property_details`(`property_id`, `description`, `time_to_get_to_school`, `prop_state`) 
                VALUES (:property_id, :description, :time_to_get_to_school, :prop_state)';

        $this->modelBody = [

            'property_id' => $this->model->propertyID,
            'description' => $this->model->propertyDescription,
            'time_to_get_to_school' => $this->model->propertyTimeToGetToSchool,
            'prop_state' => $this->model->propertyState,

        ];

        return self::getConnection()->executeQuery($sql, $this->modelBody);
    }


    public function saveFacilities() {
        $count = 0;
        $sql = 'INSERT INTO `prop_facility`(`property_id`, `facility_title`) 
                VALUES (:property_id, :facility_title)';

        $this->modelBody = $this->model->facilities;

        foreach($this->modelBody as $key => $facility) {
            self::getConnection()->executeQuery($sql, [
                'property_id' => $this->model->propertyID,
                'facility_title' => $facility
            ]);
            $count++;
        }
        return $count;
    }


    public function saveImages() {
        $count = 0;
    
        $sql = 'INSERT INTO `prop_image`(`property_id`, `imageURL`, `type`) 
                VALUES (:property_id, :imageURL, :type)';

        $this->modelBody = $this->model->images;

        foreach($this->modelBody as $image => $type) {

            self::getConnection()->executeQuery($sql, [
                'property_id' => $this->model->propertyID, 
                'imageURL' => $image, 
                'type' =>  $type
            ]);

            $count++;
        }
        return $count;
    }

    public static function getPropertyByID($property_id) {

        $sql = "SELECT * FROM `property` 
                JOIN location ON property.location_id = location.location_id 
                JOIN prop_image ON property.id = prop_image.property_id 
                JOIN property_details ON property.id = property_details.property_id
                WHERE property.id = :property_id && prop_image.type = 'featured';";

        $body = ['property_id' => $property_id];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function getPropertyByAgent($agent_id) {

        $sql = "SELECT * FROM property 
                INNER JOIN location ON property.location_id = location.location_id 
                INNER JOIN prop_image ON property.id = prop_image.property_id 
                INNER JOIN property_details ON property.id = property_details.property_id
                WHERE property.id IN (
                    SELECT property_id FROM agent_has_property WHERE agent_has_property.agent_id = :agent_id
                    );";

        $body = ['agent_id' => $agent_id];
        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function getPropertyFacilitiesByID($property_id) {

        $sql = "SELECT `facility_title` FROM `prop_facility` 
                WHERE property_id = :property_id;";
        $body = ['property_id' => $property_id];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }


    public static function getPropertyByCode($propertyCode) {

        $sql = "SELECT * FROM `property` WHERE code = :code";
        $body = ['code' => $propertyCode];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function getAgentIDByPropertyID($prop_id) {
        $sql = "SELECT * FROM `agent_has_property` WHERE property_id = :property_id;";
        $body = ['property_id' => $prop_id];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

}