<?php

namespace src\controllers;

use src\models\Model;
use src\models\ModelDAO\PropertyDAO;
use src\utils\Request;

class SiteController extends Controller {

    public function __construct() {
        $this->setLayout('home');        
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

            return $this->render('userAddLodge', ['response' => $propertyController->prepareModel($propertyID)]);
        }
    }

    public function userRequests() {
        $this->setLayout('user'); 
        return $this->render('userRequests');
    }

    public function userHome() {
        $this->setLayout('user'); 
        return $this->render('agentHome');
    }

    public function editAgent() {

        $agentController = new AgentController();
        return $this->render('modifyAgent', ['response' => $agentController->prepareModel($_SESSION['agent'])]);
    }

    public function resetPass() {
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

    public function showPropertied() {
        return $this->render('properties-details');
    }
    
    public function prepareModel($modelID) : array { return [];}
    public function cleanModel(Model $model): array {return [];}

}

// echo '<pre>'; var_dump(); echo '</pre>'; exit;
