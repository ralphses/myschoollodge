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

        //Check if user selected an ID 
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

        $this->model->agent_image = $this->imageHandler->getSingleImage('agent_image', 'agent') ?? '';

        $this->model->loadData($request->getFormInputs());

        //Validate user inputs
        if(!$this->model->validate()) {
            $agree = $this->model->errors['agent_agree'] ?? false;
            if($agree) {
                $this->model->errors['agent_agree_check'] = $this->model->errors['agent_agree'];
                unset($this->model->errors['agent_agree']);
            }
            
            $this->response->setResponseContent($this->model->errors);
            echo json_encode(['status' => false, 'response' => $this->response->getResponseContent()]);
            exit;
        }

        if($this->agentDAO->saveNewAgent()) {
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
        if($request->getFormInputs()['agent_whatsapp']) {
            $agent->socials['Whatsapp'] = $request->getFormInputs()['agent_whatsapp'];
        }
        if($request->getFormInputs()['agent_fb']) {
            $agent->socials['Facebook'] = $request->getFormInputs()['agent_fb'];
        }
        if($request->getFormInputs()['agent_twitter']) {
            $agent->socials['Twitter'] =  $request->getFormInputs()['agent_twitter'];
        }
        
        return $agent;
    }

   

    public function removeAgent(Request $request) {

    }

    public function editAgent(Request $request) {

    }

}

            // echo '<pre>'; var_dump($params); echo '</pre>'; exit;
