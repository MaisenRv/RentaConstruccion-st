<?PHP 
require_once __DIR__."/../app/autoload.php";

use Controllers\CategoriaC;
use Controllers\LocalidadC;
use Controllers\RolC;
use Controllers\UsuarioC;
use Controllers\ViewC;
use Controllers\ProductoC;

$actionName = isset($_GET['action']) ? $_GET['action'] : 'login_view';

// Controllers
$viewC = new ViewC();
$usuarioC = new UsuarioC();
$rolC = new RolC();
$localidadC = new LocalidadC();
$categoriasC = new CategoriaC();
$productoC  = new ProductoC();

// Router
if($actionName == "login_view")   { $viewC->load_login($rolC->getAll(),$localidadC->getAll()); }
elseif($actionName == "login")    { $usuarioC->login(); }
elseif($actionName == "register") { $usuarioC->register(); }
elseif($actionName == "logout")   { UsuarioC::logout(); }
elseif(UsuarioC::checkSession()){
    if ($actionName == "home")       { $viewC->load_home($categoriasC->getAll()); }
    if ($actionName == "productos")  {
        if(isset($_GET['categoria'])){
            $viewC->load_products($productoC->getByCategoria($_GET['categoria']));
            return;
        }
        $viewC->load_products($productoC->getAll());
    }
}

?>