<?PHP 
namespace DAOS;
use Core\BaseDao;
use Exception;
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


    public function getByUser($id,$userType){
        try {
            $this->setUserType($userType);
            $params = [$id];
            $sql = 'SELECT Pedido.CodigoPedido,FechaInicio,FechaFin,Estado,Observaciones 
                FROM HistorialPedido
                INNER JOIN Pedido 
                ON HistorialPedido.CodigoPedido = Pedido.CodigoPedido
                WHERE CodigoCliente = ? 
                ORDER BY FechaInicio DESC;';
            $this->prepareQuery($sql,$params);
            $result = $this->execute();
            if (is_null($result)){ return null; }
            $historial = [];
            foreach($this->fetchAll($result) as $row){
                $his = new HistorialPedido(
                    $row['CodigoPedido'],
                    $row['FechaInicio'],
                    $row['FechaFin'],
                    $row['Estado'],
                    $row['Observaciones']
                );
                $historial[] = $his;
            }

            return $historial;
        } catch (Exception $e) {
            $this->showMessages();
        }
    }

}
