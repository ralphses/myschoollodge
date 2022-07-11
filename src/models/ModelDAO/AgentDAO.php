<?php 

namespace src\models\ModelDAO;

use src\models\Agent;
use src\utils\Rating;


class AgentDAO extends ModelDAO {

    public function __construct(Agent $agent) {
        $this->model = $agent;
    }

    /**
     * Methods for updating an existing Agents
     */

    public function updateAgent($agentID) {

        $sql = "UPDATE `agent` SET 
                `agent_title`= :agent_title, 
                `email`= :email, 
                `address`= :address,
                `phone`= :phone 
                WHERE agent_id = :agent_id;";

        $body = [
                'agent_title' => $this->model->agent_name,
                'email' => $this->model->agent_email,
                'address' =>  $this->model->agent_address,
                'phone' => $this->model->agent_phone,
                'agent_id' => $agentID
            ];

            return self::getConnection()->executeQuery($sql, $body)['count'];
        
    } 

    public function saveNewAgent() {

            $body = [
                'agent_title' => $this->model->agent_name,
                'email' => $this->model->agent_email,
                'password' => $this->model->agent_password,
                'phone' => $this->model->agent_phone,
                'agent_rating_id' => Rating::getNewRating()[0]['rating_id']
            ];
    
            $sql = "INSERT INTO `agent`(`agent_title`, `email`, `password`, `phone`, `agent_rating_id`) 
                    VALUES (:agent_title, :email, :password,  :phone, :agent_rating_id);";
            
            $body['password'] = password_hash($body['password'], PASSWORD_DEFAULT);
            
            return self::getConnection()->executeQuery($sql, $body)['count'];

        }
    

    public static function saveAgentAuthDocuments($agentID, $type, $no, $image) {

        $body = [
            'id_no' => $no,
            'id_type' => $type,
            'agent_agent_id' => $agentID
        ];

        $sql = 'INSERT INTO `agent_auth_details`(`id_no`, `id_type`, `agent_agent_id`) 
                VALUES (:id_no, :id_type, :agent_agent_id);';
        
        return self::getConnection()->executeQuery($sql, $body)['count'];

    }

    public static function updateAgentAuthDocuments($agentID, $type, $no) {

        $body = [
            'id_no' => $no,
            'id_type' => $type,
            'agent_agent_id' => $agentID
        ];

        $sql = 'UPDATE `agent_auth_details` SET `id_no` = :id_no, `id_type` = :id_type WHERE `agent_agent_id` = :agent_agent_id;';
        return self::getConnection()->executeQuery($sql, $body)['count'];

    }


    public function insertIDimage($agentID) {

        $sql = 'INSERT INTO `images`(`id`, `imageURL`, `image_type`) 
        VALUES (:id, :imageURL, :image_type);';

        $body = [
            'id' => $agentID,
            'imageURL' => $this->model->agent_id_image,
            'image_type' => 'agent auth ID'
        ];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }

    public static function getAgentIdImageURL($agentID) {
        $sql = "SELECT  `imageURL` FROM `images` 
                WHERE id = :id AND image_type = 'ID' AND model = 'Agent';";

        $body = ['id' => $agentID];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }    

    public static function getAgentImageURL($agentID) {
        $sql = "SELECT  `imageURL` FROM `images` 
                WHERE imageURL LIKE '%agent%' 
                AND id = :id AND image_type = 'Featured image';";

        $body = ['id' => $agentID];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }    


    public static function getAgentSocials($agentID) {
        $sql = "SELECT * FROM `agent_social` WHERE agent_id = :agent_id;";
        $body = ['agent_id' => $agentID];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function getAgentAgencyAndRole($agentID) {
        
        $sql = 'SELECT agent_role AS role, agency_name AS agency 
                FROM `agency_has_agent` 
                JOIN agency ON agency_has_agent.agency_id = agency.agency_id 
                WHERE agent_id = :agent_id;';
        
        $body = ['agent_id' => $agentID];
        return self::getConnection()->executeQuery($sql, $body)['data'];
    }
    
    public function saveAgentSocials($socials, $agentID) {

        foreach($socials as $key => $value) {
            $sql = 'INSERT INTO `agent_social`(`agent_id`, `social_title`, `social_link`) 
                    VALUES (:agent_id, :social_title, :social_link);';

            self::getConnection()->executeQuery(
                $sql, 
                [
                    'agent_id' => $agentID, 
                    'social_title' => $key, 
                    'social_link' => $value
                ]
            );
        }
    }

    public function updateAgentSocials($socials, $agentID) {

        foreach($socials as $key => $value) {
            $sql = 'UPDATE `agent_social` 
                    SET `social_title = :social_title`, `social_link = :social_link` 
                    WHERE `agent_id` = :agent_id;';

            self::getConnection()->executeQuery(
                $sql, 
                [
                    'agent_id' => $agentID, 
                    'social_title' => $key, 
                    'social_link' => $value
                ]
            );
        }
    }

    public static function getOneAgentSocialsByID($id, $socialType) {

        $sql = "SELECT * FROM agent_social 
                WHERE agent_id = :agent_id 
                AND `social_title` = :social_title;";

       $body = [
            'agent_id' => $id,
            'social_title' => $socialType
       ];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function saveAgentAgency($agency_id, $agent_id, $role) {
        $sql = 'INSERT INTO `agency_has_agent`(`agency_id`, `agent_id`, `agent_role`) 
                VALUES (:agency_id, :agent_id, :agent_role)';

        $body = [
            'agency_id' => $agency_id,
            'agent_id' => $agent_id,
            'agent_role' => $role
        ];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }

    public static function updateAgentAgency($agency_id, $agent_id, $role) {
        $sql = 'UPDATE `agency_has_agent`(`agency_id`, `agent_id`, `agent_role`) 
                VALUES (:agency_id, :agent_id, :agent_role)';

        $body = [
            'agency_id' => $agency_id,
            'agent_id' => $agent_id,
            'agent_role' => $role
        ];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }

    public static function removeAgentAgency($agent_id) {
        $sql = 'DELETE FROM `agency_has_agent`WHERE agent_id = :agent_id';

        $body = [
            'agent_id' => $agent_id
        ];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }
    
    /**
     * @param $key any property perculiar to this Agent
     * 
     */
    public static function getAgentByID($id) {

        $sql = "SELECT `agent_id`, `agent_title`, `email`,`phone`, `address`, `status`, `agent_rating_id` FROM agent 
                WHERE agent.agent_id = :agent_id;";
                
        $body['agent_id'] = $id;

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function getAgentSocialsByID($id) {
        $sql = "SELECT * FROM agent_social WHERE agent_id = :agent_id;";
        $body['agent_id'] = $id;

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function getAgentAuthDetailsByID($agentID) {

        $sql = "SELECT * FROM agent_auth_details 
                WHERE agent_agent_id = :agent_agent_id;";

        $body['agent_agent_id'] = $agentID;

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function saveAgentProperty($agent_id, $property_id) {
        $sql = "INSERT INTO `agent_has_property`(`agent_id`, `property_id`) 
                VALUES (:agent_id, :property_id);";
        $body = ['agent_id' => $agent_id, 'property_id' => $property_id];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }

    public static function getAgentByEmail($agent_email) {

        $sql = "SELECT `agent_id`, `agent_title`, `email`, `password`, `phone`, `address`, `status`, `agent_rating_id` 
                FROM `agent` WHERE email = :email;";

        $body['email'] = $agent_email;

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function checkPhone($phone) {
        $sql = "SELECT phone FROM agent WHERE phone = :phone;";
        $body = ['phone' => $phone];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function checkEmail($email) {
        $sql = "SELECT email FROM agent WHERE email = :email;";
        $body = ['email' => $email];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function getAgentRecentRequests($agentID) {

        $sql = 'SELECT customer.first_name, customer.phone, property.title FROM `customer_request` 
                INNER JOIN customer ON customer.id = customer_request.customer_id
                INNER JOIN agent ON agent.agent_id = customer_request.agent_id
                INNER JOIN property ON property.id = customer_request.property_id
                WHERE customer_request.agent_id = :agent_id; ';

        $body = ['agent_id' => $agentID];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function getAgentCompleteRegStatus($agent_id) {
        $sql = 'SELECT `id_no` FROM `agent_auth_details` WHERE agent_agent_id = :id;';
        $body = ['id' => $agent_id];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }

    public static function getAllAgent() {
        $sql = 'SELECT `agent_id`, `agent_title`, `email`, `phone`, `address`, `avg_rating` 
                FROM `agent` 
                INNER JOIN rating ON rating.rating_id = agent.agent_rating_id;';
        return self::getConnection()->executeQuery($sql)['data'];
    }


    public static function getAgentProperty() {
        
    }

    public static function removeAgent($agentID) {
        
    }
}
    // echo '<pre>'; var_dump($request->getFormInputs()); echo '</pre>'; exit;
