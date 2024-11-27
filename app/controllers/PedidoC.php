<?PHP 
namespace Controllers;

use DAOS\PedidoDao;
use Core\BaseController;

class PedidoC extends BaseController{
    public function __construct() {
        parent::__construct(new PedidoDao());
    }
    public function makeOrder($userType){
        $codigoUsuario = $_SESSION['codigoUsuario'];
        $productos =[];
        foreach ($_SESSION['ListaPedido'] as $item){
            $productos[] =[
                'CodigoProducto'=> $item[1]->getCodigoProducto(),
                'Cantidad' => $item[0]
            ]; 
        }
        $this->dao->makeOrder($codigoUsuario,$productos,$userType);

    }
}


?>