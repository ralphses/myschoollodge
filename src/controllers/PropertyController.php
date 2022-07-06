<?php

namespace src\controllers;

use src\models\Model;
use src\models\ModelDAO\CustomerDAO;
use src\models\ModelDAO\ModelDAO;
use src\models\ModelDAO\PropertyDAO;
use src\models\ModelDAO\UtilDAO;
use src\models\Property;
use src\utils\Activity;
use src\utils\ImageHandler;
use src\utils\Request;
use src\utils\Response;
use src\utils\Location;
use src\utils\Application;

class PropertyController extends Controller {
    
    public PropertyDAO $propertyDAO;
    public $extras = [];

    public function __construct() {

        $this->model = new Property();
        $this->propertyDAO = new PropertyDAO($this->model);
        $this->imageHandler = new ImageHandler();
        $this->response = new Response();
    }

    public function newLodge2 (Request $request) {

        $this->requestBody = $request->getFormInputs();

        if(!(Application::$application->validateToken($request->getFormInputs()['token']))) {
            echo json_encode(['status' => false, 'response' => 'Unauthorized']);
            exit;          
        }
        if(!$request->isPost()) {
            echo json_encode(['status' => false, 'response' => 'Unauthorized']);
            exit;
        }

        $this->model->loadData($this->requestBody);

        if(!$this->model->validate()){
            $this->response->setResponseContent($this->model->errors);

            echo json_encode(['status' => false, 'response' => $this->response->getResponseContent()]);
            exit;
        }
     
        // Save property basic details
        $this->model->locationID = $this->resolveLocation($request);
        $this->model->code = $this->createPropertyCode();
        $this->model->agentID = $_SESSION['agent'];
        

        if($this->propertyDAO->saveBasicDetails($this->model->agentID) and $_SESSION['agent']) {
            
            $this->model->propertyID = intval(ModelDAO::getLastInsertedModel('property', 'id')[0]['id']);

            //Save other details for this property
            $this->propertyDAO->saveOtherDetails(); 

            //Get facilities for this property
            $this->model->facilities = $this->getPropertyFacilities();

            //Save facilities for this property
            $this->propertyDAO->saveFacilities();

            //Get image paths (other images) for this property from user
            $imgs = $this->imageHandler->getMultipleImage('otherImages', 'property');
            
            //Load each image for this property
            foreach($imgs as $img) {
                $this->model->images[$img] = 'Other image';
            }
            
            //Get image path (featured image) of this property
            $this->model->images[$this->imageHandler->getSingleImage('propertyFeaturedImage', 'property')] = 'Featured image';

            //Save all images to images table
            $this->propertyDAO->saveImages();

            echo json_encode(['status' => true]);
            exit;
        }
    }

    public function newLodge (Request $request) {

        $this->extras = $_SESSION['extras'] ?? false;

        $this->requestBody = $request->getFormInputs();

        if(!(Application::$application->validateToken($request->getFormInputs()['token']))) {
            echo json_encode(['status' => false, 'response' => 'Unauthorized']);
            exit;          
        }
        if(!$request->isPost()) {
            echo json_encode(['status' => false, 'response' => 'Unauthorized']);
            exit;
        }

        $this->model->loadData($this->requestBody);

        if(!$this->model->validate()){
            $this->response->setResponseContent($this->model->errors);

            echo json_encode(['status' => false, 'response' => $this->response->getResponseContent()]);
            exit;
        }
        
        if(!$_SESSION['update']) {

        
             // Save property basic details
            $this->model->locationID = $this->resolveLocation($request);
            $this->model->code = $this->createPropertyCode();
            $this->model->agentID = $_SESSION['agent'];

            if($this->propertyDAO->saveBasicDetails($this->model->agentID) and $this->model->agentID) {
            
                $this->model->propertyID = intval(ModelDAO::getLastInsertedModel('property', 'id')[0]['id']);
    
                //Save other details for this property
                $this->propertyDAO->saveOtherDetails(); 
    
                //Get facilities for this property
                $this->model->facilities = $this->getPropertyFacilities();
    
                //Save facilities for this property
                $this->propertyDAO->saveFacilities();
    
                $this->resolveImages();

                //Save this activitiy
                Activity::createActivity($this->model->propertyName.' was added', $this->model->agentID);
 
                echo json_encode(['status' => true]);

                exit;
            }
        }
        else {

            $property_id = $this->extras['property_id'] ?? false;
            $location_id = $this->extras['locationID'] ?? false;
            $other_id = $this->extras['other_id'] ?? false;
           
            //Do updates
            if($property_id AND $location_id) {

                $this->model->locationID = $location_id;
                $this->model->propertyID = $property_id;

                //Update location details
                $this->resolveLocation($request, $location_id);

                //Update basic details
                $this->propertyDAO->updatePropertyBasicDetails($property_id);
                
                //Update other details
                $this->propertyDAO->updateOtherDetails($other_id);

                //Get facilities for this property
                $this->model->facilities = $this->getPropertyFacilities();

                //Update facilities
                $this->model->facilities = $this->propertyDAO->updateFacilities();

                //Check if there are new facilities
                if(count($this->model->facilities) > 0) {

                    //Save new facilities for this property
                    $this->propertyDAO->saveFacilities();
                } 

                $this->resolveImages();

                 //Save this activitiy
                 Activity::createActivity($this->model->propertyName.' was updated', $_SESSION['agent']);

                 $_SESSION['update'] = false;

                echo json_encode(['status' => true]);

                //create activity
                
                exit;
               
            }
        }
    }


    public function deleteLodge(Request $request) {
        $prop_code = $request->getFormInputs()['prop_code'] ?? false;
      
        if($prop_code) {
            
            $property = PropertyDAO::getPropertyByCode($prop_code)[0];
            $prop_id = $property['id'] ?? false;

            if($prop_id) {

                //Delete images
                $this->deletePropertyImages($prop_id);

                //Delete property
                PropertyDAO::deleteProperty($prop_id);

                //Set Customer requests associated with this property to inactive
                CustomerDAO::changeCustomerRequestStatus(-1, ['property_id', $prop_id]);

                //Delete Property facilities
                PropertyDAO::deletePropertyFacilitiesByID($prop_id);

                //Delete Property location details
                UtilDAO::deleteLocation($property['location_id']);

                //Delete property details
                PropertyDAO::deletePropertyDetails($prop_id);

                echo json_encode(['status' => true]);
                exit;
            }

          
        }
        else {
            echo json_encode(['status' => false, 'response' => 'No such property']);
            exit;
        }
    } 

    public function prepareModel($modelID): array {

        $this->model->propertyID = $modelID;
        $this->extras['property_id'] =  $modelID;

        //Prepare basic details
        $this->prepareBasicPropertyDetails(PropertyDAO::getPropertyDetailsByID($modelID));

        //prepare location details
        $this->preparePropertyLocationDetails(PropertyDAO::getPropertyDetailsByID($modelID));

        //prepare facilities
        $this->preparePropertyFacilities();

        //prepare property other details
        $this->preparePropertyOtherDetails(PropertyDAO::getPropertyOtherDetails($modelID));

        //Prepare property images 
        $this->preparePropertyImages($modelID);

        $_SESSION['extras'] = $this->extras;
        $this->extras = false;

        return $this->cleanModel($this->model);
    }

    public function cleanModel(Model $model): array {

        $body = get_object_vars($model);

        unset($body['errors']); 
        unset($body['labels']);
        unset($body['rules']);
        unset($body['propertyID']);

        return $body;
    }

    private function preparePropertyImages($modelID) {
        $images = UtilDAO::getAllImages($modelID);
        $simpleImages = [];

        foreach($images as $key => $value) {
            $simpleImages[$value['image_id']] = $value['image_type']; 
        }
        $this->extras['images'] = $simpleImages;
        $this->model->images = $simpleImages;
    }

    private function preparePropertyOtherDetails($property) {

        $this->model->propertyDescription = $property[0]['description'];
        $this->model->propertyTimeToGetToSchool = $property[0]['time_to_get_to_school'];
        $this->model->propertyState = $property[0]['prop_state'];
        $this->extras['other_id'] = $property[0]['id'];
    }
    
    private function preparePropertyFacilities() {
        $simpleFacilities = [];
        $facilities = PropertyDAO::getPropertyFacilitiesByID($this->model->propertyID);

        foreach($facilities as $key => $value) {
            $simpleFacilities[array_values($value)[0]] = array_values($value)[0];
        }
        $this->model->facilities = $simpleFacilities; 
    }

    private function preparePropertyLocationDetails ($property) {

        $locationID = $property[0]['location_id'];
        $this->extras['locationID'] =  $locationID;

        $locationDetails = UtilDAO::getFullLocation($locationID);

        $this->model->propertyAddressLine = $locationDetails[0]['address_line'];
        $this->model->propertyLocationCity = $locationDetails[0]['city'];
        $this->model->propertyLocationState = $locationDetails[0]['state'];
        $this->model->propertyLocationArea = $locationDetails[0]['area'];
        $this->model->propertyNearestBustop = $locationDetails[0]['nearest_bustop'];
    }

    private function prepareBasicPropertyDetails($property) {
        
        $this->model->propertyName = $property[0]['title'];
        $this->model->propertyType = $property[0]['type'];
        $this->model->propertyPrice = $property[0]['price'];
    }

    private function deletePropertyImages($prop_id) {

        $images = UtilDAO::getAllImages($prop_id);

        foreach($images as $key => $value) {
            ImageHandler::deleteImagePath($value['imageURL']);
            UtilDAO::deleteImageFromDB($prop_id);
        }
    }

    private function createPropertyCode() {
        $timestamp = strval(time());
        $code = "PROP".substr($timestamp, 5, strlen($timestamp) - 1);
        return $code;
    }

    private function resolveImages() {

        $count = 0;

        //Get image paths (other images) for this property from user
        $imgs = $this->imageHandler->getMultipleImage('otherImages', 'property');
             
         //Load each image for this property
         foreach($imgs as $img) {
             if($count < 3) {
                $this->model->images[$img] = 'Other image';
             }
             $count++;
         }
         
         //Get image path (featured image) of this property
         $this->model->images[$this->imageHandler->getSingleImage('propertyFeaturedImage', 'property')] = 'Featured image';


       if(!$this->extras) {

           //Save all images to images table
           $this->propertyDAO->saveImages();
       }
       else {
           
           $oldImgsID = [];
           foreach($this->model->images as $path => $value) {
               if($value == 'Featured image' and $path != "") {

                   $featuredImgID = '';

                   //Search for featured image in the old images
                   foreach($this->extras['images'] as $k => $val) {
                       if($val === 'Featured image') {

                           $featuredImgID = $k; //ID of the old image

                           //Get the path for this old image while updating the current image with the new path
                            $oldImage = $this->propertyDAO->updateImage($path, $featuredImgID)['oldImage'];

                            //Delete the old image from the directory
                            $this->imageHandler->deleteImagePath($oldImage); 
                            unset($this->model->images[$path]);

                            unset($this->extras['images'][$k]);
                       }
                       else {
                           $oldImgsID[] = $k;
                       }
                   }
               }
           }
               $co = 0;
               
               foreach($this->model->images as $p => $ke) {
                   if($co >= count($oldImgsID)) {
                       break;
                   }
                   else {

                        $oldImage = $this->propertyDAO->updateImage($p, $oldImgsID[$co])[1];
                        $this->imageHandler->deleteImagePath($oldImage); 
                        unset($this->model->images[$p]);

                        $co++;
                   }
               }
               if(count($this->model->images) > 0) {
                   $this->propertyDAO->saveImages(); //Save remaining images to images table
               }
               
       }
    }

    private function getPropertyFacilities() {
        $allFacilities = [];

        $allFacilities[] = $this->requestBody['AC'] ?? false;
        $allFacilities[] = $this->requestBody['bedding-mattres'] ?? false;
        $allFacilities[] = $this->requestBody['bedding-full'] ?? false;
        $allFacilities[] = $this->requestBody['cable-gotv'] ?? false;
        $allFacilities[] = $this->requestBody['cable-dstv'] ?? false;
        $allFacilities[] = $this->requestBody['cable-startime'] ?? false;
        $allFacilities[] = $this->requestBody['tv-normal'] ?? false;
        $allFacilities[] = $this->requestBody['tv-smart'] ?? false;
        $allFacilities[] = $this->requestBody['study-table'] ?? false;
        $allFacilities[] = $this->requestBody['kitchen'] ?? false;
        $allFacilities[] = $this->requestBody['kitchen-gas'] ?? false;
        $allFacilities[] = $this->requestBody['internet'] ?? false;
        $allFacilities[] = $this->requestBody['pool'] ?? false;
        $allFacilities[] = $this->requestBody['home-theatre'] ?? false;

        $otherFacilities = $this->requestBody['otherFacilities'] ?? false;
        
        if($otherFacilities) {
            $allFacilities = array_merge($allFacilities, explode(",", $otherFacilities));
        }

        return $allFacilities;
    }

    private function resolveLocation(Request $request, $location_id = false) {

        $addres_line = $request->getFormInputs()['propertyAddressLine'] ?? '';
        $city = $request->getFormInputs()['propertyLocationCity'] ?? '';
        $state = $request->getFormInputs()['propertyLocationState'] ?? '';
        $area = $request->getFormInputs()['propertyLocationArea'] ?? '';
        $nearest_bustop = $request->getFormInputs()['propertyNearestBustop'] ?? '';

        return (!$location_id) ? 
                Location::getLocationID($addres_line, $city, $state, $area, $nearest_bustop) :
                Location::getLocationID($addres_line, $city, $state, $area, $nearest_bustop, $location_id);
    }
}
        // echo '<pre>'; var_dump($allFacilities); echo '</pre>'; exit;
