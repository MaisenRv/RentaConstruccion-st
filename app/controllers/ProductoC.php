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
}
?>