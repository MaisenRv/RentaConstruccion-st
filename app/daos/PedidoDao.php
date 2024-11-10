<?PHP 
namespace DAOS;
use Core\BaseDao;
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
}
