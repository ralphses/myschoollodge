<?php 

namespace src\models\ModelDAO;

use src\utils\Activity;
use src\utils\Rating;

class UtilDAO extends ModelDAO{

    public static function registerLoginAttempt(string $email_address) {

        $sql = 'INSERT INTO `login_attempt`(`email`) 
                VALUES (:email);';
        $body = ['email' => $email_address];

        return ModelDAO::getConnection()->executeQuery($sql, $body)['count'];
    }

    public static function getNoOfLogins(string $email_address) {

        $sql = "SELECT COUNT(*) AS total FROM `login_attempt` WHERE email = :email;";
        $body = ['email' => $email_address];

        return ModelDAO::getConnection()->executeQuery($sql, $body)['data'][0]['total'];
    }

     public static function getlastLoginTime(string $email_address) {

        $sql = "SELECT * FROM `login_attempt`;";
        $body = ['email' => $email_address];

        return ModelDAO::getConnection()->executeQuery($sql, $body)['data'][0]['login_time'];
    }

    public static function clearLogins(string $email) {

        $sql = "DELETE FROM `login_attempt` WHERE email = :email;";
        $body = ['email' => $email];

        return ModelDAO::getConnection()->executeQuery($sql, $body)['count'];
    }

    public static function newRating(Rating $rating) {

        // var_dump($rating); exit;

        $sql = 'INSERT INTO `rating`(`total_rating`, `no_of_rating`, `avg_rating`) VALUES (:total_rating, :no_of_rating, :avg_rating);';
        return self::getConnection()->executeQuery($sql, get_object_vars($rating))['count'] ?? false;

    }

    public static function getRating($rating_id) {

        $sql = 'SELECT * FROM rating WHERE id = :id;';

        //Get current rating
        return self::getConnection()->executeQuery($sql, ['id' => $rating_id])['data'];
    }

    public static function updateRating($rating_id, $new_rating_value) {

        $sql = 'UPDATE rating SET avg_rating = :avg_rating WHERE id = :id;';
        return ModelDAO::getConnection()->executeQuery($sql, ['avg_rating' => $new_rating_value, 'id' => $rating_id])['count'];
        
    }

    public static function getFullLocation($id) {
        $sql = "SELECT * FROM location WHERE location_id = :location_id;";
        $body = ['location_id' => $id];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    } 

    public static function getAllImages($identity_id) {
        $sql = "SELECT * FROM images WHERE id = :id;";
        $body = ['id' => $identity_id];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function getSingleImage($img_id) {
        $sql = "SELECT imageURL FROM images WHERE image_id = :image_id;";
        $body = ['image_id' => $img_id];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function deleteImageFromDB($identity_id) {
        $sql = "DELETE FROM `images` WHERE id = :id;";
        $body = ['id' => $identity_id];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }

    public static function getAgentProperties($userID) {
        $sql = "SELECT * FROM property WHERE agent_id = :agent_id;";
        $body = ['agent_id' => $userID];

        return self::getConnection()->executeQuery($sql, $body)['data'][0];
    }

    public static function deleteLocation($id) {

        $sql = "DELETE FROM `location` WHERE location_id = :location_id;";
        $body = ['location_id' => $id];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }

    public static function saveActivity(Activity $activity) {
        $sql = "INSERT INTO `recent_activities`(`agent_id`, `activity`) 
                VALUES (:agent_id, :activity);";
        $body = [
            'agent_id' => $activity->user_id,
            'activity' => $activity->activity
        ];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }

    public static function getUserActivities($thisAgentId) {
        
        $sql = "SELECT `activity`, `date_added` 
                FROM `recent_activities` 
                WHERE agent_id = :agent_id ORDER BY id DESC LIMIT 5;";
        $body = ['agent_id' => $thisAgentId];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function getAgentRequests($userID, $count = false) {
        $sql = "SELECT * FROM customer_request WHERE agent_id = :agent_id;";
        $body = ['agent_id' => $userID];

        return (!$count) ? self::getConnection()->executeQuery($sql, $body)['data'] : self::getConnection()->executeQuery($sql, $body)['count']; 
    }

    public static function getUserCompleteRequests($userID) {

        $sql = "SELECT  customer_request.id, first_name, customer_request.status, other_name, phone, title 
                FROM `customer_request` 
                JOIN customer ON customer_request.customer_id = customer.id 
                JOIN property ON property.id = customer_request.property_id 
                WHERE customer_request.agent_id = :agent_id;";

        $body = ['agent_id' => $userID];

        return self::getConnection()->executeQuery($sql, $body)['data']; 
    }

    public static function getAgentRecentRequests($userID, $count = false) {
        $sql = "SELECT * FROM customer_request WHERE agent_id = :agent_id ORDER BY request_date DESC LIMIT 3;";
        $body = ['agent_id' => $userID];

        return (!$count) ? self::getConnection()->executeQuery($sql, $body)['data'] : self::getConnection()->executeQuery($sql, $body)['count']; 
    }

    public static function getAgentPendingRequests($userID, $count = false) {
        $sql = "SELECT * FROM customer_request WHERE agent_id = :agent_id AND status = -1;";
        $body = ['agent_id' => $userID];

        return (!$count) ? self::getConnection()->executeQuery($sql, $body)['data'] : self::getConnection()->executeQuery($sql, $body)['count']; 
    }

    public static function getAgentCompletedRequests($userID, $count = false) {
        $sql = "SELECT * FROM customer_request WHERE agent_id = :agent_id AND status = 1;";
        $body = ['agent_id' => $userID];

        return (!$count) ? self::getConnection()->executeQuery($sql, $body)['data'] : self::getConnection()->executeQuery($sql, $body)['count']; 
    }

    public static function getAdminActivities($thisAgentId) {
        
        $sql = "SELECT `activity`, `date_added` 
                FROM `recent_activities` 
                WHERE agent_id = :agent_id AND `model` = 'Admin' ORDER BY id DESC LIMIT 5;";
        $body = ['agent_id' => $thisAgentId];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function getRecentRequests($userID) {
        $sql = "SELECT * FROM customer_request
                ORDER BY request_date DESC LIMIT 3;";

        $body = ['agent_id' => $userID];

        return self::getConnection()->executeQuery($sql, $body)['data']; 
    }
}