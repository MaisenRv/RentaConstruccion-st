<?PHP 
require_once __DIR__."/../app/autoload.php";

use Controllers\LocalidadC;
use Controllers\RolC;
use Controllers\UsuarioC;
use Controllers\ViewC;

$actionName = isset($_GET['action']) ? $_GET['action'] : 'login_view';

// Controllers
$viewC = new ViewC();
$usuarioC = new UsuarioC();
$rolC = new RolC();
$localidadC = new LocalidadC();

function checkSession(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!isset($_SESSION['contraseña']) || !isset($_SESSION['correo'])){
        UsuarioC::blockSession();
        return false;
    }
    return true;

}

// Router
if($actionName == "login_view"){
    $viewC->load_login($rolC->getAll(),$localidadC->getAll());
}elseif($actionName == "login"){
    $usuarioC->login();
}elseif(checkSession()){
    if ($actionName == "home") {
        $viewC->load_home();
    }
}

?>