<?php

namespace src\controllers;

use src\models\Agent;
use src\models\Model;
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

        if(!(Application::$application->validateToken($request->getFormInputs()['token']))) {
            echo json_encode(['status' => false, 'response' => 'Unauthorized']);
            exit;
        }
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

        //Check if user selected a means of identification
        $id_type = $request->getFormInputs()['agent_id_type'] ?? false;
        $agency_id = $request->getFormInputs()['agency_id'] ?? false;

        if($id_type) {

            $idImage = $this->imageHandler->getSingleImage('agent_id_image', 'agent') ?? false;
            $this->model->agent_id_image = $idImage;

            //Make new validation rules for Agent Authentication details and labels for errors
            
            $newRules = [
                'agent_id_no' => [Model::RULE_REQUIRED],
                'agent_id_type' => [Model::RULE_REQUIRED],
                'agent_id_image' => [Model::RULE_REQUIRED]
            ];

            $newLabels = [
                'agent_id_no' => 'ID Card number',
                'agent_id_type' => 'ID type',
                'agent_id_image' => 'ID scanned copy'
            ];

            $this->model->addRules($newRules);
            $this->model->addLabels($newLabels);

        }

        if($request->getFormInputs()['agent_image'] ?? false) {

            $this->model->agent_image = $this->imageHandler->getSingleImage('agent_image', 'agent') ?? '';

        }

        $this->model->loadData($request->getFormInputs());
        
        //Validate user inputs
        if(!$this->model->validate()) {
            unset($this->model->errors['agent_agree']);
            $this->response->setResponseContent($this->model->errors);
            echo json_encode(['status' => false, 'response' => $this->response->getResponseContent()]);
            exit;
        }

        if($this->agentDAO->updateAgent()) {
            $agentID = ModelDAO::getLastInsertedModel('agent', 'agent_id')[0]['agent_id'];
            
            $this->model = $this->setSocials($request, $this->model);

            if($this->model->socials) {
               $this->agentDAO->saveAgentSocials($agentID);
            }   

            if($this->model->agent_id_type) {
                $this->agentDAO->saveAgentAuthDocuments($agentID);
            }

            if($agency_id) {
                $this->agentDAO->saveAgentAgency($agentID);
            }
        }
    }

    //Set social handles for this agent
    public function setSocials($request, Agent $agent) {
        if($request->getFormInputs()['agent_whatsapp']?? false) {
            $agent->socials['Whatsapp'] = $request->getFormInputs()['agent_whatsapp'];
        }
        if($request->getFormInputs()['agent_fb'] ?? false) {
            $agent->socials['Facebook'] = $request->getFormInputs()['agent_fb'];
        }
        if($request->getFormInputs()['agent_twitter']?? false) {
            $agent->socials['Twitter'] =  $request->getFormInputs()['agent_twitter'];
        }
        
        return $agent;
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
            
            $this->model->agent_id_no = $authDetails[0]['id_no'];
            $this->model->agent_id_type = $authDetails[0]['id_type'];
            $this->model->agent_id_image = AgentDAO::getAgentIdImageURL($authDetails[0]['id']);
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
            if($value[0][$social]) {
                return $value[0]['social_link'];
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
