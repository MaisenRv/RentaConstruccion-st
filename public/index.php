<?PHP 
require_once __DIR__."/../app/autoload.php";

use Controllers\CategoriaC;
use Controllers\HistorialPedidoC;
use Controllers\LocalidadC;
use Controllers\MarcaC;
use Controllers\PedidoC;
use Controllers\RolC;
use Controllers\UsuarioC;
use Controllers\ViewC;
use Controllers\ProductoC;
use Controllers\StockC;

$actionName = isset($_GET['action']) ? $_GET['action'] : 'login_view';

// Controllers
$viewC = new ViewC();
$usuarioC = new UsuarioC();
$rolC = new RolC();
$localidadC = new LocalidadC();
$categoriasC = new CategoriaC();
$productoC  = new ProductoC();
$marcaC = new MarcaC();
$stockC = new StockC();
$pedidoC = new PedidoC();
$historialPedidoC = new HistorialPedidoC();

// Router
$userType = $usuarioC->getUserType();

if($actionName == "login_view")   { 
    $viewC->load_login(
        $rolC->getAll( $userType ),
        $localidadC->getAll( $userType )
    ); 
}
elseif($actionName == "login")    { $usuarioC->login($userType); }
elseif($actionName == "register") { $usuarioC->register($userType); }
elseif($actionName == "logout")   { UsuarioC::logout(); }
elseif(UsuarioC::checkSession()){
    if ($actionName == "home")    { $viewC->load_home( $_SESSION['razonSocial'] ); 
    }elseif ($actionName == "categorias"){ 

        $viewC->load_category(
            $categoriasC->getCategoryByUser($_SESSION['codigoUsuario'],$_SESSION['codigoRol'],$userType),
            $_SESSION['codigoRol']
        );

    }elseif($actionName == "productos" && isset($_GET['categoria'])){

        $viewC->load_products(
            $productoC->getByCategoria($_GET['categoria'],$userType),
            $_SESSION['codigoRol']
        );

    }elseif($actionName == "productos"){

        $viewC->load_products(
            $productoC->getProductsByUser($_SESSION['codigoUsuario'],$_SESSION['codigoRol'],$userType),
            $_SESSION['codigoRol']
        );

    }elseif($actionName == "crear_producto_view"){

        $viewC->load_add_products(
            $categoriasC->getAll($userType),
            $marcaC->getAll($userType)
        );

    }elseif($actionName == "crear_producto"){

        $productoC->createProduct(
            $_SESSION['codigoUsuario'],
            $userType
        );

    }elseif($actionName == "stock"){

        $viewC->load_stock(
            $stockC->getByUser($_SESSION['codigoUsuario'], $userType)
        );

    }elseif($actionName == "product" && isset($_GET['id'])){

        $viewC->load_product(
            $productoC->getProductById($_GET['id'], $userType)
        );

    }elseif($actionName == "historialcliente"){ 
        $viewC->load_order_history($historialPedidoC->getByUser($_SESSION['codigoUsuario'],$userType)); 
    }elseif($actionName == "pedido"){ 
        $viewC->load_order(); 
    }elseif($actionName == "hacer_pedido"){ 
        $pedidoC->makeOrder($userType);
    }

}

?>