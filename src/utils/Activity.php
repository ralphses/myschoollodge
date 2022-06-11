<?php

namespace src\utils;

use src\models\ModelDAO\UtilDAO;

class Activity {

    private string $activity;
    private string $user_id;

    private function __construct(string $activity, string $user_id) {

        $this->activity = $activity;
        $this->user_id = $user_id;        
    }

    public static function createActivity(string $activity, $user_id) {
        $newActivity = new Activity($activity, $user_id);

        return $newActivity->saveActivity();
    }

    private function saveActivity() {
        return UtilDAO::saveActivity($this);
    }
}