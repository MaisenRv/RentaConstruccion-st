<?PHP 
require_once __DIR__."/../app/controllers/user/UserC.php";
require_once __DIR__."/../app/db.php";

$actionName = isset($_GET['action']) ? $_GET['action'] : 'login';

// Controllers
$userC = new UserC();

function checkSession(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!isset($_SESSION['correo']) || !isset($_SESSION['contrasena'])){
        UserC::blockSession();
        return false;
    }
    return true;

}

// Router
if($actionName == "login"){
    $userC->login();
}elseif(checkSession()){

}

?>