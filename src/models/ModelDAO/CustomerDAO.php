<?php 

namespace src\models\ModelDAO;

use src\models\Customer;

class CustomerDAO extends ModelDAO {

    public function __construct(Customer $customer) {
        $this->model = $customer;
    }


    public function saveCustomerDetails() {

        $sql = "INSERT INTO `customer`(`first_name`, `other_name`, `phone`, `email`, `message`) 
                VALUES (:first_name, :other_name, :phone, :email, :message);";

        $this->modelBody = [

            'first_name' => $this->model->firstName,
            'other_name' => $this->model->lastName,
            'phone' => $this->model->phoneNumber,
            'email' => $this->model->emailAddress,
            'message' => $this->model->messages
        ];

        return self::getConnection()->executeQuery($sql, $this->modelBody)['count'];
    }
    

    public function saveCustomerRequest($propertyID, $agentID) {

        $sql = "INSERT INTO `customer_request`(`customer_id`, `property_id`, `agent_id`) 
                VALUES (:customer_id, :property_id, :agent_id);";
        
        $this->modelBody = [
            'customer_id' => $this->model->customerID,
            'property_id' => $propertyID,
            'agent_id' => $agentID
        ];

        return self::getConnection()->executeQuery($sql, $this->modelBody)['count'];
    }

}