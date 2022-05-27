<?php

namespace src\controllers;

use src\utils\Request;
use src\utils\Response;

class SearchController extends Controller {

    public function __construct() {
        $this->response = new Response();
    }

    public function searchAll(Request $request) {
        
        var_dump($request->getFormInputs()['form_']);
    }
    
}