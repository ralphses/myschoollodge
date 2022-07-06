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

    public static function saveModelImage($modelID, $imageURL, $imageType, $model) {
        $sql = 'INSERT INTO `images`(`id`, `imageURL`, `image_type`, `model`) 
                VALUES (:id, :imageURL, :image_type, :model);';
        $body = [
            'id' => $modelID,
            'imageURL' => $imageURL,
            'image_type' => $imageType,
            'model' => $model
        ];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }

    public static function updateModelImage($modelID, $imageURL, $imageType, $model) {
        $sql = 'UPDATE `images` 
                SET `imageURL` = :imageURL, `image_type` =:image_type, `model` = :model 
                WHERE `id` = :id;';

        $body = [
            'id' => $modelID,
            'imageURL' => $imageURL,
            'image_type' => $imageType,
            'model' => $model
        ];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }

    public static function getModelImage($modelID, $imageType, $model) {
        
        $sql = 'SELECT `imageURL` FROM `images` 
                WHERE images.id = :id 
                AND images.image_type = :image_type 
                AND images.model = :model;';

        $body = [
            'id' => $modelID,
            'image_type' => $imageType,
            'model' => $model
        ];

        return self::getConnection()->executeQuery($sql, $body)['count'];
    }
}