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

    public function getAll($userType) {
        $this->setUserType($userType);
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
    public function getProductsCategory($idCategory,$userType){
        $this->setUserType($userType);
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

    
    public function getProductsByUser($codigoUsuario,$userType){
        try {
            $this->setUserType($userType);
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

    public function create(Producto $newProduct,$userType,$args){
        try {
            $this->setUserType($userType);
            extract($args);
            $params = [
                $proveedor,
                $newProduct->getNombreProducto(),
                $newProduct->getEstadoProducto(),
                $newProduct->getPrecioDeRenta(),
                $newProduct->getCodigoMarca(),
                $newProduct->getIdCategoria(),
                $newProduct->getUrlImg(),
                $cantidad
            ];
            $sql = "EXEC I_Producto ?,?,?,?,?,?,?,?";
            $this->prepareQuery($sql,$params);
            $this->execute();
            $this->showMessages();
            echo '<script>window.history.back();</script>';
        } catch (Exception $e) {
            $this->showMessages();
            exit();
        }
    }

    public function getProductById($id,$userType){
        try {
            $this->setUserType($userType);
            $params = [$id];
            $this->prepareQuery(
                'SELECT NombreProducto,EstadoProducto,PrecioDeRenta,m.CodigoMarca,IdCategoria,urlImg,CodigoProducto,NombreMarca 
                FROM Producto p INNER JOIN Marca m ON p.CodigoMarca = m.CodigoMarca WHERE CodigoProducto = ?',
                $params
            );
            $result = $this->execute();
            if (is_null($result)){ return null; }
            $product = null;
            $marca = null;
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
            }
            return $product;
        } catch (Exception $e) {
            $this->showMessages();
        }
    }

}
