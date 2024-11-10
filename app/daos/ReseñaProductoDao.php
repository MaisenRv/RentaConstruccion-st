<?PHP 
namespace DAOS;
use Core\BaseDao;
use Models\ReseñaProducto;

class ReseñaProductoDao extends BaseDao {
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->prepareQuery('SELECT * FROM ReseñaProducto');
        $result = $this->execute();
        if (!is_null($result)) {
            $reseñas = [];
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $reseña = new ReseñaProducto(
                    $row['CodigoCliente'], 
                    $row['CodigoProveedor'], 
                    $row['CodigoProducto'], 
                    $row['Calificacion'], 
                    $row['Fecha'], 
                    $row['Comentario'], 
                    $row['CodigoReseña']
                );
                $reseñas[] = $reseña;
            }
            return $reseñas;
        }
    }

}
