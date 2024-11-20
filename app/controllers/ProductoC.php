<?PHP 
namespace Controllers;

use DAOS\ProductoDao;
use Core\BaseController;

class ProductoC extends BaseController{
    public function __construct() {
        parent::__construct(new ProductoDao());
    }
    public function getByCategoria($idCategoria){
        return $this->dao->getProductsCategory($idCategoria);
    }
    public function getProductsByUser($codigoUsuario,$codigoRol){
        if ($codigoRol == UsuarioC::CODIGO_ROL_PROVEEDOR) {
            return $this->dao->getProductsByUser($codigoUsuario);
        }
        return $this->dao->getAll();
    }
}
?>