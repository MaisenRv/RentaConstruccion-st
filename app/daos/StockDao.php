<?PHP 
namespace DAOS;
use Core\BaseDao;
use Models\Stock;

class StockDao extends BaseDao {
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->prepareQuery('SELECT * FROM Stock');
        $result = $this->execute();
        if (!is_null($result)) {
            $stocks = [];
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $stock = new Stock(
                    $row['CodigoProveedor'], 
                    $row['CodigoProducto'], 
                    $row['Fecha'], 
                    $row['TipoMovimiento'], 
                    $row['CantidadMovimiento'], 
                    $row['CantidadAcumulada'], 
                    $row['Estado'], 
                    $row['CodigoStock']
                );
                $stocks[] = $stock;
            }
            return $stocks;
        }
    }
}
