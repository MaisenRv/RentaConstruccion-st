<?PHP 
namespace DAOS;
use Core\BaseDao;
use Exception;
use Models\Marca;
use Models\Producto;

class ProductoDao extends BaseDao {
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->prepareQuery('SELECT * FROM Producto p INNER JOIN marca m ON p.CodigoMarca = m.CodigoMarca ');
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
                    $row['urlImg'],
                    $row['CodigoProducto']
                );
                $marca = new Marca($row['NombreMarca'],$row['CodigoMarca']);
                $producto->setMarca($marca);
                $productos[] = $producto;
            }
            return $productos;
        }
    }
    public function getProductsCategory($idCategory){
        $params = [$idCategory];
        $this->prepareQuery('SELECT * FROM Producto p
                            INNER JOIN marca m ON p.CodigoMarca = m.CodigoMarca 
                            WHERE IdCategoria = ?',$params);
        $result = $this->execute();

        $products = [];
        if (is_null($result)){ return null; }
        
        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
            $product = new Producto(
                $row['NombreProducto'],
                $row['EstadoProducto'],
                $row['PrecioDeRenta'],
                $row['CodigoMarca'],
                $row['IdCategoria'],
                $row['urlImg'],
                $row['CodigoProducto']
            );
            $marca = new Marca($row['NombreMarca'],$row['CodigoMarca']);
            $product->setMarca($marca);
            $products[] = $product;
        }

        if (count($products) > 0) {
            return $products;
        }
        return null;
    }

    
    public function getProductsByUser($codigoUsuario){
        try {
            $params = [$codigoUsuario];
            $this->prepareQuery('EXEC S_Productos ?',$params);
            $result = $this->execute();
            $products = [];
            if (is_null($result)){ return null; }
            foreach($this->fetchAll($result) as $row){
                $product = new Producto(
                    $row['NombreProducto'],
                    $row['EstadoProducto'],
                    $row['PrecioDeRenta'],
                    $row['CodigoMarca'],
                    $row['IdCategoria'],
                    $row['urlImg'],
                    $row['CodigoProducto']
                );
                $marca = new Marca($row['NombreMarca'],$row['CodigoMarca']);
                $product->setMarca($marca);
                $products[] = $product;
            }
            return $products;

        } catch (Exception $e) {
            $this->showMessages();
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
