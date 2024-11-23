<?PHP 
namespace Controllers;

use DAOS\ProductoDao;
use Core\BaseController;
use Models\Producto;

class ProductoC extends BaseController{
    public function __construct() {
        parent::__construct(new ProductoDao());
    }
    
    public function getByCategoria($idCategoria){
        return $this->dao->getProductsCategory($idCategoria);
    }

    public function getProductsByUser($codigoUsuario,$codigoRol,$userType){
        if ($codigoRol == UsuarioC::CODIGO_ROL_PROVEEDOR) {
            return $this->dao->getProductsByUser($codigoUsuario,$userType);
        }
        return $this->dao->getAll($userType);
    }

    public function createProduct($codigoProveedor,$userType){
        $newProduct = new Producto(
            $_POST['nombreProducto'],
            $_POST['estado'],
            $_POST['precioRenta'],
            $_POST['marca'],
            $_POST['categoria'],
            $_POST['urlImg']
        );
        $cantidad = $_POST['CantidadProducto'];
        $this->create($newProduct,$userType,['proveedor'=>$codigoProveedor,'cantidad'=>$cantidad]);
    }
}
?>