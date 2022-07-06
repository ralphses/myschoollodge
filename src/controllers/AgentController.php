<?php

namespace src\controllers;

use src\models\Agent;
use src\models\Model;
use src\models\ModelDAO\AgencyDAO;
use src\models\ModelDAO\AgentDAO;
use src\models\ModelDAO\ModelDAO;
use src\utils\ImageHandler;
use src\utils\Request;
use src\utils\Response;
use src\utils\Application;

class AgentController extends Controller {

    public function __construct() {

        $this->model = new Agent();
        $this->agentDAO = new AgentDAO($this->model);
        $this->imageHandler = new ImageHandler();
        $this->response = new Response();
        $this->layout = 'home';
    }

    /**
     * Adds a new agent
     * @param $request - represents the request from the user
     */

    public function newAgent(Request $request) {

        // if(!(Application::$application->validateToken($request->getFormInputs()['token']))) {
        //     echo json_encode(['status' => false, 'response' => 'Unauthorized']);
        //     exit;
        // }
        if(!$request->isPost()) {
            echo json_encode(['status' => false, 'response' => 'Unauthorized']);
            exit;
        }

       
        $this->model->loadData($request->getFormInputs());

        //Validate user inputs
        if(!$this->model->validate()) {
            $agree = $this->model->errors['agent_agree'] ?? false;
            if($agree) {
                $this->model->errors['agent_agree_check'] = $this->model->errors['agent_agree'];
                unset($this->model->errors['agent_agree']);
            }
            
            $this->response->setResponseContent([$this->model->errors]);
            echo json_encode(['status' => false, 'response' => $this->response->getResponseContent()]);
            exit;
        }

        if(($this->isEmailRegistered($this->model->agent_email))) {
            $this->response->setResponseContent(['agent_email' => 'Email already exist!']);
            echo json_encode(['status' => false, 'response' => $this->response->getResponseContent()]);
            exit;
        }

        if(($this->isPhoneRegistered($this->model->agent_phone))) {
            $this->response->setResponseContent(['agent_phone' => 'Phone number already exist!']);
            echo json_encode(['status' => false, 'response' => $this->response->getResponseContent()]);
            exit;
        }

        //Save this agent
        if($this->agentDAO->saveNewAgent()) {

            $this->response->setResponseContent(['Registration Successful!']);
            echo json_encode(['status' => true, 'response' => $this->response->getResponseContent()]);
            exit;
        }
    }



    public function editAgent(Request $request) {

        if(!(Application::$application->validateToken($request->getFormInputs()['token']))) {
            echo json_encode(['status' => false, 'response' => 'Unauthorized']);
            exit;
        }
        if(!$request->isPost()) {
            echo json_encode(['status' => false, 'response' => 'Unauthorized']);
            exit;
        }

        $agentID = $_SESSION['agent'];
        $formInput = Request::validateField($request->getFormInputs());

        $this->model->loadData($request->getFormInputs());
        $this->agentDAO->updateAgent($agentID);

        $id_type =  $formInput['agent_id_type'] ?? false;
        $idImage = ($id_type) ? $this->imageHandler->getSingleImage('agent_id_image', 'agent') : '';
        $idNo = $formInput['agent_id_no'];

        if($id_type AND $idNo AND $idImage) {
            if(AgentDAO::getAgentAuthDetailsByID($agentID) ) {
                AgentDAO::updateAgentAuthDocuments($agentID, $id_type, $idNo);
                ModelDAO::updateModelImage($agentID, $idImage, 'ID', 'Agent');
            }
            else {
                AgentDAO::saveAgentAuthDocuments($agentID, $id_type, $idNo, $idImage);

                if(ModelDAO::getModelImage($agentID, 'ID', 'Agent')) {
                    ModelDAO::updateModelImage($agentID, $idImage, 'ID', 'Agent');
                }
                else {
                    ModelDAO::saveModelImage($agentID, $idImage, 'ID', 'Agent');
                }
            }
           
        }

        $agent_image = $this->imageHandler->getSingleImage('agent_image', 'agent') ?? false;
        if($agent_image) {
            if(ModelDAO::getModelImage($agentID,'profile', 'Agent')) {
                ModelDAO::updateModelImage($agentID, $agent_image, 'profile', 'Agent');
            }
            else {
                ModelDAO::saveModelImage($agentID, $agent_image, 'profile', 'Agent');
            }
        }

        
        $agentSocials = $this->setSocials($request, $formInput);
        $this->agentDAO->saveAgentSocials($agentSocials, $agentID);

        //Check if user selected a means of identification
        $agency_name = $request->getFormInputs()['agency'] ?? false;
        if($agency_name) {
            $agency_id = AgencyDAO::getAgencyByName($agency_name);
            if(AgentDAO::getAgentAgencyAndRole($agentID)) {
                AgentDAO::removeAgentAgency($agentID);
            }
            AgentDAO::saveAgentAgency($agency_id,  $agentID, $request->getFormInputs()['agent_role']);
        }

        echo json_encode(['status' => true, 'response' => 'Update successful']);
        
    }

    //Set social handles for this agent
    public function setSocials($request, $userInput) {
        $agentSocials = [];
        if($userInput['agent_whatsapp']?? false) {
            $agentSocials['Whatsapp'] = $userInput['agent_whatsapp'];
        }
        if($userInput['agent_fb'] ?? false) {
            $agentSocials['Facebook'] = $userInput['agent_fb'];
        }
        if($request->getFormInputs()['agent_twitter']?? false) {
            $agentSocials['Twitter'] =  $userInput['agent_twitter'];
        }
        
        return $agentSocials;
    }

    public function prepareModel($modelID) : array {

        //Get agent basic details
        $this->prepareModelBasicDetails(AgentDAO::getAgentByID($modelID));
       
        //Get authentication details
        $this->prepareModelAuthDetails(AgentDAO::getAgentAuthDetailsByID($modelID));

        //Get Agent Social medias
        $this->prepareAgentSocials(AgentDAO::getAgentSocials($modelID));

        //Get Agent featured Image
        $this->model->agent_image = AgentDAO::getAgentImageURL($modelID)[0]['imageURL'] ?? '';

        //Get agent's agency and role if any
        $this->resolveAgentAgencyAndRole(AgentDAO::getAgentAgencyAndRole($modelID));

        return $this->cleanModel($this->model);
    }

    private function resolveAgentAgencyAndRole($agencyDetails) {

        if(count($agencyDetails) > 0) {
            $this->model->agency = $agencyDetails[0]['agency'];
            $this->model->agent_agency_role = $agencyDetails[0]['role'];
        }
        else {
            $this->model->agency = '';
            $this->model->agent_agency_role = '';
        }
    }


    private function prepareModelAuthDetails($authDetails) {

        if(count($authDetails) > 0) {

            // var_dump(AgentDAO::getAgentIdImageURL($authDetails[0]['agent_agent_id'])[0]['imageURL']); exit;
            
            $this->model->agent_id_no = $authDetails[0]['id_no'];
            $this->model->agent_id_type = $authDetails[0]['id_type'];
            $this->model->agent_id_image = AgentDAO::getAgentIdImageURL($authDetails[0]['agent_agent_id'])[0]['imageURL'] ?? '';
        }
        else {
            $this->model->agent_id_no = '';
            $this->model->agent_id_type = '';
            $this->model->agent_id_image = '';
        }

    }

    private function prepareModelBasicDetails($agentBasicDetails) {

        $this->model->agent_name = $agentBasicDetails[0]['agent_title'];
        $this->model->agent_email = $agentBasicDetails[0]['email'];
        $this->model->agent_phone = $agentBasicDetails[0]['phone'];
        $this->model->agent_address = $agentBasicDetails[0]['address'] ?? '';
        
    }

    private function prepareAgentSocials($agentSocials) {
        if(count($agentSocials) > 0) {

            $this->model->agent_whatsapp = $this->getOneSocial($agentSocials, 'whatsapp');
            $this->model->agent_fb =$this->getOneSocial($agentSocials, 'facebook');
            $this->model->agent_twitter = $this->getOneSocial($agentSocials, 'twitter');
        }
        else {

            $this->model->agent_whatsapp = '';
            $this->model->agent_fb = '';
            $this->model->agent_twitter = '';
        }
       
    }

    private function getOneSocial($agentSocials, $social) {


        foreach($agentSocials as $key => $value) {
            if( strnatcasecmp($value['social_title'], $social) === 0) {
                return $value['social_link'];
            }
        }
        return '';
    }

    public function cleanModel(Model $model): array {
        $body = get_object_vars($model);

        unset($body['errors']); 
        unset($body['socials']);
        unset($body['agent_agree']);
        unset($body['labels']);
        unset($body['rules']);

        return $body;
    }

    public function removeAgent(Request $request) {

    }

    private function isEmailRegistered($email) {
        return count(AgentDAO::checkEmail($email)) > 0;
    }

    private function isPhoneRegistered($phone) {
        return count(AgentDAO::checkPhone($phone)) > 0;
    }



}

            // echo '<pre>'; var_dump($params); echo '</pre>'; exit;
