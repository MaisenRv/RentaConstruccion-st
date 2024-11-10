<?PHP 
namespace DAOS;
use Core\BaseDao;
use Models\DetallePedido;

class DetallePedidoDao extends BaseDao {
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->prepareQuery('SELECT * FROM DetallePedido');
        $result = $this->execute();
        if (!is_null($result)) {
            $detalles = [];
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $detalle = new DetallePedido(
                    $row['CodigoPedido'], 
                    $row['CodigoProducto'], 
                    $row['Cantidad']
                );
                $detalles[] = $detalle;
            }
            return $detalles;
        }
    }

}
