<?php 

namespace src\utils;

use src\controllers\Controller;
use src\models\ModelDAO\AgentDAO;
use src\models\ModelDAO\UtilDAO;
use src\models\ModelDAO\AdminDAO;
use src\models\Model;

class LoginLogout extends Controller {

    public const MAX_LOGIN_ATTEMPTS_PER_HOUR = 5;
	public const MAX_EMAIL_VERIFICATION_REQUESTS_PER_DAY = 3;
	public const MAX_PASSWORD_RESET_REQUESTS_PER_DAY = 3;
	public const PASSWORD_RESET_REQUEST_EXPIRY_TIME = (60*60);

    public function prepareModel($modelID): array {return [];}
    public function cleanModel(Model $model): array {return [];}

    public static function logingNewUser(Request $request) {

        // if(!(Application::$application->validateToken($request->getFormInputs()['token']))) {
        //     echo json_encode(['status' => false, 'response' => 'Unauthorized']);
        //     exit;
        // }
           
        if(!$request->isPost()) {
            echo json_encode(['status' => false, 'response' => 'Unauthorized']);
            exit;
        }

        $userName = $request->getFormInputs()['email_address'] ?? false;
        $password = $request->getFormInputs()['agent_password'] ?? false;


        // Unlock if more than 24 hours
        self::checkLogin($userName);

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

        if((strcasecmp($request->getPath(), '/admin') === 0)) {
            $thisAdmin = AdminDAO::getAdminByEmail($userName);

            if(($thisAdmin AND ($thisAdmin[0]['tmp_pass'] != "") AND (strcasecmp($password, $thisAdmin[0]['tmp_pass']) === 0))) {

                session_regenerate_id(true); //create a new session id
                $_SESSION['admin_logged_in'] = $_SESSION['new'] = true;
                $_SESSION['admin'] = $thisAdmin[0]['id'];

                header("Location: /new-password");
                exit;

            }
            if($thisAdmin AND password_verify($password, $thisAdmin[0]['password'])) {
            // if($thisAdmin AND (strcasecmp($password, $thisAdmin[0]['password']) === 0)) {

                session_regenerate_id(true); //create a new session id
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin'] = $thisAdmin[0]['id'];
                
    
                UtilDAO::clearLogins($userName);
                echo json_encode(['admin' => true, 'status' => true, 'response' => 'Login successful!']);
                exit;                
            }
            else {

                UtilDAO::registerLoginAttempt($userName);
                echo json_encode(['response' => 'Invalid login details, please check']);
                exit;
            }
        }

        $agent = AgentDAO::getAgentByEmail($userName);

        if($agent and password_verify($password, $agent[0]['password'])) {

            session_regenerate_id(true); //create a new session id
            $_SESSION['logged_in'] = true;
            $_SESSION['agent'] = $agent[0]['agent_id'];

            UtilDAO::clearLogins($userName);
            echo json_encode(['status' => true, 'response' => 'Login successful!']);
            exit;

        }
        else {

            UtilDAO::registerLoginAttempt($userName);
            echo json_encode(['response' => 'Invalid login details, please check']);
            exit;
        }

    }

    private static function checkLogin($userName) {

        if(UtilDAO::getNoOfLogins($userName) > 0) {

            $lastLoginTime = date('Y-m-d H:m:s', strtotime(UtilDAO::getlastLoginTime($userName)));
            $thisTime = date('Y-m-d H:m:s', strtotime( '+1hour', strtotime(UtilDAO::getlastLoginTime($userName))));
        
            if($lastLoginTime > $thisTime and intval(UtilDAO::getNoOfLogins($userName)) < 10) {
                UtilDAO::clearLogins($userName);
                return true;
            }
            return false;
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

    
        if(!$request->isPost() OR !( $_SESSION['admin_logged_in']) OR !( $_SESSION['admin'])) {
           
            header("Location: /");
            exit;
        }
        $newPasswordDeatails = $request->getFormInputs()?? false;

        if($newPasswordDeatails) {
            $newPassword = $newPasswordDeatails['pasword'];
            $confirmPassword = $newPasswordDeatails['confirm-password'];

            if($this->verifyPassword($newPassword) AND (strcasecmp($newPassword, $confirmPassword) === 0)) {

                AdminDAO::newPassword($_SESSION['admin'], $newPassword);
                echo json_encode(['status' => true, 'response' => 'Password Updated successfully!']);

                //Clear temp pass word
                AdminDAO::clearTempPass($_SESSION['admin']);
                exit;
            }

            else {
                echo json_encode(['status' => false, 'response' => 'Invalid password details, please check']);
                exit;
            }
        }
        echo json_encode(['status' => false, 'response' => 'Invalid login password, please check']);

       


    }

    private function verifyPassword($password) {
        return (preg_match('@[0-9]@', $password) and preg_match('@[A-Z]@', $password) and preg_match('@[a-z]@', $password));
    }

    public function resetingPass(Request $request) {
        //If email is registered and valid, send validation link to emai;
        //include this email in the link
        //also include a unique token
    }
}