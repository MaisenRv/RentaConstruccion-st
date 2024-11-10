<?PHP 
require_once __DIR__."/../app/autoload.php";

use Controllers\LocalidadC;
use Controllers\RolC;
use Controllers\UsuarioC;

$actionName = isset($_GET['action']) ? $_GET['action'] : 'login';

// Controllers
$usuarioC = new UsuarioC();
$rolC = new RolC();
$localidadC = new LocalidadC();


function checkSession(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!isset($_SESSION['correo']) || !isset($_SESSION['contrasena'])){
        UsuarioC::blockSession();
        return false;
    }
    return true;

}

// Router
if($actionName == "login"){
    $usuarioC->login($rolC->getAll(),$localidadC->getAll());
}elseif(checkSession()){

}

?>