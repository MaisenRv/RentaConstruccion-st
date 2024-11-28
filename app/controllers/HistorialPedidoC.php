<?PHP 
namespace Controllers;

use DAOS\HistorialPedidoDao;
use Core\BaseController;

class HistorialPedidoC extends BaseController{
    public function __construct() {
        parent::__construct(new HistorialPedidoDao());
    }

    public function getByUser($id,$userType){
        return $this->dao->getByUser($id,$userType);
    }
}


?>