<?php

namespace src\models\ModelDAO;

use src\models\Model;
use src\utils\Database;
use src\utils\ImageHandler;

class ModelDAO {

    private static Database $database;
    protected Model $model;
    protected ImageHandler $imageHandler;
    protected array $modelBody;

    public function __construct() {
       self::$database = new Database();
    }

    public static function getConnection() {
        return self::$database;
    }
 
     public static function getLastInsertedModel($table, $id) {
        $sql = "SELECT * FROM $table ORDER BY $id DESC LIMIT 1";
        return self::getConnection()->executeQuery($sql)['data'];
    }

}