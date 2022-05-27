<?php

namespace src\controllers;

use src\models\ModelDAO\AgentDAO;
use src\models\ModelDAO\ModelDAO;
use src\models\ModelDAO\PropertyDAO;
use src\models\Property;
use src\utils\ImageHandler;
use src\utils\Request;
use src\utils\Response;
use src\utils\Location;
use src\utils\Application;

class PropertyController extends Controller {
    
    public PropertyDAO $propertyDAO;

    public function __construct() {

        $this->model = new Property();
        $this->propertyDAO = new PropertyDAO($this->model);
        $this->imageHandler = new ImageHandler();
        $this->response = new Response();
    }

    public function newLodge (Request $request) {

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

        if($this->propertyDAO->saveBasicDetails() and $_SESSION['agent']) {
            
            $this->model->propertyID = intval(ModelDAO::getLastInsertedModel('property', 'id')[0]['id']);
            $this->model->agentID = $_SESSION['agent'];

            //Save this property for this agent
            AgentDAO::saveAgentProperty($this->model->agentID, $this->model->propertyID);

            //Save other details for this property
            $this->propertyDAO->saveOtherDetails(); 

            //Save facilities for this property
            $this->model->facilities = $this->getPropertyFacilities();
            // $this->propertyDAO->saveFacilities();

            //Save images for this property
            $imgs = $this->imageHandler->getMultipleImage('otherImages', 'property');
            
            foreach($imgs as $img) {
                $this->model->images[$img] = 'Other image';
            }
            $this->model->images[$this->imageHandler->getSingleImage('propertyFeaturedImage', 'property')] = 'Featured image';

            $this->propertyDAO->saveImages();
        }
    }

    private function createPropertyCode() {
        $timestamp = strval(time());
        $code = "PROP".substr($timestamp, 5, strlen($timestamp) - 1);
        return $code;
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

    private function resolveLocation(Request $request) {

        $addres_line = $request->getFormInputs()['propertyAddressLine'] ?? '';
        $city = $request->getFormInputs()['propertyLocationCity'] ?? '';
        $state = $request->getFormInputs()['propertyLocationState'] ?? '';
        $area = $request->getFormInputs()['propertyLocationArea'] ?? '';
        $nearest_bustop = $request->getFormInputs()['propertyNearestBustop'] ?? '';

        return Location::getLocationID($addres_line, $city, $state, $area, $nearest_bustop);
    }


}