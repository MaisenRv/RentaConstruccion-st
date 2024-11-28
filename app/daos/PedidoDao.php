<?PHP 
namespace DAOS;
use Core\BaseDao;
use Exception;
use Models\Pedido;

class PedidoDao extends BaseDao {
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->prepareQuery('SELECT * FROM Pedido');
        $result = $this->execute();
        if (!is_null($result)) {
            $pedidos = [];
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $pedido = new Pedido($row['CodigoCliente'], $row['CodigoProveedor'], $row['CodigoPedido']);
                $pedidos[] = $pedido;
            }
            return $pedidos;
        }
    }

    public function makeOrder($codigoUsuario,$productos,$userType){
        try {
            $this->setUserType($userType);
            $tipoTabla = "listaProductos";
            $productosParam = [];
            foreach ($productos as $producto) {
                $productosParam[$tipoTabla][] = array($producto['CodigoProducto'], $producto['Cantidad']);
            }
            $params = [
                [&$productosParam,SQLSRV_PARAM_IN],
                [$codigoUsuario,SQLSRV_PARAM_IN]
            ];
            $this->prepareQuery('EXEC I_Pedido ?, ?',$params);
            $result = $this->execute();
            if (is_null($result)){ return null; }
            unset($_SESSION['ListaPedido']);
            $this->showMessages();
            echo '<script>window.history.back();</script>';
        } catch (Exception $e) {
            $this->showMessages();
            echo '<script>window.history.back();</script>';
            exit;
        }
    }


}
