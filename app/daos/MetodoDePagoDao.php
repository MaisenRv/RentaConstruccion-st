<?PHP
namespace DAOS;
use Core\BaseDao;
use Models\MetodoDePago;

class MetodoDePagoDao extends BaseDao {
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->prepareQuery('SELECT * FROM MetodoDePago');
        $result = $this->execute();
        if (!is_null($result)) {
            $metodosDePago = [];
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $metodoDePago = new MetodoDePago($row['MetodoDePago'], $row['CodigoMetodoDePago']);
                $metodosDePago[] = $metodoDePago;
            }
            return $metodosDePago;
        }
    }

    // public function getById($id) {
    //     $this->prepareQuery('SELECT * FROM MetodoDePago WHERE CodigoMetodoDePago = ?');
    //     $this->bindParam(1, $id);
    //     $result = $this->execute();
    //     if (!is_null($result)) {
    //         $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    //         return new MetodoDePago($row['MetodoDePago'], $row['CodigoMetodoDePago']);
    //     }
    // }
}
