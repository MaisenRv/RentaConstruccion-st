<?PHP 
namespace DAOS;
use Core\BaseDao;
use Models\Pago;

class PagoDao extends BaseDao {
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->prepareQuery('SELECT * FROM Pago');
        $result = $this->execute();
        if (!is_null($result)) {
            $pagos = [];
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $pago = new Pago(
                    $row['CodigoPedido'], 
                    $row['CodigoMetodoDePago'], 
                    $row['Monto'], 
                    $row['FechaPago'], 
                    $row['Estado'], 
                    $row['CodigoPago']
                );
                $pagos[] = $pago;
            }
            return $pagos;
        }
    }

    // public function getById($id) {
    //     $this->prepareQuery('SELECT * FROM Pago WHERE CodigoPago = ?');
    //     $this->bindParam(1, $id);
    //     $result = $this->execute();
    //     if (!is_null($result)) {
    //         $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    //         return new Pago(
    //             $row['CodigoPedido'], 
    //             $row['CodigoMetodoDePago'], 
    //             $row['Monto'], 
    //             $row['FechaPago'], 
    //             $row['Estado'], 
    //             $row['CodigoPago']
    //         );
    //     }
    // }
}
