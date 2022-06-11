<?php 

namespace src\utils;

use src\models\ModelDAO\ModelDAO;
use src\models\ModelDAO\UtilDAO;

class Rating {
    
    public int $total_rating = 0;
    public int $no_of_rating = 0;
    public float $avg_rating = 0.0;
    

    private function __construct() {}

    public static function getNewRating() {
        $rating = new Rating();
        return self::getARating($rating);
    }

    private static function getARating(Rating $rating) {

        if(UtilDAO::newRating($rating)){

            return ModelDAO::getLastInsertedModel('rating', 'rating_id');
        }
        return false;
    }

    public static function updateRating($rating_id, $rating_value){

        $thisRating = UtilDAO::getRating($rating_id);

        $total_rating = intval($thisRating['total_rating']) + $rating_value;
        $no_of_rating = intval($thisRating['no_of_rating']) + 1;

        //Evaluate the new rating value
        $new_avg_rating = $total_rating / $no_of_rating;

       return UtilDAO::updateRating($rating_id, $new_avg_rating);

    }


    
}