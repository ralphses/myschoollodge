<?php

namespace src\controllers;

use src\utils\Request;
use src\utils\Response;
use src\models\Model;

class SearchController extends Controller {

    public function __construct() {
        $this->response = new Response();
    }

    public function prepareModel($modelID): array {return [];}
    public function cleanModel(Model $model): array {return [];}

    public function searchAll(Request $request) {
        
        var_dump($request->getFormInputs()['form_']);
    }
    
}