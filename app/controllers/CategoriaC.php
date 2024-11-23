<?PHP 
namespace Controllers;

use DAOS\CategoriaDao;
use Core\BaseController;

class CategoriaC extends BaseController{
    public function __construct() {
        parent::__construct(new CategoriaDao());
    }
    public function getCategoryByUser($codigoUsuario,$codigoRol,$userType){
        if ($codigoRol == UsuarioC::CODIGO_ROL_PROVEEDOR) {
            return $this->dao->getCategorysByUser($codigoUsuario,$userType);
        }
        return $this->dao->getAll($userType);
    }
}
?>