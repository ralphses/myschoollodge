<?php

namespace src\controllers;

use src\models\Model;
use src\models\ModelDAO\AgentDAO;
use src\models\ModelDAO\PropertyDAO;
use src\models\ModelDAO\UtilDAO;
use src\utils\Request;
use src\utils\Response;

class SiteController extends Controller {

    public function __construct() {
        $this->setLayout('home');    
        $this->response = new Response();    
    }

    public function seeUserLodge() {
        $this->setLayout('user');
        $properties =[];

        $agent_id = $_SESSION['agent'] ?? false;
        if($agent_id) {
            $properties = PropertyDAO::getAgentProperties($agent_id);
        }
        return $this->render('viewUserProperty', ['response' => $properties]);
    }
    
    public function index() {
        return $this->render('index');
    }

    public function userNewLodge(Request $request) {
        $this->setLayout('user');

        if(!$request->getFormInputs('prop_code')) {
            return $this->render('userAddLodge', ['response' => false]);
        }
        else {
            $propertyID = PropertyDAO::getPropertyByCode($request->getFormInputs()['prop_code'])[0]['id'];
            $propertyController = new PropertyController();

            $response = $propertyController->prepareModel($propertyID);
            $_SESSION['update'] =true;

            return $this->render('userAddLodge', ['response' => $response]);
        }
    }

    public function userRequests() {
        $this->setLayout('user'); 

        $data =$this->prepareData(UtilDAO::getUserCompleteRequests($_SESSION['agent']));
        // $data =(UtilDAO::getUserCompleteRequests($_SESSION['agent']));

        $this->response->addResponse('user requests', $data);
        return $this->render('userRequests', ['response' =>  $this->response->getResponseContent()]);
    }

    private function prepareData ($data) {
        $readyData = [];
        foreach($data as $key => $value) {
            $readyData['code'] = $this->getRandomName().'-'.$value['id'];
            // $readyData['codes'] = substr($readyData['code'], strpos($readyData['code'], '-')+1, strlen($readyData['code']) -1);
            $readyData['fullname'] = $value['first_name'].' '.$value['other_name']; 
            $readyData['contact'] = $value['phone'];
            $readyData['prop_name'] = $value['title'];
            $readyData['stage'] = $value['status'];
           

            $data[$key] = $readyData;
        }
        return $data;
    }

    public function userHome() {

        if(!$_SESSION['logged_in']) {
            header('Location: /'); exit;
        }

        $this->setLayout('user'); 
        $agent_id = $_SESSION['agent'];

        //Prpare this user
        $agentController = new AgentController();
        $thisAgent = $agentController->prepareModel($agent_id);
        $this->response->addResponse('user', $thisAgent);

        //Get total properties 
        $totalProp = PropertyDAO::getAgentProperties($agent_id, true);
        $this->response->addResponse('total properties', $totalProp);

        //Get total request for this user
        $totalRequest = UtilDAO::getAgentRequests($agent_id, true);
        $this->response->addResponse('total requests', $totalRequest);

        $this->prepareAgentRecentRequest($agent_id);

        //Load user recent activities 
        $activities = UtilDAO::getUserActivities($agent_id);
        $this->response->addResponse('activities', $activities);

        //Load pending requests
        $totalPendingRequest = UtilDAO::getAgentPendingRequests($agent_id, true);
        $this->response->addResponse('pending requests', $totalPendingRequest);

        //Load completed requests
        $totalCompletedRequest = UtilDAO::getAgentCompletedRequests($agent_id, true);
        $this->response->addResponse('completed requests', $totalCompletedRequest);

        return $this->render('agentHome', ['response' => $this->response->getResponseContent()]);
    }

    private function prepareAgentRecentRequest($agent_id) {

        $requests = AgentDAO::getAgentRecentRequests($agent_id);
        $requestMessages = [];

        foreach($requests as $key => $req) {
            $requestMessages[] = $req['first_name'].' is insterested in '.$req['title'];
        }
        $this->response->addResponse('recent requests', $requestMessages);
    }

    public function editAgent() {

        $agentController = new AgentController();
        
        return $this->render('modifyAgent', ['response' => $agentController->prepareModel($_SESSION['agent'])]);
    }

    public function resetPass() {
        return $this->render('resetPassword');
    }

    public function renderSearch(Request $request) {
        $searchController = new SearchController();
        
        return $this->render('searchResults', ['response' => $searchController->searchAll($request)]);
        return $this->render('resetPassword');
    }

    public function anotherPassword() {
        return $this->render('newPassword');
    }

    public function about() {
        return $this->render('about');
    }

    public function properties() {
        return $this->render('properties');
    }

    public function agency() {
        return $this->render('agency');
    }

    public function contact() {
        return $this->render('contact');
    }

    public function addProperties() {
        return $this->render('add-property');
    }
    
    public function newAgent() {
        return $this->render('new-agent');
    }

    public function newAgency() {
        return $this->render('new-agency');
    }

    public function login() {
        return $this->render('login');
    }

    public function loginAdmin() {
        return $this->render('adminLogin');
    }


    public function showPropertied() {
        return $this->render('properties-details');
    }

    public function ourAdmin() {
        $this->setLayout('user');
        return $this->render('admin');
    }
    
    public function prepareModel($modelID) : array { return [];}
    public function cleanModel(Model $model): array {return [];}

}

// echo '<pre>'; var_dump(); echo '</pre>'; exit;
