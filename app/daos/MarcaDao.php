<?PHP 
namespace DAOS;
use Core\BaseDao;
use Models\Marca;

class MarcaDao extends BaseDao {
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->prepareQuery('SELECT * FROM Marca');
        $result = $this->execute();
        if (!is_null($result)) {
            $marcas = [];
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $marca = new Marca($row['NombreMarca'], $row['CodigoMarca']);
                $marcas[] = $marca;
            }
            return $marcas;
        }
    }

    // public function getById($id) {
    //     $this->prepareQuery('SELECT * FROM Marca WHERE CodigoMarca = ?');
    //     $this->bindParam(1, $id);
    //     $result = $this->execute();
    //     if (!is_null($result)) {
    //         $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    //         return new Marca($row['NombreMarca'], $row['CodigoMarca']);
    //     }
    // }
}
