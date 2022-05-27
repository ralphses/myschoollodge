<?php 

namespace src\models\ModelDAO;

use src\models\Agent;
use src\utils\Rating;


class AgentDAO extends ModelDAO {

    public function __construct(Agent $agent) {
        $this->model = $agent;
    }

    public function saveNewAgent() {

        $modelBody = get_object_vars($this->model);

        if($modelBody['agent_image'] != '') {

            $body = [
                'agent_title' => $this->model->agent_name,
                'agent_username' => $this->model->username,
                'email' => $this->model->agent_email,
                'password' => $this->model->agent_password,
                'address' => $this->model->agent_address,
                'phone' => $this->model->agent_phone,
                'image' => $this->model->agent_image,
                'agent_rating_id' => Rating::getNewRating()[0]['rating_id']
            ];
    
            $sql = "INSERT INTO `agent`(`agent_title`, `agent_username`, `email`, `password`, `address`, `phone`, `image`, `agent_rating_id`) 
                    VALUES (:agent_title, :agent_username, :email, :password, :address, :phone, :image, :agent_rating_id);";
            
            $body['password'] = password_hash($body['password'], PASSWORD_DEFAULT);
            
            return self::getConnection()->executeQuery($sql, $body)['count'];

        }
        else {
            $body = [
                'agent_title' => $this->model->agent_name,
                'agent_username' => $this->model->username,
                'email' => $this->model->agent_email,
                'password' => $this->model->agent_password,
                'address' => $this->model->agent_address,
                'phone' => $this->model->agent_phone,
                'agent_rating_id' => Rating::getNewRating()[0]['rating_id']
            ];
    
            $sql = "INSERT INTO `agent` (`agent_title`, `agent_username`, `email`, `password`, `address`, `phone`, `agent_rating_id`) 
                    VALUES (:agent_title, :agent_username, :email, :password, :address, :phone, :agent_rating_id);";
            
            $body['password'] = password_hash($body['password'], PASSWORD_DEFAULT);
            
            return self::getConnection()->executeQuery($sql, $body)['count'];
        }
    }

    public function saveAgentAuthDocuments($agentID) {

        $body = [
            'id_no' => $this->model->agent_id_no,
            'id_type' => $this->model->agent_id_type,
            'id_image' => $this->model->agent_id_image
        ];
        
        $body['agent_agent_id'] = $agentID;

        $sql = 'INSERT INTO `agent_auth_details`(`id_no`, `id_type`, `id_image`, `agent_agent_id`) 
                VALUES (:id_no, :id_type, :id_image, :agent_agent_id);';
        
        return self::getConnection()->executeQuery($sql, $body)['count'];

    }

    public function saveAgentSocials($agentID) {

        foreach($this->model->socials as $key => $value) {
            $sql = 'INSERT INTO `agent_social`(`agent_id`, `social_title`, `social_link`) 
                    VALUES (:agent_id, :social_title, :social_link);';

            self::getConnection()->executeQuery($sql, ['agent_id' => $agentID, 'social_title' => $key, 'social_link' => $value]);
        }
    }

    public function saveAgentAgency($agency_id) {
        $sql = 'INSERT INTO `agency_has_agent`(`agency_id`, `agent_id`) 
                VALUES (:agency_id, :agent_id)';

        $body['agency_id'] = $agency_id;
        $body['agent_id'] = self::getLastInsertedModel('agent', 'agent_id');

        return self::getConnection()->executeQuery($sql, $body)['county'];
    }
    
    /**
     * @param $key any property perculiar to this Agent
     * 
     */
    public static function getAgentByID($id) {

        $sql = "SELECT * FROM agent 
                INNER JOIN agent_auth_details ON agent.agent_id = agent_auth_details.agent_agent_id
                WHERE agent.agent_id = :agent_id;";
                
        $body['agent_id'] = $id;

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function getAgentSocialsByID($id) {
        $sql = "SELECT * FROM agent_social WHERE agent_id = :agent_id;";
        $body['agent_id'] = $id;

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function saveAgentProperty($agent_id, $property_id) {
        $sql = "INSERT INTO `agent_has_property`(`agent_id`, `property_id`) 
                VALUES (:agent_id, :property_id);";
        $body = ['agent_id' => $agent_id, 'property_id' => $property_id];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }

    public static function getAgentByEmail($agent_email) {

        $sql = "SELECT *  FROM agent 
                JOIN (agent_social JOIN agent_auth_details 
                ON agent_social.agent_id = agent_auth_details.agent_agent_id) 
                ON agent.agent_id = agent_social.agent_id 
                WHERE email = :email LIMIT 1;";
        $body['email'] = $agent_email;

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function getAgentProperty() {
        
    }

    public static function removeAgent($agentID) {
        
    }
}
    // echo '<pre>'; var_dump($request->getFormInputs()); echo '</pre>'; exit;
