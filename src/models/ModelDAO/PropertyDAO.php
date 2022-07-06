<?php

namespace src\models\ModelDAO;

use mysqli;
use src\models\Property;
use src\utils\ImageHandler;

class PropertyDAO extends ModelDAO {

    public function __construct(Property $property) {

        $this->model = $property;
        $this->imageHandler = new ImageHandler();
    }


    public function saveBasicDetails($agent_id) {

        $sql = 'INSERT INTO `property`(`agent_id`, `title`, `price`, `type`, `code`, `location_id`) 
                VALUES (:agent_id, :title, :price, :type, :code, :location_id)';

        $this->modelBody = [

            'title' => $this->model->propertyName,
            'type' => $this->model->propertyType,
            'price' => $this->model->propertyPrice,
            'location_id' => $this->model->locationID,
            'code' => $this->model->code,
            'agent_id' => $agent_id
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
            if($facility) {
                self::getConnection()->executeQuery($sql, [
                    'property_id' => $this->model->propertyID,
                    'facility_title' => $facility
                ]);
                $count++;
            }
        }
        return $count;
    }

    public function saveImages() {
        $count = 0;
    
        $sql = 'INSERT INTO `images`(`id`, `imageURL`, `image_type`) 
        VALUES (:id, :imageURL, :image_type);';

        $this->modelBody = $this->model->images;

        foreach($this->modelBody as $image => $type) {

            if($image != ''){

                self::getConnection()->executeQuery($sql, [
                    'id' => $this->model->propertyID, 
                    'imageURL' => $image, 
                    'image_type' => $type
                ]);

                $count++;
            }
        }
        return $count--;
    }

   
    public static function getPropertyByAgent($agent_id) {

        $sql = "SELECT * FROM property 
                INNER JOIN location ON property.location_id = location.location_id 
                INNER JOIN images ON property.id = images.id 
                INNER JOIN property_details ON property.id = property_details.property_id
                WHERE property.id IN (
                    SELECT property_id FROM agent_has_property WHERE agent_has_property.agent_id = :agent_id
                    );";

        $body = ['agent_id' => $agent_id];
        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    //GEt property facilities
    public static function getPropertyFacilitiesByID($property_id) {

        $sql = "SELECT `facility_title` FROM `prop_facility` 
                WHERE property_id = :property_id;";
        $body = ['property_id' => $property_id];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function deletePropertyFacilitiesByID($property_id) {

        $sql = "DELETE FROM `prop_facility` 
                WHERE property_id = :property_id;";
        $body = ['property_id' => $property_id];

        return self::getConnection()->executeQuery($sql, $body)['count'];
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

    public static function getAgentProperties($userID, $count = false) {
        $sql = "SELECT * FROM property WHERE agent_id = :agent_id;";
        $body = ['agent_id' => $userID];

        return (!$count) ? self::getConnection()->executeQuery($sql, $body)['data'] : self::getConnection()->executeQuery($sql, $body)['count']; 
    }

    public static function deleteProperty($prop_id) {
        $sql = "DELETE FROM `property` WHERE id = :id;";
        $body = ['id' => $prop_id];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }

    public static function deletePropertyDetails($prop_id) {
        $sql = "DELETE FROM `property_details` WHERE property_id = :property_id;";
        $body = ['property_id' => $prop_id];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }

    public static function getPropertyDetailsByID($prop_id) {
        $sql = "SELECT * FROM property WHERE id = :id;";
        $body = ['id' => $prop_id];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function getPropertyFacilitiesByProductIDAndFacilityName($prop_id, $facilityTitle) {
        $sql = "SELECT * FROM prop_facility WHERE property_id = :property_id AND facility_title = :facility_title;";
        $body = [
            'property_id' => $prop_id,
            'facility_title' => $facilityTitle
        ];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }

    public static function getPropertyLocationDetails($prop_id) {
        $sql = "SELECT location_id FROM property WHERE id = :id;";
        $body = ['id' => $prop_id];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function getPropertyOtherDetails($prop_id) {
        $sql = "SELECT * FROM property_details WHERE property_id = :property_id;";
        $body = ['property_id' => $prop_id];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }
    
    //** Update methods*/

    
    public function updatePropertyBasicDetails($prop_id) {
        $sql = "UPDATE `property` 
                SET `title`= :title,`price`= :price,`type`= :type 
                WHERE `id` = :id";

        $this->modelBody = [
            'title' => $this->model->propertyName,
            'type' => $this->model->propertyType,
            'price' => $this->model->propertyPrice,
            'id' => $prop_id
        ];

        return self::getConnection()->executeQuery($sql, $this->modelBody)['count'];
    }

    public function updateOtherDetails($other_id) {

        $sql = "UPDATE `property_details` 
                SET `description`= :description,`time_to_get_to_school`= :time_to_get_to_school,`prop_state`=:prop_state 
                WHERE id = :id AND property_id = :property_id;";

        $this->modelBody = [

            'property_id' => $this->model->propertyID,
            'description' => $this->model->propertyDescription,
            'time_to_get_to_school' => $this->model->propertyTimeToGetToSchool,
            'prop_state' => $this->model->propertyState,
            'id' => $other_id

        ];

        return self::getConnection()->executeQuery($sql, $this->modelBody)['count'];
    }

    public function updateFacilities() {

        $sql = "UPDATE `prop_facility` SET `facility_title`= :facility_title 
                WHERE property_id = :property_id;";

        $this->modelBody = $this->model->facilities;

        foreach($this->modelBody as $key => $facility) {

            $body = [
                'property_id' => $this->model->propertyID,
                'facility_title' => $facility
            ];

            if($facility and self::getPropertyFacilitiesByProductIDAndFacilityName($this->model->propertyID, $facility) > 0) {
                self::getConnection()->executeQuery($sql, $body);
                unset($this->modelBody[$key]);
            }
            
        }
        
        return $this->modelBody;
    }

    public function updateImage($path, $imageID) {

        //First, get the URL for the old image
        $oldImage = $this->getSingleImage($imageID)[0]['imageURL'];

        //Update the current image
        $sql = "UPDATE `images` SET `imageURL`= :imageURL  
                WHERE image_id = :image_id";

        $this->modelBody = [
            'imageURL' => $path,
            'image_id' => $imageID
        ];

        return [self::getConnection()->executeQuery($sql, $this->modelBody)['count'], 'oldImage' => $oldImage];
    }

    public function getSingleImage($img_id) {
        $sql = "SELECT imageURL FROM images WHERE image_id = :image_id;";
        $body = ['image_id' => $img_id];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function getDescriptionByKeyword($description) {

        $sql = "SELECT DISTINCT property.id as id FROM `property` 
                JOIN property_details 
                WHERE property.title LIKE '%".strip_tags(stripslashes($description))."%' 
                OR property_details.description LIKE  '%".strip_tags(stripslashes($description))."%';";
     
        return self::getConnection()->executeQuery($sql)['data'];
    }

    public static function getFacilitiesByKeyword($basic, $entertain, $garage) {

        $sql = "SELECT DISTINCT property_id as id FROM `prop_facility` 
                WHERE facility_title LIKE '%".strip_tags(stripslashes($basic))."%'
                OR facility_title LIKE '%".strip_tags(stripslashes($entertain))."%'
                OR facility_title LIKE '%".strip_tags(stripslashes($garage))."%';";

     
        return self::getConnection()->executeQuery($sql)['data'];
    }

    public static function getAgentPropertiesByMultiID(
        $locations, 
        $readyIds, 
        $category, 
        $price_range_high, 
        $price_range_low
        ) {

        $sql = "SELECT * FROM `property` 
                WHERE property.id IN (:id) 
                AND property.location_id IN (:loc) 
                AND property.status = 1 
                AND property.price >= :price_low 
                AND property.price <= :price_high 
                AND property.type LIKE '%".strip_tags(stripslashes($category))."%';";


        $body = [
            'id' =>  $readyIds,
            'loc' => $locations,
            'price_low' => $price_range_low,
            'price_high' => $price_range_high
        ];

        $sql1 = "SELECT * FROM `property` WHERE property.id IN (35,42,43,54,12,39);";
        $sql2 = "SELECT * FROM `property` WHERE property.title LIKE '%bedroom%';";
        $sql3 = "SELECT * FROM `property` WHERE property.type LIKE '%single%';";
        $sql4 = "";
        $sql5 = "";
        
        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function searchPropertyByLocations($locations = "") {

        if(strlen($locations) > 0) {
            $sql = "SELECT * FROM `property` WHERE property.location_id IN (".$locations.");";
            return self::getConnection()->executeQuery($sql)['data'];
        }
        return[];
    }

    public static function getPropertiesByDescription($descriptions = "") {

        if(strlen($descriptions) > 0) {

            $sql = "SELECT * FROM `property` WHERE property.id IN (".$descriptions.");";
            return self::getConnection()->executeQuery($sql)['data'];
        }
        return[];
    }

    
    public static function getPropertiesByPriceRange($price_range_high, $price_range_low) {

        if($price_range_high > $price_range_low) {
            $sql = "SELECT * FROM `property` WHERE property.price BETWEEN ".$price_range_low." AND ".$price_range_high." ;";
            return self::getConnection()->executeQuery($sql)['data'];
        }
        else {
            $sql = "SELECT * FROM `property` WHERE property.price BETWEEN ".$price_range_high." AND ".$price_range_low." ;";
            return self::getConnection()->executeQuery($sql)['data'];
        }
        return[];
    }

    public static function getPropertiesByType($type = "") {

        if(strlen($type) > 0) {
            $sql = 'SELECT * FROM `property` WHERE property.type LIKE "%'.$type.'%";';
            return self::getConnection()->executeQuery($sql)['data'];
        }
        return[];
    }

    public static function searchPropertyWithFacilities($type = "") {

        if(strlen($type) > 0) {
            $sql = 'SELECT * FROM `property` WHERE property.type LIKE "%'.$type.'%";';
            return self::getConnection()->executeQuery($sql)['data'];
        }
        return[];
    }

    public static function getLatestAddedProperties() {
        $sql = "SELECT * FROM property ORDER BY property.id DESC LIMIT 20;";
        return self::getConnection()->executeQuery($sql)['data'];
    }

    public static function getPropertyFeaturedImage($property_id) {
        $sql = 'SELECT `imageURL` FROM `images` 
                WHERE images.id = :id 
                AND images.image_type = :type
                AND images.model = "property";';
                
        $body = [
            'id' => $property_id,
            'type' => "Featured image"
        ];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function getFeaturedProperties() {
        $sql = "SELECT * FROM property WHERE featured = 1 ORDER BY id LIMIT 10;";
        return self::getConnection()->executeQuery($sql)['data'];
    }
}

// echo '<pre>'; var_dump($locations); echo '</pre>'; exit;
