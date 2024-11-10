<?PHP
namespace DAOS;
use Core\BaseDao;
use Models\PromocionProducto;

class PromocionProductoDao extends BaseDao {
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->prepareQuery('SELECT * FROM PromocionProducto');
        $result = $this->execute();
        if (!is_null($result)) {
            $promocionesProductos = [];
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $promocionProducto = new PromocionProducto(
                    $row['CodigoProducto'], 
                    $row['CodigoPromocion'], 
                    $row['FechaInicio'], 
                    $row['FechaFin']
                );
                $promocionesProductos[] = $promocionProducto;
            }
            return $promocionesProductos;
        }
    }

    // public function getById($codigoProducto, $codigoPromocion) {
    //     $this->prepareQuery('SELECT * FROM PromocionProducto WHERE CodigoProducto = ? AND CodigoPromocion = ?');
    //     $this->bindParam(1, $codigoProducto);
    //     $this->bindParam(2, $codigoPromocion);
    //     $result = $this->execute();
    //     if (!is_null($result)) {
    //         $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    //         return new PromocionProducto(
    //             $row['CodigoProducto'], 
    //             $row['CodigoPromocion'], 
    //             $row['FechaInicio'], 
    //             $row['FechaFin']
    //         );
    //     }
    // }
}
