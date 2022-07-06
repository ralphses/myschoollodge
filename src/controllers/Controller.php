<?php

namespace src\controllers;

use src\models\Model;
use src\models\ModelDAO\ModelDAO;
use src\utils\Application;
use src\utils\ImageHandler;
use src\utils\Response;

abstract class Controller {

    public string $layout;
    
    public Model $model;
    public ModelDAO $modelDAO;
    public ImageHandler $imageHandler;
    public Response $response;
    public array $requestBody;

    public function __construct() {
        Application::$application->setController($this);
    }

    public abstract function prepareModel($modelID): array;
    public abstract function cleanModel(Model $model): array;

    public function setLayout($layout) {
        $this->layout = $layout;
    }

    public function getLayout($layout) {
        return $this->layout;
    }

    public function render($view, $params = []) {
        echo Application::$application->getRouter()->renderView($view, $params);
    }

    protected function getRandomName($imageLength = 7) {
        $chars = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
        $folder = '';

        for($i = 0; $i < $imageLength; $i++) {
            $index = rand(0, strlen($chars) - 1);
            $folder .= $chars[$index]; 
        }
        return $folder;
    }

}