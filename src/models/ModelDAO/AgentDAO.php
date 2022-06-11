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
                `password`= :password,
                `address`= :address,
                `phone`= :phone 
                WHERE agent_id =: agent_id;";

        $body = [
                'agent_title' => $this->model->agent_name,
                'email' => $this->model->agent_email,
                'address' =>  $this->model->agent_address,
                'password' => $this->model->agent_password,
                'phone' => $this->model->agent_phone,
                'agent_id' => $agentID
            ];

            $body['password'] = password_hash($body['password'], PASSWORD_DEFAULT);
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
    

    public function saveAgentAuthDocuments($agentID) {

        $body = [
            'id_no' => $this->model->agent_id_no,
            'id_type' => $this->model->agent_id_type
        ];
        
        $body['agent_agent_id'] = $agentID;

        $sql = 'INSERT INTO `agent_auth_details`(`id_no`, `id_type`, `agent_agent_id`) 
                VALUES (:id_no, :id_type, :agent_agent_id);';
        
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
                WHERE imageURL LIKE '%agentID%'' 
                AND id = :id AND image_type = 'ID';";

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
    
    public function saveAgentSocials($agentID) {

        foreach($this->model->socials as $key => $value) {
            $sql = 'INSERT INTO `agent_social`(`agent_id`, `social_title`, `social_link`) 
                    VALUES (:agent_id, :social_title, :social_link);';

            self::getConnection()->executeQuery($sql, ['agent_id' => $agentID, 'social_title' => $key, 'social_link' => $value]);
        }
    }

    public static function saveAgentAgency($agency_id, $agent_id) {
        $sql = 'INSERT INTO `agency_has_agent`(`agency_id`, `agent_id`) 
                VALUES (:agency_id, :agent_id)';

        $body['agency_id'] = $agency_id;
        $body['agent_id'] = $agent_id;

        return self::getConnection()->executeQuery($sql, $body)['county'];
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


    public static function getAgentProperty() {
        
    }

    public static function removeAgent($agentID) {
        
    }
}
    // echo '<pre>'; var_dump($request->getFormInputs()); echo '</pre>'; exit;
