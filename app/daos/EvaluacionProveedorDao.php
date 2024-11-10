<?PHP 
namespace DAOS;
use Core\BaseDao;
use Models\EvaluacionProveedor;

class EvaluacionProveedorDao extends BaseDao {
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->prepareQuery('SELECT * FROM EvaluacionProveedor');
        $result = $this->execute();
        if (!is_null($result)) {
            $evaluaciones = [];
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $evaluacion = new EvaluacionProveedor(
                    $row['CodigoProveedor'], 
                    $row['CodigoCliente'], 
                    $row['Calificacion'], 
                    $row['FechaEvaluacion'],
                    $row['Comentario']
                );
                $evaluaciones[] = $evaluacion;
            }
            return $evaluaciones;
        }
    }

}
