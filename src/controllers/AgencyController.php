<?php

namespace src\controllers;

use src\models\Agency;
use src\models\Model;
use src\models\ModelDAO\AgencyDAO;
use src\models\ModelDAO\AgentDAO;
use src\models\ModelDAO\ModelDAO;
use src\utils\Application;
use src\utils\ImageHandler;
use src\utils\Location;
use src\utils\Rating;
use src\utils\Request;
use src\utils\Response;

class AgencyController extends Controller {

    public AgencyDAO $agencyDAO;

    public function __construct() {

        $this->model = new Agency();
        $this->response = new Response();
        $this->agencyDAO = new AgencyDAO($this->model);
        $this->imageHandler = new ImageHandler();

    }

    public function prepareModel($modelID): array {return [];}
    public function cleanModel(Model $model): array {return [];}

    public function newAgency(Request $request) {

        if(!(Application::$application->validateToken($request->getFormInputs()['token']))) {
            echo json_encode(['status' => false, 'response' => 'Unauthorized']);
            exit;
        }
        if(!$request->isPost()) {
            echo json_encode(['status' => false, 'response' => 'Unauthorized']);
            exit;
        }

        $body = $request->getFormInputs();

        $this->model->loadData($body);

       if($body['certification_status'] === '1') {

            $this->model->addRules([
                'certification_firm' => [Model::RULE_REQUIRED],
                'certificate_no' => [Model::RULE_REQUIRED]
            ]);

            $this->model->addLabels([
                'certification_firm' => 'Certifying firm',
                'certificate_no' => 'Certificate Number'
            ]);

        }

        //Check if an agency with this name already existed
        if($this->agencyDAO->getAgencyByName($this->model->name)) {

            $this->response->setResponseContent(['name' => 'Agency with title '. $this->model->name. " already exists!"]);
            echo json_encode(['status' => false, 'response' => $this->response->getResponseContent()]);
            exit;
        }

        if(!$this->model->validate()) {

            $this->response->setResponseContent($this->model->errors);
            echo json_encode(['status' => false, 'response' => $this->response->getResponseContent()]);
            exit;
        }

        $agencyBasicDetails['location_id'] = $this->resolveLocation($request);
        $agencyBasicDetails['rating_id'] = Rating::getNewRating()[0]['rating_id'];

        //Save agency basic information
        $this->agencyDAO->saveBasicAgency($agencyBasicDetails); 

        //save all agency uploaded images
        $this->agencyDAO->saveAgencyImages();

        //Save agency other details
        if($body['description']) {

            $this->agencyDAO->saveAgencyOtherDetails();
        }

        //Save Certification details 
        if($body['certification_status'] === '1') {
            $this->agencyDAO->saveAgencyCertificationDetails();
        }

        //Tie this agency to the agent
        $thisAgencyID = ModelDAO::getLastInsertedModel('agency', 'agency_id')[0]['agency_id'];
        AgentDAO::saveAgentAgency($thisAgencyID, $_SESSION['agent']);
               
    }


    public function resolveLocation(Request $request) {

        $addres_line = $request->getFormInputs()['address_line'] ?? '';
        $city = $request->getFormInputs()['city'] ?? '';
        $state = $request->getFormInputs()['state'] ?? '';
        $area = $request->getFormInputs()['area'] ?? '';
        $nearest_bustop = $request->getFormInputs()['nearest_bustop'] ?? '';

        return Location::getLocationID($addres_line, $city, $state, $area, $nearest_bustop);
    }
}