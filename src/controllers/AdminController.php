<?php

namespace src\controllers;

use src\models\Admin;
use src\models\Model;
use src\models\ModelDAO\AdminDAO;
use src\models\ModelDAO\CustomerDAO;
use src\models\ModelDAO\UtilDAO;
use src\models\ModelDAO\PropertyDAO;
use src\utils\Request;
use src\utils\Response;

class AdminController extends Controller {

    private AdminDAO $adminDAO;

    public function __construct() {

        $this->model = new Admin();
        $this->response = new Response();
        $this->adminDAO = new AdminDAO($this->model);
        $this->setLayout('admin');

    }

    public function addAdmin(Request $request) {
        
        if(!$request->isPost()) {

            header("Location: /");
        }

        $inputs = $request->getFormInputs();
        $this->model->loadData($inputs);

        if(!$this->model->validate()) {
            echo json_encode(['status' => false, 'response' => $this->model->errors]);
            exit;
        }

        if($this->adminDAO->saveAdmin($this->getRandomName(8))) {
            echo json_encode(['status' => true, 'response' => 'Admin added successfully!']);
            exit;
        }
        
    }

    public function activateAdmin(Request $request) {

    }

    public function removeAdmin(Request $request) {

    }


    public function prepareModel($modelId) : array {

        if($_SESSION['admin_logged_in']) {

            $data = $this->adminDAO->getAdminById($modelId)[0];
            $data['total_lodges'] = PropertyDAO::getTotalProperties()[0]['total_properties'];
            $data['total_request'] = PropertyDAO::getTotalCustomerRequest()[0]['total_request'];
            $data['total_pending_request'] = PropertyDAO::getTotalPendingCustomerRequest()[0]['total_request'];
            $data['total_completed_request'] = PropertyDAO::getTotalCompletedCustomerRequest()[0]['total_request'];
            $data['activities'] = UtilDAO::getAdminActivities($modelId);
            $data['recent_request'] = $this->prepareRequest(UtilDAO::getRecentRequests($modelId));

            return $data;
        }
       
    }

    public function cleanModel(Model $model) : array {
        return [];
    }

    private function prepareRequest($requests) {
        $readyRequests = [];

        foreach($requests as $key => $value) {

            $customer = CustomerDAO::getCustomerById($value['customer_id'])[0];
            $customerName = $customer['first_name']." ".$customer['other_name'];
            $propertyName = PropertyDAO::getPropertyDetailsByID($value['property_id'])[0]['title'];

            $readyRequests[] = $customerName. ' is interested in ' .$propertyName;
        }

        return  $readyRequests;

    }
}

// echo '<pre>'; var_dump($data); echo '</pre>'; exit;