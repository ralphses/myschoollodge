<?php

namespace src\utils;

use src\controllers\Controller;
use src\models\ModelDAO\ModelDAO;

class Application {

    private const CSRF_TOKEN_SECRET = 'Amazing, You know i love you VERY MUCH!';

    public static string $ROOTH;
    public static Application $application;
    
    public Request $request;
    public Response $response;
    public Router $router;
    public Controller $controller;
    

    public function __construct($roothPath) {

        $this->init();

        $dao = new ModelDAO();
        $this->database = new Database();
        $this->response = new Response();
        $this->request = new Request();
        $this->router = new Router($this->request, $this->response);

        self::$ROOTH = $roothPath;
        self::$application = $this;
        
    }

    function createToken() {
		$seed = $this->urlSafeEncode(random_bytes(8));
		$t = time();
		$hash = $this->urlSafeEncode(hash_hmac('sha256', session_id() . $seed . $t, $this->getToken(), true));
		return $this->urlSafeEncode($hash . '|' . $seed . '|' . $t);
	}

	function validateToken($token) {
		$parts = explode('|', $this->urlSafeDecode($token));
		if(count($parts) === 3) {
			$hash = hash_hmac('sha256', session_id() . $parts[1] . $parts[2], $this->getToken(), true);
			if(hash_equals($hash, $this->urlSafeDecode($parts[0]))) {
				return true;
			}
		}
		return false;
	}

	function urlSafeEncode($m) {
		return rtrim(strtr(base64_encode($m), '+/', '-_'), '=');
	}

	function urlSafeDecode($m) {
		return base64_decode(strtr($m, '-_', '+/'));
	}

    public function setController(Controller $controller) {
        $this->controller = $controller;
    }

    public function getController() {
        return $this->controller;
    }

    public function getRouter() {
        return $this->router;
    }

    public function getToken() {
        return self::CSRF_TOKEN_SECRET;
    }

    private function init() {
        date_default_timezone_set('UTC'); 
        // error_reporting(0);
        session_set_cookie_params(['samesite' => 'Strict']);
        session_start();
    }
}