<?PHP 
require_once __DIR__."/../app/autoload.php";

use Controllers\CategoriaC;
use Controllers\LocalidadC;
use Controllers\MarcaC;
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
$marcaC = new MarcaC();

// Router
if($actionName == "login_view")   { $viewC->load_login($rolC->getAll(),$localidadC->getAll()); }
elseif($actionName == "login")    { $usuarioC->login(); }
elseif($actionName == "register") { $usuarioC->register(); }
elseif($actionName == "logout")   { UsuarioC::logout(); }
elseif(UsuarioC::checkSession()){
    if ($actionName == "home")       { 
        $viewC->load_home( $_SESSION['razonSocial'] ); 
    }elseif ($actionName == "categorias")       { 
        $viewC->load_category(
            $categoriasC->getCategoryByUser($_SESSION['codigoUsuario'],$_SESSION['codigoRol']),
            $_SESSION['codigoRol']
        );
    }elseif($actionName == "productos"){
        $viewC->load_products(
            $productoC->getProductsByUser($_SESSION['codigoUsuario'],$_SESSION['codigoRol']),
            $_SESSION['codigoRol']
        );
    }elseif($actionName == "crear-producto"){
        $viewC->load_add_products($categoriasC->getAll(),$marcaC->getAll());
    }

}

?>