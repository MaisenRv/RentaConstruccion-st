<?PHP 
require_once __DIR__."/../app/autoload.php";
use Controllers\UserC;
use Controllers\RolC;

$actionName = isset($_GET['action']) ? $_GET['action'] : 'login';

// Controllers
$userC = new UserC();
$rolC = new RolC();


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
    $userC->login($rolC->getAll());
}elseif(checkSession()){

}

?>