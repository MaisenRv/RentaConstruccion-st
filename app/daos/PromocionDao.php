<?PHP 
namespace DAOS;

use Core\BaseDao;
use Models\Promocion;

class PromocionDao extends BaseDao {
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->prepareQuery('SELECT * FROM Promocion');
        $result = $this->execute();
        if (!is_null($result)) {
            $promociones = [];
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $promocion = new Promocion($row['Descripcion'], $row['PorcentajeDescuento'], $row['CodigoPromocion']);
                $promociones[] = $promocion;
            }
            return $promociones;
        }
    }

    // public function getById($id) {
    //     $this->prepareQuery('SELECT * FROM Promocion WHERE CodigoPromocion = ?');
    //     $this->bindParam(1, $id);
    //     $result = $this->execute();
    //     if (!is_null($result)) {
    //         $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    //         return new Promocion($row['Descripcion'], $row['PorcentajeDescuento'], $row['CodigoPromocion']);
    //     }
    // }
}
