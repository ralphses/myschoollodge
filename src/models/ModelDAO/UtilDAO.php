<?php 

namespace src\models\ModelDAO;

class UtilDAO {

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

        $sql = "SELECT login_time AS last_time FROM `login_attempt` WHERE email = :email ORDER BY login_time DESC;";
        $body = ['email' => $email_address];

        return ModelDAO::getConnection()->executeQuery($sql, $body)['data'][0]['last_time'];
    }

    public static function clearLogins(string $email_address) {

        $sql = "DELETE FROM `login_attempt` WHERE email = :email;";
        $body = ['email' => $email_address];

        return ModelDAO::getConnection()->executeQuery($sql, $body)['count'];
    }

}