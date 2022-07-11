<?php 

namespace src\models\ModelDAO;

use src\models\Admin;

class AdminDAO extends ModelDAO {

    public function __construct(Admin $admin) {
        $this->model = $admin;
    }

    public function saveAdmin($randomPassword) {
        $sql = 'INSERT INTO `admin`(`full_name`, `phone`, `email`, `tmp_pass`, `role`, `code`) 
                VALUES (:full_name, :phone, :email, :tmp_pass, :role, :code);';
        
        $body = [
            'full_name' => $this->model->name,
            'phone' => $this->model->phoneNumber,
            'email' => $this->model->emailAddress,
            'tmp_pass' => $randomPassword,
            'role' => $this->model->role,
            'code' => $this->model->roleCode
        ];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }

    public function getAdminById($adminId) {
        $sql = 'SELECT `id`, `full_name`, `phone`, `email`, `status`, `role`, `code` FROM `admin` WHERE admin.id = :id;';
        return self::getConnection()->executeQuery($sql, ['id' => $adminId])['data'];
    }


    /**
     * STATIC FUNCTIONS
     */
    public static function getAdminByEmail($email) {
        $sql = 'SELECT * FROM `admin` 
                WHERE admin.email = :email;';
        
        $body = ['email' => $email];

        return self::getConnection()->executeQuery($sql, $body)['data'];
    }

    public static function clearTempPass($adminId) {
        $sql = "UPDATE `admin` SET `tmp_pass` = NULL 
                WHERE admin.id = :id;";
        $body = ['id' => $adminId];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }

    public static function newPassword($adminId, $newPassword) {
        $sql = "UPDATE `admin` SET `password` = :password, `status` = 1 
        WHERE admin.id = :id;";
        
        $body = [
            'id' => $adminId,
            'password' => password_hash($newPassword, PASSWORD_DEFAULT)
        ];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }
}