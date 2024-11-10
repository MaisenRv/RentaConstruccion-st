<?PHP 
namespace DAOS;
use Core\BaseDao;
use Models\HistorialPedido;

class HistorialPedidoDao extends BaseDao {
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->prepareQuery('SELECT * FROM HistorialPedido');
        $result = $this->execute();
        if (!is_null($result)) {
            $historialPedidos = [];
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $historialPedido = new HistorialPedido(
                    $row['CodigoPedido'], 
                    $row['FechaInicio'], 
                    $row['FechaFin'], 
                    $row['Estado'], 
                    $row['Observaciones'], 
                    $row['CodigoHistorialPedido']
                );
                $historialPedidos[] = $historialPedido;
            }
            return $historialPedidos;
        }
    }

}
