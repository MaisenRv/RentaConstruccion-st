<?PHP 
namespace DAOS;
use Core\BaseDao;
use Models\Producto;

class ProductoDao extends BaseDao {
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->prepareQuery('SELECT * FROM Producto');
        $result = $this->execute();
        if (!is_null($result)) {
            $productos = [];
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $producto = new Producto(
                    $row['NombreProducto'], 
                    $row['EstadoProducto'], 
                    $row['PrecioDeRenta'], 
                    $row['CodigoMarca'], 
                    $row['IdCategoria'], 
                    $row['CodigoProducto']
                );
                $productos[] = $producto;
            }
            return $productos;
        }
    }

    // public function getById($id) {
    //     $this->prepareQuery('SELECT * FROM Producto WHERE CodigoProducto = ?');
    //     $this->bindParam(1, $id);
    //     $result = $this->execute();
    //     if (!is_null($result)) {
    //         $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    //         return new Producto(
    //             $row['NombreProducto'], 
    //             $row['EstadoProducto'], 
    //             $row['PrecioDeRenta'], 
    //             $row['CodigoMarca'], 
    //             $row['IdCategoria'], 
    //             $row['CodigoProducto']
    //         );
    //     }
    // }
}
