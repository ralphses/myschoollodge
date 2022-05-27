<?php 

namespace src\utils;

class Response {

    public array $responseContent = [];

    public function setStatusCode($code) {
        http_response_code($code);
    }

    public function setResponseContent($responseContent) {
        $this->responseContent = $responseContent;
    } 

    public function getResponseContent() {
        return $this->responseContent;
    }


}