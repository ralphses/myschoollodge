<?php

namespace src\utils;

class Request {

    public function getPath() {

        $path = $_SERVER['REQUEST_URI'];
        $dotPos =strpos($path, '.') ?? false;
        $pos = strpos($path, '?') ?? false;

        $path = ($dotPos) ? str_replace(substr($path, $dotPos, strlen($path) - 1), '', $path) : $path;
        return ($pos) ? str_replace(substr($path, $pos, strlen($path) - 1), '', $path): $path;
        
    }

    public function method() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isPost() {
        return $this->method() === 'post';
    }

    public function isGet() {
        return $this->method() === 'get';
    }

    public function getFormInputs() {
        $formInputs = [];

        if($this->isPost()) {
            foreach($_POST as $key => $value) {
                $formInputs[$key] = strip_tags(trim(filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS)));
            }  
        }
        if($this->isGet()) {
            foreach($_GET as $key => $value) {
                $formInputs[$key] = strip_tags(trim(filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS)));
            }
        }
        return $formInputs;
    }
}