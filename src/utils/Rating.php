<?php 

namespace src\utils;

use src\models\ModelDAO\ModelDAO;

class Rating {
    
    private int $total_rating = 0;
    private int $no_of_rating = 0;
    private float $avg_rating = 0.0;

    private function __construct() {}

    public static function getNewRating() {
        $rating = new Rating();
        return self::getARating($rating);
    }

    private static function getARating($rating) {
        $sql = 'INSERT INTO rating (total_rating, no_of_rating, avg_rating) VALUES (:total_rating, :no_of_rating, :avg_rating);';
        if(ModelDAO::getConnection()->executeQuery($sql, get_object_vars($rating))['count']){
            return ModelDAO::getLastInsertedModel('rating', 'rating_id');
        }
        return false;
    }

    public static function updateRating($rating_id, $rating_value){

        $sql = 'SELECT * FROM rating WHERE id = :id;';
        $thisRating = ModelDAO::getConnection()->executeQuery($sql, ['id' => $rating_id])['data'];

        $total_rating = intval($thisRating['total_rating']) + $rating_value;
        $no_of_rating = intval($thisRating['no_of_rating']) + 1;

        $new_avg_rating = $total_rating / $no_of_rating;

        $sql = 'UPDATE rating SET avg_rating = :avg_rating WHERE id = :id;';
        return ModelDAO::getConnection()->executeQuery($sql, ['avg_rating' => $new_avg_rating, 'id' => $rating_id])['count'];

    }

    public static function getRating($id) {

        $sql = 'SELECT avg_rating FROM rating WHERE id = :id;';
        return ModelDAO::getConnection()->executeQuery($sql, ['id' => $id])[1];

    }

    
}