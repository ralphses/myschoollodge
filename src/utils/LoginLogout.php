<?php 

namespace src\utils;

use src\controllers\Controller;
use src\models\ModelDAO\AgentDAO;
use src\models\ModelDAO\UtilDAO;

class LoginLogout extends Controller {

    public const MAX_LOGIN_ATTEMPTS_PER_HOUR = 5;
	public const MAX_EMAIL_VERIFICATION_REQUESTS_PER_DAY = 3;
	public const MAX_PASSWORD_RESET_REQUESTS_PER_DAY = 3;
	public const PASSWORD_RESET_REQUEST_EXPIRY_TIME = (60*60);

    public static function logingNewUser(Request $request) {

        if(!(Application::$application->validateToken($request->getFormInputs()['token']))) {
            echo json_encode(['status' => false, 'response' => 'Unauthorized']);
            exit;
        }
           
        if(!$request->isPost()) {
            echo json_encode(['status' => false, 'response' => 'Unauthorized']);
            exit;
        }

        $userName = $request->getFormInputs()['email_address'] ?? false;
        $password = $request->getFormInputs()['agent_password'] ?? false;

        //Unlock if more than 24 hours
        $lastLoginTime = date('Y-m-d H:m:s', strtotime(UtilDAO::getlastLoginTime($userName)));
        $thisTime = date('Y-m-d H:m:s', strtotime( '+1hour', strtotime(UtilDAO::getlastLoginTime($userName))));
    
        if($lastLoginTime > $thisTime and intval(UtilDAO::getNoOfLogins($userName)) < 10) {
            UtilDAO::clearLogins($userName);
        }

        if(!($userName and $password)) {
            echo json_encode(['response' => 'Invalid login details, please check']);
            exit;
        }

        if(intval(UtilDAO::getNoOfLogins($userName)) > 20) {
            header('Location: /fake-agent');
            exit;
        }

        if(intval(UtilDAO::getNoOfLogins($userName)) > self::MAX_LOGIN_ATTEMPTS_PER_HOUR) {
            echo json_encode(['response' => "For security reasons, your account is temporary locked\nkindly reset your password"]);
            exit;
        }

        $agent = AgentDAO::getAgentByEmail($userName);

        if($agent and password_verify($password, $agent[0]['password'])) {

            session_regenerate_id(true); //create a new session id
            $_SESSION['logged_in'] = true;
            $_SESSION['agent'] = $agent[0]['agent_id'];
            $_SESSION['agent_image'] = $agent[0]['image'];

            echo json_encode(['status' => true, 'response' => 'Invalid login details, please check']);
            exit;

            UtilDAO::clearLogins($userName);

        }
        else {

            UtilDAO::registerLoginAttempt($userName);
            echo json_encode(['response' => 'Invalid login details, please check']);
            exit;
        }

    }

    public function logingOUTUser($request) {

        if(!(Application::$application->validateToken($request->getFormInputs()['token']))) {
            echo json_encode(['status' => false, 'response' => 'Unauthorized']);
            exit;
        }
           
        if(!$request->isPost()) {
            echo json_encode(['status' => false, 'response' => 'Unauthorized']);
            exit;
        }

        if($_SESSION['logged_in'] AND $_SESSION['agent']) {

             // unset session
            $_SESSION = array();

            // If it's desired to kill the session, also delete the session cookie.
            // Note: This will destroy the session, and not just the session data!
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }

            session_destroy();

            echo json_encode(['status' => true]);
            exit;
        }
       
    }

    public function createPasswordNew(Request $request) {


    }

    public function resetingPass(Request $request) {
        //If email is registered and valid, send validation link to emai;
        //include this email in the link
        //also include a unique token
    }
}