<?php 

namespace src\controllers;

use src\models\Customer;
use src\models\ModelDAO\AgentDAO;
use src\models\ModelDAO\CustomerDAO;
use src\models\ModelDAO\ModelDAO;
use src\models\ModelDAO\PropertyDAO;
use src\utils\Application;
use src\utils\Request;
use src\utils\Response;
use src\models\Model;

class CustomerController extends Controller {

    private CustomerDAO $customerDAO;
    private int $propertyID;
    private int $agentID;

    public function __construct() {

        $this->model = new Customer();
        $this->customerDAO = new CustomerDAO($this->model);
        $this->response = new Response();

    }

    public function prepareModel($modelID): array {return [];}
    public function cleanModel(Model $model): array {return [];}

    public function newCustomer(Request $request) {

        if(!(Application::$application->validateToken($request->getFormInputs()['token']))) {
            echo json_encode(['status' => false, 'response' => 'Unauthorized']);
            exit;
        }
        if(!$request->isPost()) {
            echo json_encode(['status' => false, 'response' => 'Unauthorized']);
            exit;
        }

        //Check if this request if from a property page
        $propertyCode = $request->getFormInputs()['prop_code'] ?? false;

        //Get customer details
        $this->requestBody = $request->getFormInputs();
        $this->model->loadData($this->requestBody);

        //Validate customer input
        if(!$this->model->validate()) {

            $this->response->setResponseContent(['Please fill form completely!']);
            echo json_encode(['status' => false, 'response' => $this->response->getResponseContent()]);
            exit;
        }

        if($this->customerDAO->saveCustomerDetails()) {

           $this->model->customerID = ModelDAO::getLastInsertedModel('customer', 'id')[0]['id'];

            //Get property code if available
            if($propertyCode) {

                $this->propertyID = PropertyDAO::getPropertyByCode($propertyCode)[0]['id'];
                $this->agentID = PropertyDAO::getAgentIDByPropertyID($this->propertyID)[0]['agent_id'];

                if($this->propertyID AND $this->agentID) {
                    $this->customerDAO->saveCustomerRequest($this->propertyID, $this->agentID);

                    //Send message to the agent in charge of the property                    
                    if($this->sendRequestToAgent(get_object_vars($this->model))) {

                        echo json_encode(['status' => true, 'response' => 'Request sent successfully!']);
                        exit;
                    }
                    else {
                        echo json_encode(['status' => false, 'response' => 'Request sent could not send, try again!']);
                        exit;
                    }
                }
            } 

            echo json_encode(['status' => true, 'response' => 'Message sent successfully!']);
        }
    }

    public function sendRequestToAgent($data) {

        $first_name = $data['firstName'] ?? false;
        $last_name = $data['lastName'] ?? false;
        $emailAddress = $data['emailAddress'] ?? false;
        $messages = $data['messages'] ?? false;

        if(!($first_name AND $emailAddress AND $messages)) {
            return false;
        }
        
        $property = PropertyDAO::getPropertyDetailsByID($this->propertyID)[0];

        $agentEmail = AgentDAO::getAgentByID($this->agentID)[0]['email'];
        $subject = "Enquiry on ".$property['title']." - ". $property['code']; 

        $emailContent = 'This is an enuiry';

        $email_headers = "MIME-Version: 1.0" . "\r\n";
        $email_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $email_headers .= 'From:' . $first_name . ' ' . 'noreply@yourdomain.com' . "\r\n";
        $email_headers .= 'Reply-To:' . $emailAddress . "\r\n";

        return (mail($agentEmail, $emailContent, $email_headers)) ? true : false;
    }
}