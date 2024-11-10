<?PHP 
namespace DAOS;
use Core\BaseDao;
use Models\Seguro;

class SeguroDao extends BaseDao {
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->prepareQuery('SELECT * FROM Seguro');
        $result = $this->execute();
        if (!is_null($result)) {
            $seguros = [];
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $seguro = new Seguro(
                    $row['Cobertura'], 
                    $row['FechaCaducidad'], 
                    $row['Costo'], 
                    $row['CodigoPedido'], 
                    $row['CodigoSeguro']
                );
                $seguros[] = $seguro;
            }
            return $seguros;
        }
    }

    // public function getById($id) {
    //     $this->prepareQuery('SELECT * FROM Seguro WHERE CodigoSeguro = ?');
    //     $this->bindParam(1, $id);
    //     $result = $this->execute();
    //     if (!is_null($result)) {
    //         $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    //         return new Seguro(
    //             $row['Cobertura'], 
    //             $row['FechaCaducidad'], 
    //             $row['Costo'], 
    //             $row['CodigoPedido'], 
    //             $row['CodigoSeguro']
    //         );
    //     }
    // }
}
